<?php

namespace App\Http\Controllers;

use App\Actions\Program\{CreateAction, DeleteAction, ReadAction, UpdateAction};
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateProgramRequest, DeleteProgramRequest, ReadProgramRequest, UpdateProgramRequest};

class ProgramController extends Controller
{
    /**
     * @response array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string, inputs: array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string}[], has_single_set: boolean, patient_id: "01jd8y1hf05zjg3jzbktnxrtw4", sets: array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string, goals: array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string}[]}[], created_at: "2024-11-22T03:18:25.000000Z", updated_at: "2024-11-22T03:18:25.000000Z"}
     */
    public function create(CreateProgramRequest $request)
    {
        return (new CreateAction)->handle($request);
    }

    /**
     * @response array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string, inputs: array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string}[], has_single_set: boolean, patient_id: "01jd8y1hf05zjg3jzbktnxrtw4", sets: array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string, goals: array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string}[]}[], created_at: "2024-11-22T03:18:25.000000Z", updated_at: "2024-11-22T03:18:25.000000Z"}[]
     */
    public function read(ReadProgramRequest $request)
    {
        return (new ReadAction)->handle($request);
    }

    /**
     * @response array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string, inputs: array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string}[], has_single_set: boolean, patient_id: "01jd8y1hf05zjg3jzbktnxrtw4", sets: array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string, goals: array{id: "01jd8y1hf05zjg3jzbktnxrtw4", name: string}[]}[], created_at: "2024-11-22T03:18:25.000000Z", updated_at: "2024-11-22T03:18:25.000000Z"}
     */
    public function update(UpdateProgramRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }

    public function delete(DeleteProgramRequest $request)
    {
        return (new DeleteAction)->handle($request);
    }
}
