<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePengunjungTable extends AbstractMigration
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
        $table = $this->table('pengunjung');
        $table
            ->addColumn('nama_lengkap', 'string', ['null' => false, 'length' => 191])
            ->addColumn('nik', 'string', ['null' => false, 'length' => 16])
            ->addColumn('alamat', 'text')
            ->addColumn('jenis_kelamin', 'string', ['length' => 16, 'null' => false])
            ->addColumn('tempat_lahir', 'string', ['length' => 64])
            ->addColumn('tanggal_lahir', 'date')
            ->addColumn('foto', 'string', ['length' => 64])
            ->addColumn('ktp', 'string', ['length' => 64])
            ->addColumn('pendidikan', 'string', ['length' => 92])
            ->addColumn('pekerjaan', 'string', ['length' => 92])
            ->addColumn('kelurahan', 'string', ['length' => 92])
            ->addColumn('kecamatan', 'string', ['length' => 92])
            ->addColumn('kota', 'string', ['length' => 92])
            ->addColumn('provinsi', 'string', ['length' => 92])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['nik'], ['unique' => true])
            ->addColumn('updated_at', 'timestamp')->save();
    }
}
