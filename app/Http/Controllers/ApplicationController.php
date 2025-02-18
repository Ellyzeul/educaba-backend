<?php

namespace App\Http\Controllers;

use App\Actions\Application\CreateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateApplicationRequest;

class ApplicationController extends Controller
{
    public function create(CreateApplicationRequest $request)
    {
        return (new CreateAction)->handle($request);
    }
}
