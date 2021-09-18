<?php

declare(strict_types=1);

namespace App\Models\Filters\Lists;

use App\Models\Filters\IFilter;
use Illuminate\Database\Eloquent\Builder;

class CreatorEmail implements IFilter
{

    /**
     * Apply filter. Add condition to builder
     *
     * @param Builder $builder
     * @param mixed $filterValue
     * @return Builder
     */
    public static function apply(Builder $builder, $filterValue) : Builder
    {
        return $filterValue && is_string($filterValue)
            ? $builder->where('creator_email', 'LIKE', '%'.$filterValue.'%')
            : $builder;
    }
}
