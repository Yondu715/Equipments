<?php

namespace App\Services\Equipment;

use Exception;
use App\Models\Equipment;
use Illuminate\Support\Str;
use App\Models\EquipmentType;
use Illuminate\Support\Facades\Validator;
use App\Dto\In\Equipment\GetEquipmentsDto;
use App\Dto\In\Equipment\UpdateEquipmentDto;
use Illuminate\Contracts\Pagination\Paginator;
use App\Exceptions\InvalidSerialNumberException;
use App\Dto\Out\Equipment\CreateEquipmentsResultDto;
use App\Services\Equipment\Factories\EquipmentFilterFactory;

final class EquipmentService
{
    /**
     * @param EquipmentFilterFactory $equipmentFilterFactory
     */
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
            'equipmentTypeId' => $getEquipmentsDto->equipmentTypeId,
            'q' => $getEquipmentsDto->q
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
        $errors = collect();
        $success = collect();

        foreach ($data as $index => $equipmentData) {
            $validator = Validator::make($equipmentData, [
                'equipment_type_id' => 'required|integer|exists:equipment_types,id',
                'serial_number' => 'required|string|max:255',
                'desc' => 'string|max:255',
            ]);

            if ($validator->fails()) {
                $errors[$index] = $validator->errors()->all();
                continue;
            }

            try {
                $equipmentType = EquipmentType::findOrFail($equipmentData['equipment_type_id']);
                $this->validateSerialNumber($equipmentData['serial_number'], $equipmentType->mask);
            } catch (Exception $e) {
                $errors[$index] = $e->getMessage();
                continue;
            }

            try {
                $success[$index] = Equipment::create($equipmentData);
            } catch (Exception $e) {
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
        
        if ($updateEquipmentDto->serialNumber) {
            $equipmentType = EquipmentType::query()->findOrFail($updateEquipmentDto->equipmentTypeId);
            $this->validateSerialNumber($updateEquipmentDto->serialNumber, $equipmentType->mask);
        }

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


    /**
     * @param string $serialNumber
     * @param string $mask
     * @return bool
     * @throws InvalidSerialNumberException
     */
    private function validateSerialNumber(string $serialNumber, string $mask): bool
    {
        $regexMap = [
            'N' => '[0-9]',
            'A' => '[A-Z]',
            'a' => '[a-z]',
            'X' => '[A-Z0-9]',
            'Z' => '[-_@]'
        ];

        $regexPattern = '';
        for ($i = 0; $i < strlen($mask); $i++) {
            $char = $mask[$i];
            $regexPattern .= isset($regexMap[$char]) ? $regexMap[$char] : $char;
        }
        if (preg_match('/^' . $regexPattern . '$/', $serialNumber) !== 1) {
            throw new InvalidSerialNumberException();
        }

        return true;
    }
}
