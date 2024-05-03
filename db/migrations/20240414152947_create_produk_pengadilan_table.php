<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProdukPengadilanTable extends AbstractMigration
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
        $table = $this->table('produk_pengadilan', ['engine' => 'InnoDB']);
        $table
            ->addColumn('antrian_pelayanan_id', 'integer', ['limit' => 12])
            ->addColumn('nomor_perkara', 'string', ['limit' => 32])
            ->addColumn('nomor_akta_cerai', 'string', ['limit' => 32, 'null' => true])
            ->addColumn('pihak_id', 'integer', ['limit' => 12, 'null' => true])
            ->addColumn('jenis_perkara', 'string', ['limit' => 64, 'null' => true])
            ->addColumn('tahun_perkara', 'integer', ['limit' => 4, 'null' => true])
            ->addColumn('nama_pengambil', 'string', ['limit' => 512, 'null' => true])
            ->addColumn('foto_pengambil', 'string', ['limit' => 64, 'null' => true])
            ->addColumn('jenis_pihak', 'string', ['limit' => 12, 'null' => true])
            ->addColumn('jenis_produk', 'string', ['limit' => 64, 'null' => true])
            ->addColumn('status', 'integer', ['limit' => 1, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['default' =>   'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['null' => true])
            ->create();
    }
}
