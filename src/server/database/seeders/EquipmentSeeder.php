<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipments = [
            [
                'equipment_type_id' => 1,
                'serial_number' => '00AAAAA0AA',
                'desc' => '...'
            ],
            [
                'equipment_type_id' => 2,
                'serial_number' => '000AA0_0aa',
                'desc' => '...'
            ],
            [
                'equipment_type_id' => 3,
                'serial_number' => '0AAAA0-AAA',
            ]
        ];

        foreach ($equipments as $equipment) {
            Equipment::query()->create($equipment);
        }
    }
}
