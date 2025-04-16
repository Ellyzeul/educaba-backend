<?php

namespace App\Http\Controllers;

use App\Actions\Application\CreateAction;
use App\Actions\Application\DeleteAction;
use App\Actions\Application\ReadAction;
use App\Actions\Application\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateApplicationRequest;
use App\Http\Requests\DeleteApplicationRequest;
use App\Http\Requests\ReadApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;

class ApplicationController extends Controller
{
    public function create(CreateApplicationRequest $request)
    {
        return (new CreateAction)->handle($request);
    }

    public function read(ReadApplicationRequest $request)
    {
        return (new ReadAction)->handle($request);
    }

    public function update(UpdateApplicationRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }

    public function delete(DeleteApplicationRequest $request)
    {
        return (new DeleteAction)->handle($request);
    }
}
