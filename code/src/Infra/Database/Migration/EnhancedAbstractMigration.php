<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Database\Migration;

use Phinx\Migration\AbstractMigration;
use TaskTrek\Infra\Database\Migration\Table\EnhancedTable;

abstract class EnhancedAbstractMigration extends AbstractMigration
{
    public function table(string $tableName, array $options = []): EnhancedTable
    {
        if (!array_key_exists('id', $options)) {
            $options['id'] = false;
        }
        return new EnhancedTable($tableName, $options, $this->getAdapter());
    }

}
