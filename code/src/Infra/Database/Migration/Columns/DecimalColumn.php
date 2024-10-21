<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Database\Migration\Columns;

class DecimalColumn extends AbstractColumn
{
    protected int $precision = 10;
    protected int $scale = 2;
    protected bool $signed = false;

    /**
     * @return int
     */
    public function getPrecision(): int
    {
        return $this->precision;
    }

    /**
     * @param int $precision
     *
     * @return DecimalColumn
     */
    public function precision(int $precision): DecimalColumn
    {
        $this->precision = $precision;
        return $this;
    }

    /**
     * @return int
     */
    public function getScale(): int
    {
        return $this->scale;
    }

    /**
     * @param int $scale
     *
     * @return DecimalColumn
     */
    public function scale(int $scale): DecimalColumn
    {
        $this->scale = $scale;
        return $this;
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
     * @return $this
     */
    public function signed(bool $signed = true): DecimalColumn
    {
        $this->signed = $signed;
        return $this;
    }

}
