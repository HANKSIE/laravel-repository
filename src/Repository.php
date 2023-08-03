<?php
namespace Hanksie\Repository;

use Hanksie\Repository\Contracts\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    protected function applyFilters($wheres, array $filters)
    {
        return collect($filters)->reduce(fn($wheres, $filter) => $filter->handle($wheres), $wheres);
    }
}
