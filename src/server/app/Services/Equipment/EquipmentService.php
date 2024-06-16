<?php

namespace App\Services\Equipment;

use App\Models\Equipment;
use App\Dto\In\Equipment\GetEquipmentsDto;
use App\Dto\In\Equipment\UpdateEquipmentDto;
use Illuminate\Contracts\Pagination\Paginator;
use App\Services\Equipment\Factories\EquipmentFilterFactory;
use Illuminate\Support\Str;

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

    public function update(int $equipmentId, UpdateEquipmentDto $updateEquipmentDto): Equipment
    {
        $equipment = Equipment::query()->findOrFail($equipmentId);

        $updateData = collect($updateEquipmentDto)
            ->filter(fn ($value) => !is_null($value))
            ->mapWithKeys(fn ($value, $key) => [Str::snake($key) => $value]);

        $equipment->update($updateData->toArray());
        return $equipment;
    }

    public function deleteById(int $id): bool
    {
        return Equipment::query()->findOrFail($id)->delete();
    }
}
