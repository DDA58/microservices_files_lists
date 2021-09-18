<?php

declare(strict_types=1);

namespace App\Services\Filters;

class ListsFilterCreator extends ABaseFilterCreator
{
    private const FOLDER = 'Lists';

    /**
     * Get filters namespace
     *
     * @return string
     */
    protected function getNamespace() : string {
        return self::FILTERS_MODELS_PATH.static::FOLDER.'\\';
    }
}
