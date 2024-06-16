<?php

namespace App\Services\Equipment\Filters;

use App\Models\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

final class EquipmentTypeFilter extends AbstractFilter
{
    protected function getCallbacks(): array
    {
        return [
            'name' => [$this, 'name'],
            'mask' => [$this, 'mask'],
            'q' => [$this, 'q'],
        ];
    }

    protected function name(Builder $builder, string $value): void
    {
        $builder->where('name', 'like', '%' . $value . '%');
    }

    protected function mask(Builder $builder, string $value): void
    {
        $builder->where('mask', $value);
    }

    protected function q(Builder $builder, int $value): void
    {
        $builder->where('name', $value);
    }

}
