<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Response;
use App\Http\Resources\EquipmentResource;
use App\Dto\In\Equipment\GetEquipmentsDto;
use App\Services\Equipment\EquipmentService;
use App\Http\Requests\Equipments\GetEquipmentsRequest;
use App\Http\Requests\Equipments\UpdateEquipmentRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EquipmentController
{

    public function __construct(
        private readonly EquipmentService $equipmentService
    ) {
    }

    public function index(GetEquipmentsRequest $getEquipmentsRequest): AnonymousResourceCollection
    {
        $getEquipmentsDto = GetEquipmentsDto::fromRequest($getEquipmentsRequest);
        return EquipmentResource::collection(
            $this->equipmentService->getAll($getEquipmentsDto)
        );
    }

    public function show(int $id): EquipmentResource
    {
        return EquipmentResource::make(
            $this->equipmentService->getById($id)
        );
    }

    public function destroy(int $id): Response
    {
        $this->equipmentService->deleteById($id);
        return response()->noContent();
    }
}
