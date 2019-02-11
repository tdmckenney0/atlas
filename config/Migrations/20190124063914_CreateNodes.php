<?php
use Migrations\AbstractMigration;

class CreateNodes extends AbstractMigration
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
        $table = $this->table('nodes', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('parent_id', 'uuid', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('lft', 'integer', [
            'limit' => 11,
            'signed' => true
        ]);
        $table->addColumn('rght', 'integer', [
            'limit' => 11,
            'signed' => true
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex(['parent_id']);
        $table->addIndex(['lft']);
        $table->addIndex(['rght']);
        $table->create();
    }
}
