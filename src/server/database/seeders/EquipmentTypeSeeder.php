<?php

namespace Database\Seeders;

use App\Models\EquipmentType;
use Illuminate\Database\Seeder;

class EquipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipmentTypes = [
            [
                'name' => 'TP-Link TL-WR74',
                'mask' => 'XXAAAAAXAA'
            ],
            [
                'name' => 'D-Link DIR-300 ',
                'mask' => 'NXXAAXZXaa'
            ],
            [
                'name' => 'D-Link DIR-300 E',
                'mask' => 'NAAAAXZXXX'
            ]
        ];

        foreach ($equipmentTypes as $equipmentType) {
            EquipmentType::query()->create($equipmentType);
        }
    }
}
