<?php

namespace App\Http\Controllers\Api\V1;

use App\Dto\In\Equipment\GetEquipmentTypesDto;
use App\Services\Equipment\EquipmentTypeService;
use App\Http\Resources\Equipments\EquipmentTypeResource;
use App\Http\Requests\Equipment\GetEquipmentTypesRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EquipmentTypeController
{
    /**
     * @param EquipmentTypeService $equipmentTypeService
     */
    public function __construct(
        private readonly EquipmentTypeService $equipmentTypeService
    ) {
    }

    /**
     * @param GetEquipmentTypesRequest $getEquipmentTypesRequest
     * @return AnonymousResourceCollection
     */
    public function index(GetEquipmentTypesRequest $getEquipmentTypesRequest): AnonymousResourceCollection
    {
        $getEquipmentTypesDto = GetEquipmentTypesDto::fromRequest($getEquipmentTypesRequest);

        return EquipmentTypeResource::collection(
            $this->equipmentTypeService->getAll($getEquipmentTypesDto)
        );
    }
}
