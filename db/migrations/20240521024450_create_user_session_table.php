<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserSessionTable extends AbstractMigration
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
        $table = $this->table('user_session');
        $table->addColumn('user_id', 'integer', ['null' => false]);
        $table->addColumn('session_id', 'string', ['null' => false, 'length' =>  128]);
        $table->addColumn('device', 'string', ['length' => 191]);
        $table->addColumn('expiration_time', 'datetime');
        $table->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
}
