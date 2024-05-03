<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLoketPelayananTable extends AbstractMigration
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
        $table = $this->table('loket_pelayanan', ['engine' => 'InnoDB']);
        $table
            ->addColumn('petugas_id', 'integer', ['limit' => 12])
            ->addColumn('urutan', 'integer', ['limit' => 2])
            ->addColumn('nama_loket', 'string', ['limit' => 64])
            ->addColumn(
                'status',
                'integer',
                ['limit' => 1, 'default' => 0]
            )
            ->addColumn(
                'antrian_pelayanan_id',
                'string',
                [
                    'limit' => 64,
                    'comment' => 'Antrian yang sedang dipanggil',
                    'null' => true
                ]
            )
            ->addColumn('warna_loket', 'string', ['limit' => 34, 'default' => 'secondary'])
            ->addColumn('kode_loket', 'string', ['limit' => 1, 'null' => false])
            ->addColumn('file_audio', 'string', ['limit' => 64, 'null' => false])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => null, 'null' => true])
            ->addIndex('petugas_id', ['unique' => true, 'name' => 'petugas_id_unique'])
            ->create();
    }
}
