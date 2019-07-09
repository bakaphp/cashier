<?php

use Phinx\Seed\AbstractSeed;
use Phalcon\Security\Random;

class UsersSeeder extends AbstractSeed
{
    public function run()
    {
        $random = new Random();

        $data = [
            [
                'user_activation_email' => $random->uuid(),
                'email' => 'nobody@baka.io',
                'password' => password_hash('bakatest123567', PASSWORD_DEFAULT),
                'firstname' => 'Baka',
                'lastname' => 'Idiot',
                'default_company' => 1,
                'displayname' => 'nobody',
                'system_modules_id' => 2,
                'default_company_branch' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 1,
                'user_active' => 1,
                'is_deleted' => 0
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();

    }
}
