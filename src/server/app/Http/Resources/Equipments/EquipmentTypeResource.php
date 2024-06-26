<?php

namespace App\Http\Resources\Equipments;

use Illuminate\Http\Request;
use App\Models\EquipmentType;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin EquipmentType
 */
class EquipmentTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mask' => $this->mask,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
