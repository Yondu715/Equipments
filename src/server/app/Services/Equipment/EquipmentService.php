<?php

namespace App\Services\Equipment;

use App\Models\Equipment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Dto\In\Equipment\GetEquipmentsDto;
use App\Dto\Out\CreateEquipmentsResultDto;
use App\Dto\In\Equipment\UpdateEquipmentDto;
use Illuminate\Contracts\Pagination\Paginator;
use App\Services\Equipment\Factories\EquipmentFilterFactory;

final class EquipmentService
{

    public function __construct(
        private readonly EquipmentFilterFactory $equipmentFilterFactory
    ) {
    }

    /**
     * @param GetEquipmentsDto $getEquipmentsDto
     * @return Paginator
     */
    public function getAll(GetEquipmentsDto $getEquipmentsDto): Paginator
    {
        $filters = [
            'serialNumber' => $getEquipmentsDto->serialNumber,
            'desc' => $getEquipmentsDto->desc,
            'equipmentTypeId' => $getEquipmentsDto->equipmentTypeId
        ];
        return Equipment::query()
            ->filter($this->equipmentFilterFactory->create($filters))
            ->paginate(
                perPage: $getEquipmentsDto->limit,
                page: $getEquipmentsDto->page
            );
    }

    /**
     * @param int $id
     * @return Equipment
     */
    public function getById(int $id): Equipment
    {
        return Equipment::query()->with('type')->findOrFail($id);
    }

    /**
     * @param array $data
     * @return CreateEquipmentsResultDto
     */
    public function create(array $data): CreateEquipmentsResultDto
    {
        $errors = [];
        $success = [];

        foreach ($data as $index => $equipmentData) {
            $validator = Validator::make($equipmentData, [
                'equipment_type_id' => 'required|integer',
                'serial_number' => 'required|string|max:255',
                'desc' => 'required|string',
            ]);

            if ($validator->fails()) {
                $errors[$index] = $validator->errors()->all();
                continue;
            }

            try {
                $success[$index] = Equipment::create($equipmentData);
            } catch (\Exception $e) {
                $errors[$index] = $e->getMessage();
            }
        }

        return new CreateEquipmentsResultDto(
            errors: $errors,
            success: $success
        );
    }

    /**
     * @param int $equipmentId
     * @param UpdateEquipmentDto $updateEquipmentDto
     * @return Equipment
     */
    public function update(int $equipmentId, UpdateEquipmentDto $updateEquipmentDto): Equipment
    {
        $equipment = Equipment::query()->findOrFail($equipmentId);

        $updateData = collect($updateEquipmentDto)
            ->filter(fn ($value) => !is_null($value))
            ->mapWithKeys(fn ($value, $key) => [Str::snake($key) => $value]);

        $equipment->update($updateData->toArray());
        return $equipment;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return Equipment::query()->findOrFail($id)->delete();
    }
}
