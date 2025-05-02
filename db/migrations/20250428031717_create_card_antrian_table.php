<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCardAntrianTable extends AbstractMigration
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
        $table = $this->table("card_antrian");
        // add foreign key to allowed_card reference to id
        $table->addColumn("allowed_card_id", "integer", [
            "null" => false,
            "comment" => "reference to allowed_card id",
        ]);

        $table->addColumn("antrian_id", "integer", [
            "null" => true,
            "comment" => "reference to antrian_sidang id",
        ]);
        $table->addColumn("relasi_antrian", "string", [
            "limit" => 16,
            "null" => false,
            "comment" => "menentukan tujuan table antrian_id yang digunakan",
        ]);
        // Add created_at and updated_at columns
        $table->addColumn("created_at", "timestamp", [
            "default" => "CURRENT_TIMESTAMP",
            "null" => false,
            "comment" => "Record creation timestamp",
        ]);
        $table->addColumn("updated_at", "timestamp", [
            "default" => "CURRENT_TIMESTAMP",
            "update" => "CURRENT_TIMESTAMP",
            "null" => false,
            "comment" => "Record update timestamp",
        ]);
        $table->save();
    }
}
