<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateAllowedCardTable extends AbstractMigration
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
        $table = $this->table("allowed_card");
        $table->addColumn("rf_id", "string", [
            "limit" => 12,
            "null" => false,
            "comment" => "RFID card number",
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
        // add unique index for rf_id
        $table->addIndex("rf_id", [
            "unique" => true,
            "name" => "idx_allowed_card_rf_id",
        ]);
        $table->save();
    }
}
