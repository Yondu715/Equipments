<?php

namespace App\Services\Equipment\Filters;

use App\Models\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

final class EquipmentFilter extends AbstractFilter
{
    protected function getCallbacks(): array
    {
        return [
            'serialNumber' => [$this, 'serialNumber'],
            'desc' => [$this, 'desc'],
            'equipmentTypeId' => [$this, 'equipmentTypeId'],
        ];
    }

    protected function serialNumber(Builder $builder, string $value): void
    {
        $builder->where('serial_number', $value);
    }

    protected function desc(Builder $builder, string $value): void
    {
        $builder->where('desc', $value);
    }

    protected function equipmentTypeId(Builder $builder, int $value): void
    {
        $builder->where('equipment_type_id', $value);
    }

}
