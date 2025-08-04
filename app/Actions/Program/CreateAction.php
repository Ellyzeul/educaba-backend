<?php

namespace App\Actions\Program;

use App\Http\Requests\CreateProgramRequest;
use App\Models\Program;
use App\Repositories\GoalRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\ProgramSetRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CreateAction
{
  public function handle(CreateProgramRequest $request)
  {
    $data = $request->validated();
    $organizationId = $request->user()->organization_id;
    if($organizationId === null) {
      return response([
        'message' => __('messages.action.program.create.without_organization'),
      ], Response::HTTP_BAD_REQUEST);
    }

    $program = $this->createProgram($data);
    $this->createProgramSets($data, $program, $organizationId);

    return $program;
  }

  private function createProgram(array $data)
  {
    return (new ProgramRepository)->create([
      'name' => $data['name'],
      'inputs' => $data['inputs'],
      'has_single_set' => $data['has_single_set'] ?? false,
      'patient_id' => $data['patient_id'],
    ], $data['patient_id']);
  }

  private function createProgramSets(array $data, Program $program, string $organizationId)
  {
    $repository = new ProgramSetRepository();

    foreach($data['sets'] as $key => $setData) {
      $programSet = $repository->create([
        'name' => $setData['name'] ?? $program->name . ' #' . $key+1,
        'program_id' => $program->id,
        'organization_id' => $organizationId,
      ], $program->id);
      $this->createGoals($setData, $programSet->id);
    }
  }

  private function createGoals(array $setData, string $programSetId)
  {
    $repository = new GoalRepository();

    foreach($setData['goals'] as $goalData) {
      $repository->create([
        'name' => $goalData['name'],
        'program_set_status_id' => $goalData['program_set_status_id'] ?? Str::repeat('0', 26),
        'program_set_id' => $programSetId,
      ], $programSetId);
    }
  }
}
