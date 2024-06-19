<?php

namespace App\Dto\In\Equipment;

use App\Http\Requests\Equipment\GetEquipmentTypesRequest;

final class GetEquipmentTypesDto
{
    /**
     * @param ?string $name
     * @param ?string $mask
     * @param ?string $q
     * @param ?int $limit
     * @param ?int $page
     */
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $mask,
        public readonly ?string $q,
        public readonly ?int $limit,
        public readonly ?int $page

    ) {
    }

    /**
     * @param GetEquipmentTypesRequest $getEquipmentTypesRequest
     * @return self
     */
    public static function fromRequest(GetEquipmentTypesRequest $getEquipmentTypesRequest): self
    {
        return new self(
            name: $getEquipmentTypesRequest->name,
            mask: $getEquipmentTypesRequest->mask,
            q: $getEquipmentTypesRequest->q,
            limit: $getEquipmentTypesRequest->limit,
            page: $getEquipmentTypesRequest->page
        );
    }
}