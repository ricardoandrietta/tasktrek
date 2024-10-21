<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Database\Migration\Columns;

class DateTimeColumn extends AbstractColumn
{
    public function setNowAsDefault(): self
    {
        $this->default(date('Y-m-d H:i:s'));
        return $this;
    }
}
