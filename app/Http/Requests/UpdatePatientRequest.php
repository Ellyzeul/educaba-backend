<?php

namespace App\Http\Requests;

use App\Rules\Image;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            'name' => 'max:255',
            'sex' => 'in:male,female,other',
            'birth_date' => 'date_format:Y-m-d',
            'cpf' => 'size:11',
            'image' => [new Image],
        ];
    }
}
