<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\EquipmentTypeResource;
use App\Dto\In\Equipment\GetEquipmentTypesDto;
use App\Services\Equipment\EquipmentTypeService;
use App\Http\Requests\Equipments\GetEquipmentTypesRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EquipmentTypeController
{

    public function __construct(
        private readonly EquipmentTypeService $equipmentTypeService
    ) {
    }

    /**
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
