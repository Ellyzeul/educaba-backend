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
            'id' => 'required|size:26',
            'name' => 'max:255',
            'sex' => 'in:male,female,other',
            'birth_date' => 'date_format:Y-m-d',
            'cpf' => 'size:11',
            'image' => [new Image],
        ];
    }
}
