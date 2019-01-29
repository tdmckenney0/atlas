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
        $table = $this->table('node_comments');
        $table->addColumn('user_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('node_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('parent_id', 'integer', [
            'default' => null,
            'limit' => 11,
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
        $table->create();
    }
}
