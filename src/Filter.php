<?php
namespace Hanksie\Repository;

abstract class Filter
{
    public function __construct(
        protected $payload
    ) {}

    abstract public function handle($wheres);
}
