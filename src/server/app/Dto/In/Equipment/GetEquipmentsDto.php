<?php

namespace App\Dto\In\Equipment;

use App\Http\Requests\Equipment\GetEquipmentsRequest;

final class GetEquipmentsDto
{

    public function __construct(
        public readonly ?int $equipmentTypeId,
        public readonly ?string $serialNumber,
        public readonly ?string $desc,
        public readonly ?int $limit,
        public readonly ?int $page

    ) {
    }

    public static function fromRequest(GetEquipmentsRequest $getEquipmentsRequest): self
    {
        return new self(
            equipmentTypeId: $getEquipmentsRequest->equipment_type_id,
            serialNumber: $getEquipmentsRequest->serial_number,
            desc: $getEquipmentsRequest->desc,
            limit: $getEquipmentsRequest->limit,
            page: $getEquipmentsRequest->page
        );
    }
}
