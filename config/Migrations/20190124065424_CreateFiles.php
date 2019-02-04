<?php
use Migrations\AbstractMigration;

class CreateFiles extends AbstractMigration
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
        $table = $this->table('files', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'char', [
            'limit' =>  64,
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
