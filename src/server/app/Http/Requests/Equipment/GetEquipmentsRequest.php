<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class GetEquipmentsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'equipment_type_id' => 'integer',
            'serial_number' => 'string|max:255',
            'desc' => 'string',
            'q' => 'string|max:255',
            'limit' => 'integer',
            'page' => 'integer'
        ];
    }
}
