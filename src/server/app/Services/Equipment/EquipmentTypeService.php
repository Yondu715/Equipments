<?php

namespace App\Services\Equipment;

use App\Models\EquipmentType;
use App\Dto\In\Equipment\GetEquipmentTypesDto;
use Illuminate\Contracts\Pagination\Paginator;
use App\Services\Equipment\Factories\EquipmentTypeFilterFactory;

final class EquipmentTypeService
{
    /**
     * @param EquipmentTypeFilterFactory $equipmentTypeFilterFactory
     */
    public function __construct(
        private readonly EquipmentTypeFilterFactory $equipmentTypeFilterFactory
    ) {
    }

    /**
     * @param GetEquipmentTypesDto $getEquipmentTypesDto
     * @return Paginator
     */
    public function getAll(GetEquipmentTypesDto $getEquipmentTypesDto): Paginator
    {
        $filters = [
            'name' => $getEquipmentTypesDto->name,
            'mask' => $getEquipmentTypesDto->mask,
            'q' => $getEquipmentTypesDto->q
        ];

        return EquipmentType::query()
            ->filter($this->equipmentTypeFilterFactory->create($filters))
            ->simplePaginate(
                perPage: $getEquipmentTypesDto->limit,
                page: $getEquipmentTypesDto->page
            );
    }
}
