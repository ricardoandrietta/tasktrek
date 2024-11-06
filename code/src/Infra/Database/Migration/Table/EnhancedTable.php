<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Database\Migration\Table;

use Phinx\Db\Table;
use Phinx\Util\Literal;
use TaskTrek\Infra\Database\Migration\Columns\BooleanColumn;
use TaskTrek\Infra\Database\Migration\Columns\CentralColumn;
use TaskTrek\Infra\Database\Migration\Columns\ColumnInterface;
use TaskTrek\Infra\Database\Migration\Columns\DateColumn;
use TaskTrek\Infra\Database\Migration\Columns\DateTimeColumn;
use TaskTrek\Infra\Database\Migration\Columns\DecimalColumn;
use TaskTrek\Infra\Database\Migration\Columns\EnumColumn;
use TaskTrek\Infra\Database\Migration\Columns\IntegerColumn;
use TaskTrek\Infra\Database\Migration\Columns\JsonColumn;
use TaskTrek\Infra\Database\Migration\Columns\StringColumn;
use TaskTrek\Infra\Database\Migration\Columns\TextColumn;
use TaskTrek\Infra\Database\Migration\Columns\TimestampColumn;
use TaskTrek\Infra\Database\Migration\Columns\UUIDColumn;

final class EnhancedTable extends Table
{
    public const string BOOLEAN = 'boolean';
    public const string DATE = 'date';
    public const string DATETIME = 'datetime';
    public const string DECIMAL = 'decimal';
    public const string ENUM = 'enum';
    public const string INTEGER  = 'integer';
    public const string JSON  = 'json';
    public const string STRING = 'string';
    public const string TEXT  = 'text';
    public const string TIMESTAMP  = 'timestamp';
    public const string UUID = 'char';

    /**
     * @param ColumnInterface $column
     *
     * @return EnhancedTable
     */
    public function column(ColumnInterface $column): self
    {
        $output = match (true) {
            $column instanceof BooleanColumn => $this->addBooleanColumn($column),
            $column instanceof CentralColumn => $this->addCentralColumns($column),
            $column instanceof DateColumn => $this->addDateColumn($column),
            $column instanceof DateTimeColumn => $this->addDateTimeColumn($column),
            $column instanceof DecimalColumn => $this->addDecimalColumn($column),
            $column instanceof EnumColumn => $this->addEnumColumn($column),
            $column instanceof IntegerColumn => $this->addIntegerColumn($column),
            $column instanceof JsonColumn => $this->addJsonColumn($column),
            $column instanceof StringColumn => $this->addStringColumn($column),
            $column instanceof TextColumn => $this->addTextColumn($column),
            $column instanceof TimestampColumn => $this->addTimestampColumn($column),
            $column instanceof UUIDColumn => $this->addUUIDColumn($column),
            default => $this
        };

        if ($column->isFk()) {
            $this->addForeignKey($column->getName(), $column->getFkTable(), $column->getFkColumn());
        }

        if ($column->isUnique()) {
            $this->addIndex($column->getName(), ['unique' => true]);
        }

        return $output;
    }

    /**
     * @param ColumnInterface $column
     *
     * @return array{limit: string, null: string, after: string, comment: string, default: string}
     */
    private function getBasicOptions(ColumnInterface $column): array
    {
        $options = [];
        if (!empty($column->getLength())) {
            $options['limit'] = $column->getLength();
        }

        if (!empty($column->getAllowNull())) {
            $options['null'] = $column->getAllowNull();
        }

        if (!empty($column->getAfter())) {
            $options['after'] = $column->getAfter();
        }

        if (!empty($column->getComment())) {
            $options['comment'] = $column->getComment();
        }

        if (!empty($column->getDefault())) {
            $options['default'] = $column->getDefault();
        }
        return $options;
    }

    /**
     * @param BooleanColumn $column
     *
     * @return $this
     */
    protected function addBooleanColumn(BooleanColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        $options['signed'] = $column->isUnsigned();
        $this->addColumn($column->getName(), self::BOOLEAN, $options);
        return $this;
    }

    /**
     * @param DateColumn $column
     *
     * @return $this
     */
    protected function addDateColumn(DateColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        $this->addColumn($column->getName(), self::DATE, $options);
        return $this;
    }

