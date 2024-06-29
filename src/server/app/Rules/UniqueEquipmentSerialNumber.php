<?php

namespace App\Rules;

use App\Models\Equipment;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueEquipmentSerialNumber implements ValidationRule
{


    /**
     * @param int $equipmentTypeId
     */
    public function __construct(
        private readonly int $equipmentTypeId
    ) {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = Equipment::where('equipment_type_id', $this->equipmentTypeId)
            ->where('serial_number', $value)
            ->exists();

        if ($exists) {
            $fail('The equipment with this serial number and type already exists.');
        }
    }
}
