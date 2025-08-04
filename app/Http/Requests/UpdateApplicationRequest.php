<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
{
    use HasApiFailResponse;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            /**
             * @example "01jd8y1hf05zjg3jzbktnxrtw4"
             */
            'id' => 'required|size:26',
            'inputs' => 'array',
            'inputs.*.name' => 'string|max:255',
            /**
             * @example "any"
             */
            'inputs.*.value' => 'present',
            /**
             * @example "01jd8y1hf05zjg3jzbktnxrtw4"
             */
            'program_id' => 'required|string|size:26',
        ];
    }
}
