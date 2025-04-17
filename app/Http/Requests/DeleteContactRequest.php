<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteContactRequest extends FormRequest
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
            /**
             * @example "01jd8y1hf05zjg3jzbktnxrtw4"
             */
            'patient_id' => 'required|size:26',
        ];
    }
}
