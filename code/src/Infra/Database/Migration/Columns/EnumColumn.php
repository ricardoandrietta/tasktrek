<?php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Database\Migration\Columns;

class EnumColumn extends AbstractColumn
{
    protected array $values = [];

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array $values
     *
     * @return EnumColumn
     */
    public function setValues(array $values): EnumColumn
    {
        $this->values = $values;
        return $this;
    }
}
