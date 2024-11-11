<?php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Database\Migration\Columns;

class TimestampColumn extends AbstractColumn
{
    protected bool $nowAsDefault = false;

    /**
     * @param bool $nowAsDefault
     *
     * @return TimestampColumn
     */
    public function nowAsDefault(bool $nowAsDefault = true): self
    {
        $this->nowAsDefault = $nowAsDefault;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNowAsDefault(): bool
    {
        return $this->nowAsDefault;
    }
}
