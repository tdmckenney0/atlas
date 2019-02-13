<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use App\Model\Entity\Node;
use App\Model\Entity\NodeRevision;

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
            'className' => 'Nodes',
            'foreignKey' => 'parent_id'
        ]);

        $this->hasMany('NodeComments', [
            'foreignKey' => 'node_id'
        ]);
        $this->hasMany('NodeRevisions', [
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
            ->allowEmptyString('description', false);

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

    public function beforeSave(Event $event, Node $node, \ArrayObject $options)
    {
        if(!empty($node->id)) {
            $prev = $this->get($node->id);
            $newRevision = $this->NodeRevisions->createRevision($prev, (!empty($options['User']) ? $options['User'] : null));
            $this->NodeRevisions->save($newRevision);
        }
    }
}
