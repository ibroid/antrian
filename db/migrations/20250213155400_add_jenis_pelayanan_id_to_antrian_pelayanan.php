<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddJenisPelayananIdToAntrianPelayanan extends AbstractMigration
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
        $table = $this->table("antrian_pelayanan");
        $table->addColumn("jenis_pelayanan_id", "integer");
        $table->addColumn("mulai_panggil", "timestamp");
        $table->addColumn("selesai_panggil", "timestamp");
        $table->addColumn("waktu_tunggu", "string", ["length" => 12]);
        $table->update();
    }
}
