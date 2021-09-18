<?php

declare(strict_types=1);

namespace App\Services\Filters;

use Illuminate\Database\Eloquent\Builder;

interface IFilterCreator
{
    public const FILTERS_NAME_BAG = 'filters';
    public const FILTERS_MODELS_PATH = 'App\Models\Filters\\';

    /**
     * Apply creator to builder
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder) : Builder;
}
