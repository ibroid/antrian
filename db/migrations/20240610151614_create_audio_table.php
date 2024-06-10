<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateAudioTable extends AbstractMigration
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
        $table  = $this->table("audio");

        $table->addColumn("filename", "string");
        $table->addColumn("title", "string");
        $table->addColumn("is_playing", "enum", ["values" => ["yes", "no"]]);
        $table->addColumn("nama_ketua_penutup", "enum", ["values" => ["yes", "no"]]);
        $table->addColumn("created_at", "timestamp", ["default" => "CURRENT_TIMESTAMP"])->addColumn("updated_at", "timestamp", ["null" => true])->create();
    }
}
