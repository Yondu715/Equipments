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
                'serial_number' => '3255423245',
                'desc' => '...'
            ],
            [
                'equipment_type_id' => 2,
                'serial_number' => '9483j37d7',
                'desc' => '...'
            ],
            [
                'equipment_type_id' => 3,
                'serial_number' => '31248dsddssa',
                'desc' => '...'
            ]
        ];

        foreach ($equipments as $equipment) {
            Equipment::query()->create($equipment);
        }
    }
}
