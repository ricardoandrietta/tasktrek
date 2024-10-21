<?php

declare(strict_types=1);

use TaskTrek\Infra\Database\Migration\Columns\CentralColumn;
use TaskTrek\Infra\Database\Migration\Columns\StringColumn;
use TaskTrek\Infra\Database\Migration\Columns\TextColumn;
use TaskTrek\Infra\Database\Migration\Columns\TimestampColumn;
use TaskTrek\Infra\Database\Migration\Columns\UUIDColumn;
use TaskTrek\Infra\Database\Migration\EnhancedAbstractMigration;

final class ProjectsTable extends EnhancedAbstractMigration
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
        $this->table('projects', ['primary_key' => 'project_id'])
            ->column(UUIDColumn::create('project_id')->identity())
            ->column(UUIDColumn::create('user_id')->allowNull(false)->fkTo('users', 'user_id'))
            ->column(
                StringColumn::create('name')
                    ->allowNull(false)
                    ->length(255)
            )
            ->column(TextColumn::create('description'))
            ->column(TimestampColumn::create('due_date')->allowNull(false))
            ->column(CentralColumn::create('central'))
            ->create();
    }
}
