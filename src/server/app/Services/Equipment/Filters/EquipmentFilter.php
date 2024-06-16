<?php

namespace App\Services\Equipment\Filters;

use App\Models\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

final class EquipmentFilter extends AbstractFilter
{
    /**
     * @return array
     */
    protected function getCallbacks(): array
    {
        return [
            'serialNumber' => [$this, 'serialNumber'],
            'desc' => [$this, 'desc'],
            'equipmentTypeId' => [$this, 'equipmentTypeId'],
        ];
    }

    /**
     * @param Builder $builder
     * @param string $value
     * @return void
     */
    protected function serialNumber(Builder $builder, string $value): void
    {
        $builder->where('serial_number', $value);
    }

    /**
     * @param Builder $builder
     * @param string $value
     * @return void
     */
    protected function desc(Builder $builder, string $value): void
    {
        $builder->where('desc', $value);
    }

    /**
     * @param Builder $builder
     * @param int $value
     * @return void
     */
    protected function equipmentTypeId(Builder $builder, int $value): void
    {
        $builder->where('equipment_type_id', $value);
    }

}
