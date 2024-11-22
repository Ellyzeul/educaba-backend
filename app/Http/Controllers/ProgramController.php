<?php

namespace App\Http\Controllers;

use App\Actions\Program\{CreateAction, ReadAction};
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateProgramRequest, ReadProgramRequest};

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
}
