<?php

declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class CreateThermalPrinterListTable extends AbstractMigration
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
        $table = $this->table("thermal_printer_list");
        $table->addColumn("ip_address", "string", ["limit" => 15, 'null' => false]);
        $table->addColumn("port", "integer", ["limit" => 6, 'null' => false]);
        $table->addColumn("desc", "string", ["limit" => 191, 'null' => false]);
        $table->addColumn("active", "integer", ["limit" => MysqlAdapter::INT_TINY, 'null' => false]);
        $table->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp');
        $table->create();
    }
}
