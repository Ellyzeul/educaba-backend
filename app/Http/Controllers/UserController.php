<?php

namespace App\Http\Controllers;

use App\Actions\User\{ChangePasswordAction, CreateAction, DeleteAction, LinkOrganizationAction, ReadAction, UnlinkOrganizationAction, UpdateAction};
use App\Http\Controllers\Controller;
use App\Http\Requests\{ChangeUserPasswordRequest, CreateUserRequest, DeleteUserRequest, LinkOrganizationUserRequest, ReadUserRequest, UnlinkOrganizationUserRequest, UpdateUserRequest};

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

    public function delete(DeleteUserRequest $request)
    {
        return (new DeleteAction)->handle($request);
    }

    public function changePassword(ChangeUserPasswordRequest $request)
    {
        return (new ChangePasswordAction)->handle($request);
    }

    public function linkOrganization(LinkOrganizationUserRequest $request)
    {
        return (new LinkOrganizationAction)->handle($request);
    }

    public function unlinkOrganization(UnlinkOrganizationUserRequest $request)
    {
        return (new UnlinkOrganizationAction)->handle($request);
    }
}