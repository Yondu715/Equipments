<?php

namespace App\Dto\Out;

use App\Models\Equipment;

final class CreateEquipmentsResultDto
{

    /**
     * @param array<int, string> $errors
     * @param array<int, Equipment> $success
     */
    public function __construct(
        public readonly array $errors,
        public readonly array $success
    ) {
    }
}
