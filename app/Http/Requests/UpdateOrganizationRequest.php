<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
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
            'name' => 'max:255|nullable',
            /**
             * @example "12123123000112"
             */
            'cnpj' => 'size:14|nullable',
            /**
             * @example "11 97070-7070"
             */
            'phone' => 'max:30|nullable',
            'contact_email' => 'email|nullable',
        ];
    }
}
