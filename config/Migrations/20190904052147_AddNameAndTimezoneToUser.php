<?php
use Migrations\AbstractMigration;

class AddNameAndTimezoneToUser extends AbstractMigration
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
        $table = $this->table('users');

        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);

        $table->addColumn('location', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);

        $table->addColumn('timezone', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);

        $table->addColumn('about', 'text', [
            'default' => null,
            'null' => false,
        ]);

        $table->update();
    }
}
