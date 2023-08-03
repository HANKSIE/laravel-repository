<?php
namespace Hanksie\Repository;

use Illuminate\Contracts\Pipeline\Pipeline;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository extends Repository
{
    protected Model $model;

    public function newQuery(): EloquentBuilder
    {
        return $this->model->newQuery();
    }

    public function create($payload)
    {
        return $this->newQuery()->create($payload)->toArray();
    }

    public function update(array $filters, $payload): bool
    {
        return (bool) $this->applyFilters($this->newQuery(), $filters)->update($payload);
    }

    public function delete(array $filters): bool
    {
        return (bool) $this->applyFilters($this->newQuery(), $filters)->delete();
    }

    public function get(array $columns, array $filters)
    {
        return $this->applySearch($this->newQuery(), $filters)->get($columns)->toArray();
    }

    public function first(array $filters)
    {
        return $this->applySearch($this->newQuery(), $filters)->first()?->toArray();
    }

    public function find($value)
    {
        return $this->findBy($this->model->getKeyName(), $value);
    }

    public function findBy($column, array $value)
    {
        return $this->applySearch($this->newQuery(), [])->firstWhere($column, $value)?->toArray();
    }

    public function exists(array $filters): bool
    {
        return $this->applyFilters($this->newQuery(), $filters)->exists();
    }

    protected function applySearch(EloquentBuilder $query, array $filters): EloquentBuilder
    {
        return app(Pipeline::class)
            ->send($query)
            ->through([
                fn($query, $next) => $next($this->applyFilters($query, $filters)),
                fn($query, $next) => $next($this->applyWith($query)),
                fn($query, $next) => $next($this->applyOrder($query)),
            ])
            ->then(fn($query) => $query);
    }

    protected function applyWith(EloquentBuilder $query): EloquentBuilder
    {
        return $query;
    }

    protected function applyOrder(EloquentBuilder $query): EloquentBuilder
    {
        return $query;
    }
}
