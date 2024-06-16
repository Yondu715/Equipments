<?php

namespace App\Services\Equipment\Factories;

use App\Services\Equipment\Filters\EquipmentFilter;

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