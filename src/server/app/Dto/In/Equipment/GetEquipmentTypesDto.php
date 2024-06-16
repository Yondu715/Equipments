<?php

namespace App\Dto\In\Equipment;

use App\Http\Requests\Equipment\GetEquipmentTypesRequest;

final class GetEquipmentTypesDto
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $mask,
        public readonly ?string $q,
        public readonly ?int $limit,
        public readonly ?int $page

    ) {
    }

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