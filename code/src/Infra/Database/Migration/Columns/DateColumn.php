<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Database\Migration\Columns;

class DateColumn extends AbstractColumn
{
    public function setNowAsDefault(): self
    {
        $this->default(date('Y-m-d'));
        return $this;
    }
}
