<?php
use Migrations\AbstractMigration;

class CreateObjects extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('objects', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('file_extension', 'string', [
            'default' => null,
            'limit' =>  15,
            'null' => false,
        ]);
        $table->addColumn('mime_type', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addIndex([
            'id',
        ], [
            'name' => 'UNIQUE_ID',
            'unique' => true,
        ]);
        $table->create();
    }
}
