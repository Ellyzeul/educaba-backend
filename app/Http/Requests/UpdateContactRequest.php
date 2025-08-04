<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
             * @example "John Doe"
             */
            'name' => 'string',
            /**
             * @example "41061988209"
             */
            'cpf' => 'string',
            'relationship' => 'required|in:father,mother,relative,responsible,other',
            'email' => 'email',
            /**
             * @example "11 97070-7070"
             */
            'phone_primary' => 'string',
            /**
             * @example "+244 123123123"
             */
            'phone_secondary' => 'string',
            /**
             * @example "01jd8y1hf05zjg3jzbktnxrtw4"
             */
            'patient_id' => 'required|size:26',
        ];
    }
}
