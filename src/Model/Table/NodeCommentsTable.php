<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NodeComments Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\NodesTable|\Cake\ORM\Association\BelongsTo $Nodes
 * @property \App\Model\Table\NodeCommentsTable|\Cake\ORM\Association\BelongsTo $ParentNodeComments
 * @property \App\Model\Table\NodeCommentsTable|\Cake\ORM\Association\HasMany $ChildNodeComments
 *
 * @method \App\Model\Entity\NodeComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\NodeComment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NodeComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NodeComment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NodeComment|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NodeComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NodeComment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NodeComment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class NodeCommentsTable extends Table
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

        $this->setTable('node_comments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Nodes', [
            'foreignKey' => 'node_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ParentNodeComments', [
            'className' => 'NodeComments',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildNodeComments', [
            'className' => 'NodeComments',
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
            ->scalar('body')
            ->allowEmptyString('body');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['node_id'], 'Nodes'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentNodeComments'));

        return $rules;
    }
}
