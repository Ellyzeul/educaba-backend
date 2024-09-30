<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    private array $rules = [];

    public function __construct()
    {
        $this->rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
        ];
    }

    public function create(Request $request)
    {
        $request->validate($this->rules);
        $user = new User($request->all(array_keys($this->rules)));

        $user->save();

        return $user;
    }
}