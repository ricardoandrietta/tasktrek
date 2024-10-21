<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Database\Migration\Columns;

abstract class AbstractColumn implements ColumnInterface
{
    protected int $length = 255;
    protected bool $allowNull = true;
    protected string $default = '';
    protected string $comment = '';
    protected string $after = '';
    protected bool $isFk = false;
    protected string|array $fkTable = '';
    protected string|array $fkColumn = '';

    public function __construct(protected readonly string $name)
    {
    }

    public static function create(string $name): static
    {
        return new static($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     *
     * @return ColumnInterface
     */
    public function length(int $length): ColumnInterface
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAllowNull(): bool
    {
        return $this->allowNull;
    }

    /**
     * @param bool $allowNull
     *
     * @return ColumnInterface
     */
    public function allowNull(bool $allowNull): ColumnInterface
    {
        $this->allowNull = $allowNull;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefault(): string
    {
        return $this->default;
    }

    /**
     * @param string $default
     *
     * @return ColumnInterface
     */
    public function default(string $default): ColumnInterface
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     *
     * @return ColumnInterface
     */
    public function comment(string $comment): ColumnInterface
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getAfter(): string
    {
        return $this->after;
    }

    /**
     * @param string $after
     *
     * @return ColumnInterface
     */
    public function after(string $after): ColumnInterface
    {
        $this->after = $after;
        return $this;
    }

    /**
     * Set column as Foreign Key
     *
     * @param string $table
     * @param string $column
     *
     * @return static
     */
    public function fkTo(string $table, string $column): static
    {
        $this->isFk = true;
        $this->fkTable = $table;
        $this->fkColumn = $column;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFk(): bool
    {
        return $this->isFk;
    }

    /**
     * @return string|array
     */
    public function getFkColumn(): string|array
    {
        return $this->fkColumn;
    }

    /**
     * @return string|array
     */
    public function getFkTable(): string|array
    {
        return $this->fkTable;
    }
}
