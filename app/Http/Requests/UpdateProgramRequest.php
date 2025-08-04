<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
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
            /**
             * @example "01jd8y1hf05zjg3jzbktnxrtw4"
             */
            'id' => 'required|size:26',
            'name' => 'required|string|max:255',
            'patient_id' => 'required|string|size:26',
            'inputs' => 'required|array',
            'inputs.*.name' => 'required|string|max:255',
            'inputs.*.type' => 'required|in:text,number',
            'has_single_set' => 'boolean',
            'sets' => 'required|array',
            'sets.*.id' => 'string|size:26',
            'sets.*.name' => 'max:255',
            'sets.*.program_set_status_id' => 'required|string|size:26',
            'sets.*.goals' => 'required|array',
            'sets.*.goals.*.id' => 'string|max:26',
            'sets.*.goals.*.name' => 'required|string|max:255',
        ];
    }
}
