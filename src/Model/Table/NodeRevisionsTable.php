<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Entity\Node;
use App\Model\Entity\NodeRevision;
use App\Model\Entity\User;
use Cake\Controller\Component\AuthComponent;

/**
 * NodeRevisions Model
 *
 * @property \App\Model\Table\NodesTable|\Cake\ORM\Association\BelongsTo $Nodes
 * @property \App\Model\Table\NodeRevisionsTable|\Cake\ORM\Association\BelongsTo $ParentNodeRevisions
 * @property \App\Model\Table\NodeRevisionsTable|\Cake\ORM\Association\HasMany $ChildNodeRevisions
 *
 * @method \App\Model\Entity\NodeRevision get($primaryKey, $options = [])
 * @method \App\Model\Entity\NodeRevision newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NodeRevision[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NodeRevision|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NodeRevision|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NodeRevision patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NodeRevision[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NodeRevision findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class NodeRevisionsTable extends Table
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

        $this->setTable('node_revisions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Nodes', [
            'foreignKey' => 'node_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ParentNodeRevisions', [
            'className' => 'NodeRevisions',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildNodeRevisions', [
            'className' => 'NodeRevisions',
            'foreignKey' => 'parent_id'
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
        $rules->add($rules->existsIn(['node_id'], 'Nodes'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentNodeRevisions'));

        return $rules;
    }

    public function findRecent(Query $query, array $options = null)
    {
        return $query->where(['NodeRevisions.node_id' => $options['node_id']])
                    ->order(['NodeRevisions.created' => 'DESC'])
                    ->limit(1);
    }

    public function findRoot(Query $query, array $options = null)
    {
        return $query->where(['NodeRevisions.parent_id IS' => null, 'NodeRevisions.node_id' => $options['node_id']])
                    ->limit(1);
    }

    /**
     * newEntityFromNode
     */
    public function createRevision(Node &$node = null, User &$user = null)
    {
        if(!empty($node)) {
            $parent = $this->find('recent', ['node_id' => $node->id])->first();

            return $this->newEntity([
                'node_id' => $node->id,
                'user_id' => (!empty($user->id) ? $user->id : null),
                'parent_id' => (!empty($parent->id) ? $parent->id : null),
                'name' => $node->name,
                'description' => $node->description
            ]);
        } else {
            return null;
        }
    }
}
