<?php

namespace App\Http\Controllers;

use App\Actions\Organization\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrganizationRequest;

class OrganizationController extends Controller
{
    /**
     * @response array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: "string", cnpj: "12123123000112", phone: "11 97070-7070", contact_email: "user@example.com"|null}
     */
    public function update(UpdateOrganizationRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }
}
