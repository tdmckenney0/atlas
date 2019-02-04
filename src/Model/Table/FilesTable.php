<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\Filesystem\File as CakeFile;
use ArrayObject;

/**
 * Files Model
 *
 * @property \App\Model\Table\NodesTable|\Cake\ORM\Association\BelongsToMany $Nodes
 *
 * @method \App\Model\Entity\File get($primaryKey, $options = [])
 * @method \App\Model\Entity\File newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\File[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\File|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\File[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\File findOrCreate($search, callable $callback = null, $options = [])
 */
class FilesTable extends Table
{
    /**
     * Absolute path to file storage.
     */
    const STORAGE = (ROOT . DS . 'files' . DS);

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('files');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Nodes', [
            'foreignKey' => 'file_id',
            'targetForeignKey' => 'node_id',
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
            ->alphaNumeric('id')
            ->maxLength('id', 64)
            ->allowEmptyString('id', false)
            ->requirePresence('id', 'create')
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
     * Returns a rules checker file that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules file to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }

    /**
     *
     */
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if(!empty($data['file']) && is_uploaded_file($data['file']['tmp_name'])) {

            $file = new CakeFile($data['file']['tmp_name'], false);

            if($file->exists()) {

                $exts = [];

                preg_match('/\w*$/', $data['file']['name'], $exts);

                $data['id'] = hash_file('sha256', $file->path);
                $data['mime_type'] = $file->mime();
                $data['name'] = $data['file']['name'];
                $data['file_extension'] = (!empty($exts[0]) ? $exts[0] : 'dunno');

                $filename = self::STORAGE . $data['id'] . '.' . $data['file_extension'];

                $file->copy($filename, false);
                $file->delete();
                $file->close();
            }
        }
    }
}
