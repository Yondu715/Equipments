<?php

namespace App\Services\Equipment;

use App\Models\Equipment;
use App\Dto\In\GetEquipmentsDto;
use Illuminate\Contracts\Pagination\Paginator;
use App\Services\Equipment\Factories\EquipmentFilterFactory;

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

    public function getById(int $id): Equipment
    {
        return Equipment::query()->with('type')->findOrFail($id);
    }

    public function deleteById(int $id): bool
    {
        return Equipment::query()->findOrFail($id)->delete();
    }
}
