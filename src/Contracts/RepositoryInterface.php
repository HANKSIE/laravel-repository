<?php
namespace Hanksie\Repository\Contracts;

interface RepositoryInterface
{
    public function create($payload);

    public function update(array $filters, $payload): bool;

    public function delete(array $filters): bool;

    public function get(array $columns, array $filters);

    public function first(array $filters);

    public function findBy(string $column, $value);

    public function find($value);

    public function exists(array $filters): bool;
}
