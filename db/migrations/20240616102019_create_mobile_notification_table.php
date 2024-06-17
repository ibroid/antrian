<?php

declare(strict_types=1);

use Phinx\Db\Action\AddColumn;
use Phinx\Migration\AbstractMigration;

final class CreateMobileNotificationTable extends AbstractMigration
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
        $table = $this->table('mobile_notification');
        $table->addColumn('visitor_id', 'integer')
            ->addColumn('title', 'string')
            ->addColumn('body', 'string')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp')
            ->addColumn('action', 'enum', ['values' => [
                'none', 'open_url', 'call_function', 'open_modal', 'custom_js'
            ]])
            ->addColumn('action_param', 'string', ['null' => true, 'limit' => 255])
            ->create();
    }
}
