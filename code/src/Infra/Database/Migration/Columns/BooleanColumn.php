<?php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Database\Migration\Columns;

class BooleanColumn extends AbstractColumn
{
    protected bool $unsigned = false;

    /**
     * @return bool
     */
    public function isUnsigned(): bool
    {
        return $this->unsigned;
    }

    /**
     * @param bool $unsigned
     *
     * @return BooleanColumn
     */
    public function unsigned(bool $unsigned): BooleanColumn
    {
        $this->unsigned = $unsigned;
        return $this;
    }
}
