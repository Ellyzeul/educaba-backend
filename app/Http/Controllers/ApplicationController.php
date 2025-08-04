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
    /**
     * @response array{program_id: "01jd8y1hf05zjg3jzbktnxrtw4", goal_id: "01jd8y1hf05zjg3jzbktnxrtw4", goal_name: string|null, inputs: array{name: "string", value: "any"}[], created_at: "2024-11-22T03:18:25.000000Z", updated_at: "2024-11-22T03:18:25.000000Z"}
     */
    public function create(CreateApplicationRequest $request)
    {
        return (new CreateAction)->handle($request);
    }

    /**
     * @response array{program_id: "01jd8y1hf05zjg3jzbktnxrtw4", goal_id: "01jd8y1hf05zjg3jzbktnxrtw4", goal_name: string|null, inputs: array{name: "string", value: "any"}[], created_at: "2024-11-22T03:18:25.000000Z", updated_at: "2024-11-22T03:18:25.000000Z"}[]
     */
    public function read(ReadApplicationRequest $request)
    {
        return (new ReadAction)->handle($request);
    }

    /**
     * @response array{program_id: "01jd8y1hf05zjg3jzbktnxrtw4", goal_id: "01jd8y1hf05zjg3jzbktnxrtw4", goal_name: string|null, inputs: array{name: "string", value: "any"}[], created_at: "2024-11-22T03:18:25.000000Z", updated_at: "2024-11-22T03:18:25.000000Z"}
     */
    public function update(UpdateApplicationRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }

    public function delete(DeleteApplicationRequest $request)
    {
        return (new DeleteAction)->handle($request);
    }
}
