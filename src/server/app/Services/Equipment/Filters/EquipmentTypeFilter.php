<?php

namespace App\Services\Equipment\Filters;

use App\Models\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

final class EquipmentTypeFilter extends AbstractFilter
{
    /**
     * @return array
     */
    protected function getCallbacks(): array
    {
        return [
            'name' => [$this, 'name'],
            'mask' => [$this, 'mask'],
            'q' => [$this, 'q'],
        ];
    }

    /**
     * @param Builder $builder
     * @param string $value
     * @return void
     */
    protected function name(Builder $builder, string $value): void
    {
        $builder->where('name', 'like', '%' . $value . '%');
    }

    /**
     * @param Builder $builder
     * @param string $value
     * @return void
     */
    protected function mask(Builder $builder, string $value): void
    {
        $builder->where('mask', $value);
    }

    /**
     * @param Builder $builder
     * @param int $value
     * @return void
     */
    protected function q(Builder $builder, string $value): void
    {
        $builder->where('name', $value)
            ->orWhere('mask', $value);
    }
}
