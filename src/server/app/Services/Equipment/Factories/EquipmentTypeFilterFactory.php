<?php

namespace App\Services\Equipment\Factories;

use App\Services\Equipment\Filters\EquipmentTypeFilter;

final class EquipmentTypeFilterFactory
{
    /**
     * @param array $filters
     * @return EquipmentTypeFilter
     */
    public function create(array $filters): EquipmentTypeFilter
    {
        return new EquipmentTypeFilter($filters);
    }
}