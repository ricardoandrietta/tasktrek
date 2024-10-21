<?php

namespace TaskTrek\Infra\Database\Migration\Columns;

interface ColumnInterface
{
    public static function create(string $name): self;
    public function getLength(): int;
    public function length(int $length): ColumnInterface;
    public function getAllowNull(): bool;
    public function allowNull(bool $allowNull): ColumnInterface;
    public function getDefault(): string;
    public function default(string $default): ColumnInterface;
    public function getName(): string;
    public function getComment(): string;
    public function comment(string $comment): ColumnInterface;
    public function getAfter(): string;
    public function after(string $after): ColumnInterface;
}
