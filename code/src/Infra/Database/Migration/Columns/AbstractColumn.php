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

    /**
     * Use this to mark the column as Foreign Key
     * @var bool $isFk
     */
    protected bool $isFk = false;

    /**
     * Use this to add a unique index to the column
     * @var bool $unique
     */
    protected bool $unique = false;
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
     * @return static
     */
    public function length(int $length): static
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
     * @return static
     */
    public function allowNull(bool $allowNull = true): static
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
     * @return static
     */
    public function default(string $default): static
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
     * @return static
     */
    public function comment(string $comment): static
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
     * @return static
     */
    public function after(string $after): static
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

    /**
     * @return bool
     */
    public function isUnique(): bool
    {
        return $this->unique;
    }

    /**
     * @param bool $unique
     *
     * @return AbstractColumn
     */
    public function unique(bool $unique = true): AbstractColumn
    {
        $this->unique = $unique;
        return $this;
    }
}
