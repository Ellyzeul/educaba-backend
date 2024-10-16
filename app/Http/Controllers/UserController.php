<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        return (new CreateAction)->handle($request);
    }
}