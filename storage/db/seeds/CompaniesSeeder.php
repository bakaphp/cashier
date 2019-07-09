<?php

use Phinx\Seed\AbstractSeed;
use Phalcon\Security\Random;

class CompaniesSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'name' => 'Canvas',
                'users_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'is_deleted' => 0
            ], [
                'name' => 'CRM',
                'users_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'is_deleted' => 0
            ],
        ];

        $table = $this->table('companies');
        $table->insert($data)->save();

    }
}
