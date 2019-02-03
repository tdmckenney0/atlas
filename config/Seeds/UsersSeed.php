<?php
use Migrations\AbstractSeed;
use \Cake\Auth\DefaultPasswordHasher;
/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'id' => '1',
                'email' => 'root@xenolithgames.com',
                'password' => (new DefaultPasswordHasher)->hash('root'),
                'created' => '2019-01-29 08:26:00',
                'modified' => '2019-01-29 08:26:00',
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
