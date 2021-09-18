<?php

declare(strict_types=1);

namespace App\Scopes;

use App\Services\Filters\IFilterCreator;
use Illuminate\Database\Eloquent\Builder;
use ReflectionClass;

trait Filterable {
    public function scopeFilter(Builder $builder) : Builder {
		$oReflection = new ReflectionClass($this);
        $creatorName = '\App\Services\Filters\\'.$oReflection->getShortName().'FilterCreator';

        /** @var IFilterCreator $oFilterCreator */
        $oFilterCreator = resolve($creatorName);

        return $oFilterCreator->apply($builder);
    }
}
