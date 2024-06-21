<?php

namespace App\Http\Resources\Equipments;

use Illuminate\Http\Request;
use App\Dto\Out\CreateEquipmentsResultDto;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CreateEquipmentsResultDto
 */
class CreateEquipmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'errors' => $this->errors->mapWithKeys(
                fn ($item, $key) => [$key + 1 => $item]
            ),
            'success' => $this->success->mapWithKeys(
                fn ($item, $key) => [$key + 1 => EquipmentResource::make($item)]
            )
        ];
    }
}
