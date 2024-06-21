<?php

namespace App\Dto\Out\Equipment;

use App\Models\Equipment;
use Illuminate\Support\Collection;

final class CreateEquipmentsResultDto
{

    /**
     * @param Collection<int, string> $errors
     * @param Collection<int, Equipment> $success
     */
    public function __construct(
        public readonly Collection $errors,
        public readonly Collection $success
    ) {
    }
}
