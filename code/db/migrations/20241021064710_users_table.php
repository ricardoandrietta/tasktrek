<?php

declare(strict_types=1);

use TaskTrek\Core\Infra\Database\Migration\Columns\CentralColumn;
use TaskTrek\Core\Infra\Database\Migration\Columns\EnumColumn;
use TaskTrek\Core\Infra\Database\Migration\Columns\IntegerColumn;
use TaskTrek\Core\Infra\Database\Migration\Columns\StringColumn;
use TaskTrek\Core\Infra\Database\Migration\Columns\UUIDColumn;
use TaskTrek\Core\Infra\Database\Migration\EnhancedAbstractMigration;

final class UsersTable extends EnhancedAbstractMigration
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
        $this->table('users', ['primary_key' => 'user_id'])
            ->column(IntegerColumn::create('user_id')->identity())
            ->column(UUIDColumn::create('user_uuid')->unique()->allowNull(false))
            ->column(
                StringColumn::create('name')
                    ->length(100)
                    ->allowNull(false)
            )
            ->column(
                StringColumn::create('email')
                    ->length(320)
                    ->allowNull(false)
            )
            ->column(
                StringColumn::create('timezone')
                    ->length(100)
                    ->allowNull(false)
            )
            ->column(
                EnumColumn::create('language')
                    ->setValues(['en'])
                    ->default('en')
            )
            ->column(CentralColumn::create('central'))
            ->create();
    }
}
