<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Apps extends AbstractMigration
{
    public function change()
    {

        $table = $this->table('apps', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8', 'collation' => 'utf8_general_ci', 'comment' => '', 'row_format' => 'Compact']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'identity' => 'enable'])
            ->addColumn('name', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8_general_ci', 'encoding' => 'utf8', 'after' => 'id'])
            ->addColumn('description', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8_general_ci', 'encoding' => 'utf8', 'after' => 'name'])
            ->addColumn('created_at', 'datetime', ['null' => true, 'after' => 'description'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'updated_at'])
            ->save();

    }
}
