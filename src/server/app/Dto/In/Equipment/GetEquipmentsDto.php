<?php

namespace App\Dto\In\Equipment;

use App\Http\Requests\Equipment\GetEquipmentsRequest;

final class GetEquipmentsDto
{

    /**
     * @param ?int $equipmentTypeId
     * @param ?string $serialNumber
     * @param ?string $desc
     * @param ?string $q
     * @param ?int $limit
     * @param ?int $page
     */
    public function __construct(
        public readonly ?int $equipmentTypeId,
        public readonly ?string $serialNumber,
        public readonly ?string $desc,
        public readonly ?string $q,
        public readonly ?int $limit,
        public readonly ?int $page

    ) {
    }

    /**
     * @param GetEquipmentsRequest $getEquipmentsRequest
     * @return self
     */
    public static function fromRequest(GetEquipmentsRequest $getEquipmentsRequest): self
    {
        return new self(
            equipmentTypeId: $getEquipmentsRequest->equipment_type_id,
            serialNumber: $getEquipmentsRequest->serial_number,
            desc: $getEquipmentsRequest->desc,
            limit: $getEquipmentsRequest->limit,
            page: $getEquipmentsRequest->page,
            q: $getEquipmentsRequest->q
        );
    }
}
