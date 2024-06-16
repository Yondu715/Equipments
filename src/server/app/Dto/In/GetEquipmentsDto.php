<?php

namespace App\Dto\In;

use App\Http\Requests\Equipments\GetEquipmentsRequest;

final class GetEquipmentsDto
{

    public function __construct(
        public readonly ?int $equipmentTypeId = null,
        public readonly ?string $serialNumber = null,
        public readonly ?string $desc = null,
        public readonly ?int $limit = null,
        public readonly ?int $page = null

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
