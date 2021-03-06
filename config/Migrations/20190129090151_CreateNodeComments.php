<?php
use Migrations\AbstractMigration;

class CreateNodeComments extends AbstractMigration
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
        $table = $this->table('node_comments', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('node_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('parent_id', 'uuid', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('lft', 'integer', [
            'signed' => true,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('rght', 'integer', [
            'signed' => true,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('body', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addIndex(['user_id']);
        $table->addIndex(['node_id']);
        $table->addIndex(['parent_id']);
        $table->addIndex(['lft']);
        $table->addIndex(['rght']);
        $table->create();
    }
}
