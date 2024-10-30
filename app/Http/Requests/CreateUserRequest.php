<?php

namespace App\Http\Requests;

use App\Rules\OrganizationId;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
{
    use HasApiFailResponse;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $hasDevKey = $this->header('dev-key') === env('APP_DEV_KEY');

        if(!$hasDevKey && $this->user() === null) {
            return false;
        }

        if($this->input('role') === 'dev' && !$hasDevKey) {
            return false;
        }

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
            'email' => 'required|max:255',
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
            'organization_id' => [new OrganizationId],
            'role' => 'required|in:dev,admin,therapeut',
        ];
    }
}
