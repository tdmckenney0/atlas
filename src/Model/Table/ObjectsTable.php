<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Objects Model
 *
 * @property \App\Model\Table\NodesTable|\Cake\ORM\Association\BelongsToMany $Nodes
 *
 * @method \App\Model\Entity\Object get($primaryKey, $options = [])
 * @method \App\Model\Entity\Object newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Object[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Object|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Object|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Object patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Object[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Object findOrCreate($search, callable $callback = null, $options = [])
 */
class ObjectsTable extends Table
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

        $this->setTable('objects');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Nodes', [
            'foreignKey' => 'object_id',
            'targetForeignKey' => 'node_id',
            'joinTable' => 'nodes_objects'
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
            ->allowEmptyString('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('file_extension')
            ->maxLength('file_extension', 15)
            ->requirePresence('file_extension', 'create')
            ->allowEmptyFile('file_extension', false);

        $validator
            ->scalar('mime_type')
            ->maxLength('mime_type', 255)
            ->requirePresence('mime_type', 'create')
            ->allowEmptyString('mime_type', false);

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
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }
}
