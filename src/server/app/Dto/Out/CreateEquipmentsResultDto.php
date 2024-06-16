<?php

namespace App\Dto\Out;

final class CreateEquipmentsResultDto
{

    public function __construct(
        public readonly array $errors,
        public readonly array $success
    ) {
    }
}
