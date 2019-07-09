<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Subscriptions extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('subscriptions', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'identity' => 'enable'])
            ->addColumn('user_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'id'])
            ->addColumn('companies_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'user_id'])
            ->addColumn('apps_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'companies_id'])
            ->addColumn('payment_frequency_id', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'apps_id'])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 250, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'payment_frequency_id'])
            ->addColumn('stripe_id', 'string', ['null' => false, 'limit' => 250, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'name'])
            ->addColumn('stripe_plan', 'string', ['null' => false, 'limit' => 250, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'stripe_id'])
            ->addColumn('quantity', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'stripe_plan'])
            ->addColumn('trial_ends_at', 'timestamp', ['null' => true, 'after' => 'quantity'])
            ->addColumn('trial_ends_days', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'trial_ends_at'])
            ->addColumn('is_freetrial', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'trial_ends_days'])
            ->addColumn('is_active', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'is_freetrial'])
            ->addColumn('paid', 'integer', ['null' => true, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'is_active'])
            ->addColumn('charge_date', 'datetime', ['null' => true, 'after' => 'paid'])
            ->addColumn('ends_at', 'timestamp', ['null' => true, 'after' => 'is_active'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'ends_at'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->save();

        $table = $this->table('subscriptions');
        $table->addColumn('apps_plans_id', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'apps_id'])->save();
        $this->table('subscriptions')->changeColumn('name', 'string', ['null' => false, 'limit' => 250, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'apps_plans_id'])->update();
        $this->table('subscriptions')->changeColumn('stripe_id', 'string', ['null' => false, 'limit' => 250, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'name'])->update();
        $this->table('subscriptions')->changeColumn('stripe_plan', 'string', ['null' => false, 'limit' => 250, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'stripe_id'])->update();
        $this->table('subscriptions')->changeColumn('quantity', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'stripe_plan'])->update();
        $this->table('subscriptions')->changeColumn('trial_ends_at', 'timestamp', ['null' => true, 'after' => 'quantity'])->update();
        $this->table('subscriptions')->changeColumn('ends_at', 'timestamp', ['null' => true, 'after' => 'trial_ends_at'])->update();
        $table->save();

    }
}
