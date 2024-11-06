<?php

declare(strict_types=1);

use TaskTrek\Infra\Database\Migration\Columns\CentralColumn;
use TaskTrek\Infra\Database\Migration\Columns\IntegerColumn;
use TaskTrek\Infra\Database\Migration\Columns\StringColumn;
use TaskTrek\Infra\Database\Migration\Columns\UUIDColumn;
use TaskTrek\Infra\Database\Migration\EnhancedAbstractMigration;

final class AuthTable extends EnhancedAbstractMigration
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
        $this->table('auth', ['primary_key' => 'auth_id'])
            ->column(IntegerColumn::create('auth_id')->identity())
            ->column(UUIDColumn::create('auth_uuid')->unique()->allowNull(false))
            ->column(IntegerColumn::create('user_id')->allowNull(false)->fkTo('users', 'user_id'))
            ->column(
                StringColumn::create('password')
                    ->allowNull(false)
                    ->length(50)
            )
            ->column(CentralColumn::create('central'))
            ->create();
    }
}
