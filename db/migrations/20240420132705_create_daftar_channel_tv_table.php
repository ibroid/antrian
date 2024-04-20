<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateDaftarChannelTvTable extends AbstractMigration
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
        $table = $this->table('daftar_channel_tv', ['engine' => 'InnoDB']);
        $table
            ->addColumn('nama_channel', 'string', ['limit' => 64])
            ->addColumn('url', 'string', ['limit' => 256])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('created_at', 'timestamp', ['default' => null, 'null' => true])
            ->addColumn('updated_at', 'timestamp', ['default' => null, 'null' => true])
            ->create();
    }
}
