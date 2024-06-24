<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSettingsTable extends AbstractMigration
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
        $table = $this->table("settings");
        $table->addColumn("key", 'string');
        $table->addColumn("value", 'string');
        $table->addColumn("level", 'enum', ['values' => ['Developer', 'Admin', 'Operator', 'User']]);
        $table->addColumn('description', 'text', ['limit' => 512]);
        $table->addColumn('crearted_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])->create();
    }
}
