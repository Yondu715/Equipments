<?php

namespace App\Http\Resources\Equipments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'errors' => $this->errors,
            'success' => EquipmentResource::collection($this->success)
        ];
    }
}