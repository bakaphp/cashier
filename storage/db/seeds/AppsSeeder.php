<?php

use Phinx\Seed\AbstractSeed;
use Phalcon\Security\Random;

class AppsSeeder extends AbstractSeed
{
    public function run()
    {
        //add default languages
        $data = [
            [
                'name' => 'Default',
                'description' => 'Gewaer Ecosystem',
                'created_at' => date('Y-m-d H:i:s'),
                'is_deleted' => 0
            ], [
                'name' => 'CRM',
                'description' => 'CRM App',
                'created_at' => date('Y-m-d H:i:s'),
                'is_deleted' => 0
            ]
        ];

        $table = $this->table('apps');
        $table->insert($data)->save();
    }
}
