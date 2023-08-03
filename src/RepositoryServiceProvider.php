<?php
namespace Hanksie\Repository;

use Hanksie\Repository\Helpers\Pipeline as PipelineHelper;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->instance(PipelineHelper::class, PipelineHelper::class);
    }
}
