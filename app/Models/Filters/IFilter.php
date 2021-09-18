<?php

declare(strict_types=1);

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

interface IFilter
{
    /**
     * Apply filter. Add condition to builder
     *
     * @param Builder $builder
     * @param mixed $filterValue
     * @return Builder
     */
    public static function apply(Builder $builder, $filterValue) : Builder;
}
