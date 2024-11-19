<?php

namespace App\Http\Controllers;

use App\Actions\Program\{CreateAction};
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateProgramRequest};

class ProgramController extends Controller
{
    public function create(CreateProgramRequest $request)
    {
        return (new CreateAction)->handle($request);
    }
}
