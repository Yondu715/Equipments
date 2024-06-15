<?php

namespace App\Models\Traits;

use App\Models\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    /**
     * @param Builder $builder
     * @param FilterInterface $filter
     * @return Builder
     */
    public function scopeFilter(Builder $builder, FilterInterface $filter): Builder
    {
        $filter->apply($builder);
        return $builder;
    }
}
