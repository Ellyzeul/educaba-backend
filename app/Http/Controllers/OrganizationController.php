<?php

namespace App\Http\Controllers;

use App\Actions\Organization\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrganizationRequest;

class OrganizationController extends Controller
{
    public function update(UpdateOrganizationRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }
}
