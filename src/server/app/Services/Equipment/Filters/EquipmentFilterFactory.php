<?php

namespace App\Services\Equipment\Filters;

final class EquipmentFilterFactory
{
    /**
     * @param array $filters
     * @return EquipmentFilter
     */
    public function create(array $filters): EquipmentFilter
    {
        return new EquipmentFilter($filters);
    }
}