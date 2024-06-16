<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UpdateTableVisitor extends AbstractMigration
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
        $table = $this->table("visitor");
        $table->addColumn("remote_ip", "string", ["limit" => 45, "null" => true]);
        $table->addColumn("user_agent", "string", ["limit" => 255, "null" => true]);
        $table->addColumn("country_id", "string", ["null" => true, "limit" => 4]);
        $table->addColumn("device", "string", ["null" => true, "limit" => 64]);
        $table->update();
    }
}
