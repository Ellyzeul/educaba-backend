<?php

namespace App\Http\Controllers;

use App\Actions\ProgramSetStatus\{CreateAction, DeleteAction, ReadAction, UpdateAction};
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateProgramSetStatusRequest, DeleteProgramSetStatusRequest, ReadProgramSetStatusRequest, UpdateProgramSetStatusRequest};

class ProgramSetStatusController extends Controller
{
    public function create(CreateProgramSetStatusRequest $request)
    {
        return (new CreateAction)->handle($request);
    }

    public function read(ReadProgramSetStatusRequest $request)
    {
        return (new ReadAction)->handle($request);
    }

    public function update(UpdateProgramSetStatusRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }

    public function delete(DeleteProgramSetStatusRequest $request)
    {
        return (new DeleteAction)->handle($request);
    }
}
