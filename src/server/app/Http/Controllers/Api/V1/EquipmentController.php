<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Dto\In\Equipment\GetEquipmentsDto;
use App\Dto\In\Equipment\UpdateEquipmentDto;
use App\Services\Equipment\EquipmentService;
use App\Http\Resources\Equipments\EquipmentResource;
use App\Http\Requests\Equipment\GetEquipmentsRequest;
use App\Http\Requests\Equipment\UpdateEquipmentRequest;
use App\Http\Resources\Equipments\CreateEquipmentsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EquipmentController
{
    /**
     * @param EquipmentService $equipmentService
     */
    public function __construct(
        private readonly EquipmentService $equipmentService
    ) {
    }

    /**
     * @param GetEquipmentsRequest $getEquipmentsRequest
     * @return AnonymousResourceCollection
     */
    public function index(GetEquipmentsRequest $getEquipmentsRequest): AnonymousResourceCollection
    {
        $getEquipmentsDto = GetEquipmentsDto::fromRequest($getEquipmentsRequest);

        return EquipmentResource::collection(
            $this->equipmentService->getAll($getEquipmentsDto)
        );
    }

    /**
     * @param int $id
     * @return EquipmentResource
     */
    public function show(Equipment $equipment): EquipmentResource
    {
        return EquipmentResource::make($equipment);
    }

    /**
     * @param Request $request
     * @return CreateEquipmentsResource
     */
    public function store(Request $request): CreateEquipmentsResource
    {
        return CreateEquipmentsResource::make(
            $this->equipmentService->create($request->all())
        );
    }

    /**
     * @param int $equipmentId
     * @param UpdateEquipmentRequest $updateEquipmentRequest
     * @return EquipmentResource
     */
    public function update(Equipment $equipment, UpdateEquipmentRequest $updateEquipmentRequest): EquipmentResource
    {
        $updateEquipmentDto = UpdateEquipmentDto::fromRequest($updateEquipmentRequest);

        return EquipmentResource::make(
            $this->equipmentService->update($equipment, $updateEquipmentDto)
        );
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy(Equipment $equipment): Response
    {
        $this->equipmentService->deleteEquipment($equipment);

        return response()->noContent();
    }
}
