<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateDalamPelayananTable extends AbstractMigration
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
        $table = $this->table('dalam_pelayanan', ['engine' => 'InnoDB']);
        $table->addColumn('antrian_pelayanan_id', 'integer')
            ->addColumn('petugas_id', 'integer', ['null' => true])
            ->addColumn('tanggal_panggil', 'date', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => null, 'null' => true]);
    }
}
