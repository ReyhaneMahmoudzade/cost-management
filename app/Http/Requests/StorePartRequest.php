<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:100', 'unique:parts,code'],
            'group' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:255'],

            'weight' => ['nullable', 'numeric', 'min:0'],
            'area' => ['nullable', 'numeric', 'min:0'],
            'perimeter' => ['nullable', 'numeric', 'min:0'],

            'description' => ['nullable', 'string'],

            'materials' => ['required', 'array', 'min:1'],

            'materials.*.material_id' => [
                'required',
                'integer',
                'exists:materials,id',
                'distinct',
            ],

            'materials.*.quantity' => [
                'required',
                'numeric',
                'min:0',
            ],

            'processes' => ['required', 'array', 'min:1'],

            'processes.*.process_id' => [
                'required',
                'exists:processes,id',
                'distinct',
            ],

            'processes.*.standard_quantity' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
}
