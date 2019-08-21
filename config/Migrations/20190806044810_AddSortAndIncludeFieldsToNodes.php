<?php
use Migrations\AbstractMigration;

class AddSortAndIncludeFieldsToNodes extends AbstractMigration
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
        $table = $this->table('nodes');

        $table->addColumn('sort', 'integer', [
            'after' => 'rght',
            'signed' => false,
            'default' => 0,
            'null' => false
        ]);

        $table->addColumn('print', 'boolean', [
            'after' => 'sort',
            'signed' => false,
            'default' => true,
            'null' => false,
            'comment' => 'Print to document?'
        ]);

        $table->update();
    }
}
