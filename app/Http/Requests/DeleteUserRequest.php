<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $id = $this->input('id');
        $user = $this->user();

        if($id === $user->id) {
            return true;
        }

        if($id !== null and in_array($user->role, ['admin', 'dev'])) {
            return true;
        }

        if($id === null) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'size:26',
        ];
    }
}
