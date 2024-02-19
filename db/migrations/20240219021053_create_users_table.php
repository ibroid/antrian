<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('users', ['engine' => 'InnoDB']);
        $table->addColumn('sipp_user_id', 'integer', ['null' => true])
            ->addColumn('identifier', 'string', ['limit' => 16])
            ->addColumn('salt', 'string', ['limit' => 12, 'null' => true])
            ->addColumn('password', 'string', ['limit' => 191])
            ->addColumn('name', 'string', ['limit' => 64, 'null' => true])
            ->addColumn('avatar', 'string', ['limit' => 24, 'null' => true])
            ->addColumn('role_id', 'integer', ['limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['identifier'], ['unique' => true])
            ->create();
    }
}