    /**
     * @param DateTimeColumn $column
     *
     * @return $this
     */
    protected function addDateTimeColumn(DateTimeColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        $this->addColumn($column->getName(), self::DATETIME, $options);
        return $this;
    }

    /**
     * @param DecimalColumn $column
     *
     * @return $this
     */
    protected function addDecimalColumn(DecimalColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        $options['precision'] = $column->getPrecision();
        $options['scale'] = $column->getScale();
        $options['signed'] = $column->isSigned();

        $this->addColumn($column->getName(), self::DECIMAL, $options);
        return $this;
    }

    /**
     * @param EnumColumn $column
     *
     * @return $this
     */
    protected function addEnumColumn(EnumColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        $options['values'] = $column->getValues();

        $this->addColumn($column->getName(), self::ENUM, $options);
        return $this;
    }

    /**
     * @param IntegerColumn $column
     *
     * @return $this
     */
    protected function addIntegerColumn(IntegerColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        $options['signed'] = $column->isSigned();
        if ($column->isIdentity()) {
            $options['identity'] = $column->isIdentity();
            $options['null'] = false;
            $options['signed'] = false;
        }

        $this->addColumn($column->getName(), self::INTEGER, $options);
        return $this;
    }

    /**
     * @param JsonColumn $column
     *
     * @return $this
     */
    protected function addJsonColumn(JsonColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        $this->addColumn($column->getName(), self::JSON, $options);
        return $this;
    }

    /**
     * @param TimestampColumn $column
     *
     * @return $this
     */
    protected function addTimestampColumn(TimestampColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        unset($options['limit']);
        if ($column->isNowAsDefault()) {
            $options['default'] = 'CURRENT_TIMESTAMP';
        }
        $this->addColumn($column->getName(), self::TIMESTAMP, $options);
        return $this;
    }

    /**
     * @param StringColumn $column
     *
     * @return $this
     */
    protected function addStringColumn(StringColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        $options['collation'] = $column->getCollation();
        $options['encoding'] = $column->getEncoding();
        $this->addColumn($column->getName(), self::STRING, $options);
        return $this;
    }

    /**
     * @param UUIDColumn $column
     *
     * @return $this
     */
    protected function addUUIDColumn(UUIDColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        if (!empty($column->getDefault())) {
            $options['default'] = Literal::from($column->getDefault());
        }

        if ($column->isIdentity()) {
            $this->addIndex($column->getName(), ['unique' => true]);
            $options['null'] = false;
        }

        $this->addColumn($column->getName(), self::UUID, $options);
        return $this;
    }

    /**
     * @param CentralColumn $column
     * @param string $usersTableName
     * @param string $usersIdColumn
     *
     * @return $this
     */
    protected function addCentralColumns(
        CentralColumn $column,
        string $usersTableName = 'users',
        string $usersIdColumn = 'user_id'
    ): self {
        $allowNull = false;
        if ($this->getTable()->getName() === $usersTableName) {
            $allowNull = true;
        }
        $this->column(
            IntegerColumn::create($column->getCreatedBy())
                          ->allowNull($allowNull)
                          ->fkTo($usersTableName, $usersIdColumn)
        );
        $this->column(
            IntegerColumn::create($column->getUpdatedBy())
                          ->allowNull()
                          ->fkTo($usersTableName, $usersIdColumn)
        );
        $this->column(
            IntegerColumn::create($column->getDeletedBy())
                          ->allowNull()
                          ->fkTo($usersTableName, $usersIdColumn)
        );
        $this->column(TimestampColumn::create($column->getCreatedAt())->allowNull($allowNull));
        $this->column(TimestampColumn::create($column->getUpdatedAt())->allowNull());
        $this->column(TimestampColumn::create($column->getDeletedAt())->allowNull());

        return $this;
    }

    /**
     * @param TextColumn $column
     *
     * @return $this
     */
    protected function addTextColumn(TextColumn $column): self
    {
        $options = $this->getBasicOptions($column);
        $this->addColumn($column->getName(), self::TEXT, $options);
        return $this;
    }
}
