<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use App\Model\Entity\Node;
use App\Model\Entity\NodeRevision;
use App\Model\Entity\User;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File as CakeFile;

/**
 * Nodes Model
 *
 * @property \App\Model\Table\NodesTable|\Cake\ORM\Association\BelongsTo $ParentNodes
 * @property \App\Model\Table\NodeCommentsTable|\Cake\ORM\Association\HasMany $NodeComments
 * @property \App\Model\Table\NodesTable|\Cake\ORM\Association\HasMany $ChildNodes
 * @property \App\Model\Table\FilesTable|\Cake\ORM\Association\BelongsToMany $Files
 *
 * @method \App\Model\Entity\Node get($primaryKey, $options = [])
 * @method \App\Model\Entity\Node newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Node[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Node|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Node|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Node patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Node[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Node findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class NodesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('nodes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentNodes', [
            'className' => 'Nodes',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildNodes', [
            'dependent' => true,
            'className' => 'Nodes',
            'foreignKey' => 'parent_id'
        ]);

        $this->hasMany('NodeComments', [
            'dependent' => true,
            'foreignKey' => 'node_id'
        ]);
        $this->hasMany('NodeRevisions', [
            'dependent' => true,
            'foreignKey' => 'node_id'
        ]);
        $this->belongsToMany('Files', [
            'foreignKey' => 'node_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'nodes_files'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->allowEmptyString('description', true);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['parent_id'], 'ParentNodes'));

        return $rules;
    }

    public function createRevision(Node &$node = null, User $user = null)
    {
        if(!empty($node->id)) {
            $newRevision = $this->NodeRevisions->createRevision($node, $user);
            $this->NodeRevisions->save($newRevision);
        }
    }

    public function beforeSave(Event $event, Node $node, \ArrayObject $options)
    {
        $this->createRevision($node, (!empty($options['User']) ? $options['User'] : null));
    }

    /**
     * importFromFolder
     *
     * @param Node The parent node to extract to.
     * @param Folder The target Folder object.
     *
     * @return Folder For method chaining.
     */
    public function importFromFolder(Node &$parent = null, Folder &$target = null)
    {
        if(!empty($target) && !empty($parent)) {
            $dir = $target->read(true, false, true);

            foreach($dir[1] as $tempFile) {
                $tempFile = new CakeFile($tempFile);
                if((strpos($tempFile->mime(), 'text/') !== false)) {
                    $body = $tempFile->read();
                    if ($tempFile->name() == 'overview') {
                        $parent->description .= $body;
                        $this->save($parent);
                    } else {
                        $child = $this->newEntity([
                            'name' => $tempFile->name(),
                            'parent_id' => $parent->id,
                            'description' => $body
                        ]);
                        $this->save($child);
                    }
                } else {
                    $this->Files->importFromFile($tempFile, $parent);
                }
            }

            foreach($dir[0] as $folder) {
                $name = substr($folder, (strrpos($folder, DS) + 1));
                $folder = new Folder($folder, false);
                $child = $this->newEntity([
                    'name' => $name,
                    'parent_id' => $parent->id,
                    'description' => ''
                ]);
                if($this->save($child)) {
                    $this->importFromFolder($child, $folder);
                }
            }
        }
        return $target;
    }
}
