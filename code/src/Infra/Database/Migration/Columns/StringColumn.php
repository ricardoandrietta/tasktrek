<?php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Database\Migration\Columns;

class StringColumn extends AbstractColumn
{
    protected string $collation = 'utf8mb4_unicode_ci';
    protected string $encoding = 'utf8mb4';

    /**
     * @return string
     */
    public function getCollation(): string
    {
        return $this->collation;
    }

    /**
     * @param string $collation
     *
     * @return StringColumn
     */
    public function collation(string $collation): StringColumn
    {
        $this->collation = $collation;
        return $this;
    }

    /**
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     *
     * @return StringColumn
     */
    public function encoding(string $encoding): StringColumn
    {
        $this->encoding = $encoding;
        return $this;
    }
}
