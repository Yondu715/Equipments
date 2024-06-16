<?php

namespace App\Dto\In\Equipment;

use App\Http\Requests\Equipment\UpdateEquipmentRequest;

final class UpdateEquipmentDto
{
    public function __construct(
        public readonly ?int $equipmentTypeId,
        public readonly ?string $serialNumber,
        public readonly ?string $desc,

    ) {
    }

    /**
     * @param UpdateEquipmentRequest $updateEquipmentRequest
     * @return self
     */
    public static function fromRequest(UpdateEquipmentRequest $updateEquipmentRequest): self
    {
        return new self(
            equipmentTypeId: $updateEquipmentRequest->equipment_type_id,
            serialNumber: $updateEquipmentRequest->serial_number,
            desc: $updateEquipmentRequest->desc
        );
    }
}