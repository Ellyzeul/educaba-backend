<?php

namespace App\Http\Controllers;

use App\Actions\Program\{CreateAction, DeleteAction, ReadAction, UpdateAction};
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateProgramRequest, DeleteProgramRequest, ReadProgramRequest, UpdateProgramRequest};

class ProgramController extends Controller
{
    public function create(CreateProgramRequest $request)
    {
        return (new CreateAction)->handle($request);
    }

    public function read(ReadProgramRequest $request)
    {
        return (new ReadAction)->handle($request);
    }

    public function update(UpdateProgramRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }

    public function delete(DeleteProgramRequest $request)
    {
        return (new DeleteAction)->handle($request);
    }
}
