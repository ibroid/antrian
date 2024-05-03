<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateAntrianPelayananTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('antrian_pelayanan', ['engine' => 'InnoDB']);
        $table
            ->addColumn('nomor_urutan', 'integer')
            ->addColumn('tujuan', 'string', ['limit' => 64])
            ->addColumn('kode', 'string', ['limit' => 1])
            ->addColumn('status', 'integer', ['limit' => 2])
            ->addColumn('petugas_id', 'integer', ['limit' => 12])
            ->addColumn('durasi_pelayanan', 'string', ['limit' => 12])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => null, 'null' => true])
            ->create();
    }
}
