<?php

declare(strict_types=1);

use TaskTrek\Core\Infra\Database\Migration\Columns\CentralColumn;
use TaskTrek\Core\Infra\Database\Migration\Columns\DecimalColumn;
use TaskTrek\Core\Infra\Database\Migration\Columns\EnumColumn;
use TaskTrek\Core\Infra\Database\Migration\Columns\IntegerColumn;
use TaskTrek\Core\Infra\Database\Migration\Columns\StringColumn;
use TaskTrek\Core\Infra\Database\Migration\Columns\TextColumn;
use TaskTrek\Core\Infra\Database\Migration\Columns\UUIDColumn;
use TaskTrek\Core\Infra\Database\Migration\EnhancedAbstractMigration;

final class TasksTable extends EnhancedAbstractMigration
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
        $this->table('tasks', ['primary_key' => 'task_id'])
            ->column(IntegerColumn::create('task_id')->identity())
            ->column(UUIDColumn::create('task_uuid')->unique()->allowNull(false))
            ->column(IntegerColumn::create('project_id')->allowNull(false)->fkTo('projects', 'project_id'))
            ->column(IntegerColumn::create('user_id')->allowNull(false)->fkTo('users', 'user_id'))
            ->column(
                StringColumn::create('name')
                    ->allowNull(false)
                    ->length(255)
            )
            ->column(TextColumn::create('description'))
            ->column(DecimalColumn::create('estimated_time'))
            ->column(
                EnumColumn::create('state_machine')
                    ->setValues(['pending', 'in_progress', 'done'])
                    ->default('pending')
            )
            ->column(IntegerColumn::create('execution_order')->allowNull(false))
            ->column(CentralColumn::create('central'))
            ->create();
    }
}
