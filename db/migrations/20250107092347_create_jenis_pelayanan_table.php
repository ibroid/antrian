<?php

declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class CreateJenisPelayananTable extends AbstractMigration
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
        $table = $this->table("jenis_pelayanan");
        $table->addColumn("nama_layanan", "string", ["length" => 32]);
        $table->addColumn("kode_layanan", "string", ["length" => 2]);
        $table->addColumn("support_picker", "integer", [
            'limit' => MysqlAdapter::INT_TINY,
            'length' => 1
        ]);
        $table
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
}
