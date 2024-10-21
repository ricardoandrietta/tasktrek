<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Database\Migration\Columns;

class UUIDColumn extends AbstractColumn
{
    protected bool $identity = false;

    /**
     * Data will be stored as binary(16)
     * Use 'UUID_TO_BIN' to store with TRUE as second parameter
     * Use 'BIN_TO_UUID' to retrieve
     *
     * @return int
     */
    public function getLength(): int
    {
        return 16; //will be stored as binary(16)
    }

    /**
     * @return bool
     */
    public function isIdentity(): bool
    {
        return $this->identity;
    }

    /**
     * @param bool $identity
     *
     * @return UUIDColumn
     */
    public function identity(bool $identity = true): UUIDColumn
    {
        $this->identity = $identity;
        return $this;
    }
}
