<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProcessRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:processes,name'],
            'standard_unit' => ['', ''],
            'measure_unit' => ['', ''],

            'factors' => [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    $sum = collect($value)->sum(function ($item) {
                        return (float) ($item['weight'] ?? 0);
                    });

                    if (abs($sum - 1) > 0.00001) {
                        $fail('مجموع وزن‌ها باید برابر 1 باشد.');
                    }
                },
            ],
            'factors.*.factor_id' => ['required', 'exists:factors,id'],
            'factors.*.weight' => ['required', 'numeric', 'min:0', 'max:1'],
        ];
    }
}
