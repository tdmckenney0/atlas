<?php
use Migrations\AbstractSeed;

/**
 * Nodes seed.
 */
class NodesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 'cf3df853-6bec-4f7a-bdd4-32a3b96b0731',
                'parent_id' => NULL,
                'lft' => '1',
                'rght' => '2',
                'name' => 'Welcome to the Atlas!',
                'description' => 'This is a node. You can add more nodes to this node, upload a file, add text, or comment below!',
                'created' => '2021-05-16 04:38:52',
                'modified' => '2021-05-16 04:38:52',
            ],
        ];

        $table = $this->table('nodes');
        $table->insert($data)->save();
    }
}
