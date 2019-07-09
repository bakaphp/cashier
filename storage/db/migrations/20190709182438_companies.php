<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Companies extends AbstractMigration
{
    public function change()
    {

        $table = $this->table('companies', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8', 'collation' => 'utf8_general_ci', 'comment' => '					', 'row_format' => 'Compact']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'identity' => 'enable'])
            ->addColumn('name', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8_general_ci', 'encoding' => 'utf8', 'after' => 'id'])
            ->addColumn('profile_image', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8_general_ci', 'encoding' => 'utf8', 'after' => 'name'])
            ->addColumn('website', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8_general_ci', 'encoding' => 'utf8', 'after' => 'profile_image'])
            ->addColumn('users_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'website'])
            ->addColumn('created_at', 'datetime', ['null' => true, 'after' => 'users_id'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'updated_at'])
            ->save();
        $table = $this->table('companies');
        if ($table->hasIndex('name')) {
            $table->removeIndexByName('name')->save();
        }
        $table = $this->table('companies');
        $table->addIndex(['name', 'users_id'], ['name' => 'name', 'unique' => true])->save();
        $table = $this->table('companies');
        if ($table->hasIndex('users_id')) {
            $table->removeIndexByName('users_id')->save();
        }
    }
}
