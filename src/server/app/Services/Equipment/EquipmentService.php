<?php

namespace App\Services\Equipment;

use App\Models\Equipment;
use App\Dto\In\GetEquipmentsDto;
use Illuminate\Contracts\Pagination\Paginator;
use App\Services\Equipment\Filters\EquipmentFilterFactory;

final class EquipmentService
{

    public function __construct(
        private readonly EquipmentFilterFactory $equipmentFilterFactory
    ) {
    }

    public function getAll(GetEquipmentsDto $getEquipmentsDto): Paginator
    {
        $filters = [
            'serialNumber' => $getEquipmentsDto->serialNumber,
            'desc' => $getEquipmentsDto->desc,
            'equipmentTypeId' => $getEquipmentsDto->equipmentTypeId
        ];
        return Equipment::query()
            ->filter($this->equipmentFilterFactory->create($filters))
            ->simplePaginate(
                perPage: $getEquipmentsDto->limit,
                page: $getEquipmentsDto->page
            );
    }

}
