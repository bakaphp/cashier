<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Users extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Compact']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_BIG, 'precision' => 19, 'identity' => 'enable'])
            ->addColumn('email', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'key'])
            ->addColumn('password', 'string', ['null' => true, 'limit' => 255, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'email'])
            ->addColumn('firstname', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'password'])
            ->addColumn('lastname', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'firstname'])
            ->addColumn('user_role', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'lastname'])
            ->addColumn('default_company', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'user_role'])
            ->addColumn('displayname', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'default_company'])
            ->addColumn('registered', 'datetime', ['null' => true, 'after' => 'displayname'])
            ->addColumn('lastvisit', 'datetime', ['null' => true, 'after' => 'registered'])
            ->addColumn('sex', 'char', ['null' => true, 'limit' => 1, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'lastvisit'])
            ->addColumn('timezone', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'sex'])
            ->addColumn('city_id', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'timezone'])
            ->addColumn('state_id', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'city_id'])
            ->addColumn('country_id', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'state_id'])
            ->addColumn('system_modules_id', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'country_id'])
            ->addColumn('profile_privacy', 'char', ['null' => true, 'limit' => 1, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'system_modules_id'])
            ->addColumn('profile_image', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'profile_privacy'])
            ->addColumn('profile_header', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'profile_image'])
            ->addColumn('profile_header_mobile', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'profile_header'])
            ->addColumn('user_active', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'profile_header_mobile'])
            ->addColumn('user_login_tries', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'user_active'])
            ->addColumn('user_last_loging_try', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'user_login_tries'])
            ->addColumn('session_time', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'user_last_loging_try'])
            ->addColumn('session_page', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'session_time'])
            ->addColumn('welcome', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'session_page'])
            ->addColumn('user_activation_key', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'welcome'])
            ->addColumn('user_activation_email', 'string', ['null' => true, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'user_activation_key'])
            ->addColumn('user_activation_forgot', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'user_activation_email'])
            ->addColumn('language', 'string', ['null' => true, 'limit' => 5, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'user_activation_forgot'])
            ->addColumn('banned', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'language'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'banned'])
            ->addColumn('created_at', 'datetime', ['null' => true, 'after' => 'updated_at'])
            ->addColumn('status', 'integer', ['null' => false, 'default' => '1', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'boolean', ['null' => true, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'status'])
            ->save();

        $table = $this->table('users');
        $table->addColumn('roles_id', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'lastname'])->save();
        $table->save();
        if ($this->table('users')->hasColumn('user_role')) {
            $this->table('users')->removeColumn('user_role')->update();
        }

        $table = $this->table('users');
        $table->addColumn('default_company_branch', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'default_company'])->save();
        $table->addColumn('dob', 'date', ['null' => true, 'after' => 'sex'])->save();


        $this->table('users')->changeColumn('password', 'string', ['null' => false, 'limit' => 255, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'email'])->update();
        $this->table('users')->changeColumn('firstname', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'password'])->update();
        $this->table('users')->changeColumn('lastname', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'firstname'])->update();
        $this->table('users')->changeColumn('displayname', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'roles_id'])->update();

        $this->execute('UPDATE users set roles_id = 1;');
        $this->execute("ALTER TABLE `users` CHANGE COLUMN `roles_id` `roles_id` INT(11) NOT NULL DEFAULT '1' AFTER `lastname`;");
        $this->execute("ALTER TABLE `users` CHANGE COLUMN `sex` `sex` ENUM('U', 'M', 'F') NULL DEFAULT 'U' COLLATE 'utf8mb4_unicode_ci' AFTER `lastvisit`;");
        $this->execute("ALTER TABLE `users` CHANGE COLUMN `timezone` `timezone` VARCHAR(128) NULL DEFAULT 'America/New_York' COLLATE 'utf8mb4_unicode_ci' AFTER `dob`;");

        $this->table('users')->changeColumn('city_id', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_MEDIUM, 'precision' => 7, 'signed' => false, 'after' => 'default_company_branch'])->update();
        $this->table('users')->changeColumn('state_id', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'signed' => false, 'after' => 'city_id'])->update();
        $this->table('users')->changeColumn('country_id', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_SMALL, 'precision' => 5, 'signed' => false, 'after' => 'state_id'])->update();
        $this->execute("ALTER TABLE `users` CHANGE COLUMN `profile_privacy` `profile_privacy` TINYINT(1) NULL DEFAULT '0' COLLATE 'utf8mb4_unicode_ci' AFTER `timezone`;");
        $this->execute('ALTER TABLE `users` CHANGE COLUMN `user_last_loging_try` `user_last_login_try` INT(11) NULL DEFAULT NULL AFTER `user_login_tries`;');
        $this->table('users')->changeColumn('profile_image', 'string', ['null' => true, 'limit' => 45, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'profile_privacy'])->update();
        $this->table('users')->changeColumn('profile_header', 'string', ['null' => true, 'limit' => 192, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'profile_image'])->update();
        $this->table('users')->changeColumn('profile_header_mobile', 'string', ['null' => true, 'limit' => 192, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'profile_header'])->update();
        $this->table('users')->changeColumn('user_active', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'profile_header_mobile'])->update();
        $this->table('users')->changeColumn('user_login_tries', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'user_active'])->update();
        $this->table('users')->changeColumn('user_last_login_try', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_BIG, 'precision' => 19, 'after' => 'user_login_tries'])->update();
        $this->table('users')->changeColumn('session_time', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_BIG, 'precision' => 19, 'after' => 'user_last_login_try'])->update();
        $this->table('users')->changeColumn('session_page', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'session_time'])->update();
        $this->table('users')->changeColumn('welcome', 'integer', ['null' => true, 'default' => '0', 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'session_page'])->update();
        $this->table('users')->changeColumn('user_activation_key', 'string', ['null' => true, 'limit' => 64, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'welcome'])->update();
        $this->table('users')->changeColumn('user_activation_email', 'string', ['null' => true, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'user_activation_key'])->update();
        $this->table('users')->changeColumn('user_activation_forgot', 'string', ['null' => true, 'limit' => 100, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'user_activation_email'])->update();
        $this->table('users')->changeColumn('language', 'string', ['null' => true, 'limit' => 5, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'user_activation_forgot'])->update();
        $this->execute('
        ALTER TABLE `users`
            ADD COLUMN `karma` INT(11) NULL DEFAULT NULL AFTER `banned`,
            ADD COLUMN `votes` INT(10) NULL DEFAULT NULL AFTER `karma`,
            ADD COLUMN `votes_points` INT(11) NULL DEFAULT NULL AFTER `votes`,
            ADD COLUMN `stripe_id` VARCHAR(255) NULL DEFAULT NULL AFTER `votes`,
            ADD COLUMN `card_last_four` VARCHAR(255) NULL DEFAULT NULL AFTER `stripe_id`,
            ADD COLUMN `card_brand` VARCHAR(255) NULL DEFAULT NULL AFTER `card_last_four`,
            ADD COLUMN `trial_ends_at` TIMESTAMP NULL DEFAULT NULL AFTER `card_brand`;
        ');
        $this->table('users')->changeColumn('karma', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'language'])->update();
        $this->table('users')->changeColumn('votes', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'signed' => false, 'after' => 'karma'])->update();
        $this->table('users')->changeColumn('votes_points', 'integer', ['null' => true, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'votes'])->update();
        $this->execute("ALTER TABLE `users` CHANGE COLUMN `banned` `banned` TINYINT(1) NULL DEFAULT '0' AFTER `votes_points`;");
        $this->table('users')->changeColumn('created_at', 'datetime', ['null' => true, 'after' => 'banned'])->update();
        $this->table('users')->changeColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])->update();
        $this->table('users')->changeColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'after' => 'updated_at'])->update();
        $table->save();

    }
}
