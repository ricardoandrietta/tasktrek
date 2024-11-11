<?php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Database\Migration\Columns;

class IntegerColumn extends AbstractColumn
{

    protected bool $identity = false;
    protected bool $signed = false;

    /**
     * @param bool $identity
     *
     * @return $this
     */
    public function identity(bool $identity = true): self
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isIdentity(): ?bool
    {
        return $this->identity;
    }

    /**
     * @return bool
     */
    public function isSigned(): bool
    {
        return $this->signed;
    }

    /**
     * @param bool $signed
     *
     * @return IntegerColumn
     */
    public function signed(bool $signed = true): IntegerColumn
    {
        $this->signed = $signed;
        return $this;
    }
}
