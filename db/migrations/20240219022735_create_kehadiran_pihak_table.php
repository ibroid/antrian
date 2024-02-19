<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateKehadiranPihakTable extends AbstractMigration
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
        $table = $this->table('kehadiran_pihak', ['engine' => 'InnoDB']);
        $table->addColumn('antrian_persidangan_id', 'integer')
            ->addColumn('pihak', 'string', ['limit' => 191, 'null' => true])
            ->addColumn('sebagai', 'string', ['limit' => 5, 'null' => true])
            ->addColumn('status', 'integer', ['limit' => 2, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => null, 'null' => true])
            ->create();
    }
}
