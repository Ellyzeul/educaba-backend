<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProgramRequest extends FormRequest
{
    use HasApiFailResponse;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, ['admin', 'dev']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'patient_id' => 'required|string|size:26',
            'inputs' => 'required|array',
            'inputs.*.name' => 'required|string|max:255',
            'inputs.*.type' => 'required|in:text,number',
            'has_single_set' => 'boolean',
            'sets' => 'required|array',
            'sets.*.name' => 'max:255',
            'sets.*.goals' => 'required|array',
            'sets.*.goals.*.name' => 'required|string|max:255',
        ];
    }
}
