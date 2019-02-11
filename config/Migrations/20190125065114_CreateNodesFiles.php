<?php
use Migrations\AbstractMigration;

class CreateNodesFiles extends AbstractMigration
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
        $table = $this->table('nodes_files');
        $table->addColumn('node_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('file_id', 'char', [
            'limit' => 64,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addIndex([
            'node_id',
            'file_id',
        ], [
            'name' => 'UNIQUE_NODE_FILE',
            'unique' => true,
        ]);
        $table->addIndex(['node_id']);
        $table->addIndex(['file_id']);
        $table->create();
    }
}
