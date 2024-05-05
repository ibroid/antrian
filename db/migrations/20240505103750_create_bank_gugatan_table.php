<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateBankGugatanTable extends AbstractMigration
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
        $table = $this->table('bank_gugatan');

        $table
            ->addColumn('identitas_pihak_id', 'integer')
            ->addColumn('nama_pihak', 'string', ['length' => 191, 'null' => false])
            ->addColumn('filename', 'string')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
}
