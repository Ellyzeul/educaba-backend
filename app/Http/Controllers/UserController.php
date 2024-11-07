<?php

namespace App\Http\Controllers;

use App\Actions\User\{ChangePasswordAction, CreateAction, ReadAction, UnlinkOrganizationAction, UpdateAction};
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeUserPasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ReadUserRequest;
use App\Http\Requests\UnlinkOrganizationUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        return (new CreateAction)->handle($request);
    }

    public function read(ReadUserRequest $request)
    {
        return (new ReadAction)->handle($request);
    }

    public function update(UpdateUserRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }

    public function changePassword(ChangeUserPasswordRequest $request)
    {
        return (new ChangePasswordAction)->handle($request);
    }

    public function unlinkOrganization(UnlinkOrganizationUserRequest $request)
    {
        return (new UnlinkOrganizationAction)->handle($request);
    }
}