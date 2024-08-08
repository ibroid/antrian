<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateKunjunganTable extends AbstractMigration
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
        $table = $this->table("kunjungan");
        $table->addColumn(
            "tanggal_kunjungan",
            "date"
        )
            ->addColumn("pengunjung_id", "integer")
            ->addColumn("status_pengunjung", "string")
            ->addColumn("tujuan_kunjungan", "string")
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp')->save();
    }
}
