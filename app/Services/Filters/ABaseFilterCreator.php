<?php

declare(strict_types=1);

namespace App\Services\Filters;

use App\Models\Filters\IFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class ABaseFilterCreator implements IFilterCreator
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get filters namespace
     *
     * @return string
     */
    abstract protected function getNamespace() : string;

    /**
     * Apply creator to builder
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder) : Builder {
        $filters = $this->identifyFiltersInQuery();

        foreach ($filters as $filter => $value) {
            $filterName = $this->getObjectName($filter);
            $filterNameWithNamespace = $this->getNamespace().$filterName;

            if (!$this->isValidFilterClass($filterNameWithNamespace)) {
                continue;
            }

            /** @var IFilter $filterNameWithNamespace */
            $builder = $filterNameWithNamespace::apply($builder, $value);
        }

        return $builder;
    }

    /**
     * Get all filter params from query
     *
     * @return array
     */
    protected function identifyFiltersInQuery() : array {
        $bag_name = self::FILTERS_NAME_BAG;

        return $this->request->has($bag_name) && is_array($this->request->get($bag_name))
            ? $this->request->get($bag_name)
            : [];
    }

    /**
     * Generate object name from query param name
     *
     * @param string $paramName
     * @return string
     */
    protected function getObjectName(string $paramName) : string {
        return ucfirst((string)Str::of($paramName)->camel());
    }

    /**
     * Check filter class existing
     *
     * @param string $className
     * @return bool
     */
    protected function isValidFilterClass(string $className) : bool {
        return class_exists($className);
    }
}
