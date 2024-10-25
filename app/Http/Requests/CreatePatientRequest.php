<?php

namespace App\Http\Requests;

use App\Rules\Image;
use App\Rules\OrganizationId;
use Illuminate\Foundation\Http\FormRequest;

class CreatePatientRequest extends FormRequest
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
            'name' => 'required|max:255',
            'sex' => 'required|in:male,female,other',
            'birth_date' => 'required|date_format:Y-m-d',
            'cpf' => 'size:11',
            'organization_id' => ['required', new OrganizationId],
            'image' => [new Image],
        ];
    }
}
