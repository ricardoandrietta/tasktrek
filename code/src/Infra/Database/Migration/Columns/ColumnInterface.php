<?php

namespace TaskTrek\Infra\Database\Migration\Columns;

interface ColumnInterface
{
    public static function create(string $name): static;
    public function getLength(): int;
    public function length(int $length): static;
    public function getAllowNull(): bool;
    public function allowNull(bool $allowNull): static;
    public function getDefault(): string;
    public function default(string $default): static;
    public function getName(): string;
    public function getComment(): string;
    public function comment(string $comment): static;
    public function getAfter(): string;
    public function after(string $after): static;
}
