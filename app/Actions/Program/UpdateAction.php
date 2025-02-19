<?php

namespace App\Actions\Program;

use App\Http\Requests\UpdateProgramRequest;
use App\Models\Program;
use App\Models\ProgramSet;
use App\Repositories\GoalRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\ProgramSetRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UpdateAction
{
  public function handle(UpdateProgramRequest $request)
  {
    $organizationId = $request->user()->organization_id;
    if($organizationId === null) {
      return response([
        'message' => __('messages.action.program.update.without_organization'),
      ], Response::HTTP_BAD_REQUEST);
    }
    $repository = new ProgramRepository();
    $data = $request->validated();
    $program = $repository->find($data['id'], $data['patient_id']);

    $this->updateProgram($data);
    $this->updateProgramSets($data, $program, $organizationId);

    return $repository->find($data['id'], $data['patient_id']);
  }

  private function updateProgram(array $data)
  {
    (new ProgramRepository)->update([
      'id' => $data['id'],
      'name' => $data['name'],
      'inputs' => $data['inputs'],
      'has_single_set' => $data['has_single_set'] ?? false,
      'patient_id' => $data['patient_id'],
    ], $data['patient_id']);
  }

  private function updateProgramSets(array $data, Program $program, string $organizationId)
  {
    $key = $this->getNameKey($data);

    $key = $this->updateExistingSets(
      $program,
      $organizationId,
      $key,
      collect($data['sets'])->filter(fn(array $item) => isset($item['id']))
    );
    $this->createNewSets(
      $program,
      $organizationId,
      $key,
      collect($data['sets'])->filter(fn(array $item) => !isset($item['id']))
    );
  }

  private function getNameKey(array $data)
  {
    $key = 1;
    $name = $data['name'];

    foreach($data['sets'] as $dataSet) {
      if(Str::of($dataSet['name'] ?? '')->test("/$name #[0-9]{1,}/")) {
        $key = max($key, intval(explode('#', $dataSet['name'])[1]) + 1);
      }
    }

    return $key;
  }

  private function createNewSets(Program $program, string $organizationId, int $key, Collection $sets)
  {
    $repository = new ProgramSetRepository();

    $sets->each(function(array $setData) use ($repository, $program, $organizationId) {
      $programSet = $repository->create([
        'name' => $setData['name'],
        'program_id' => $program->id,
        'organization_id' => $organizationId,
      ], $program->id);

      $this->createGoals($setData, $programSet->id);
    });

    return $key;
  }

  private function createGoals(array $setData, string $programSetId)
  {
    $repository = new GoalRepository();

    foreach($setData['goals'] as $goalData) {
      $repository->create([
        'name' => $goalData['name'],
        'program_set_id' => $programSetId,
      ], $programSetId);
    }
  }

  private function updateExistingSets(Program $program, string $organizationId, int $key, Collection $sets)
  {
    $repository = new ProgramSetRepository();

    foreach($program->sets as $set) {
      $newSet = $sets->filter(fn(array $item) => $item['id'] === $set->id)->first();

      if($newSet !== null) {
        $repository->update([
          'id' => $newSet['id'],
          'name' => $newSet['name'] ?? $program->name . ' #' . $key++,
          'program_id' => $program->id,
          'organization_id' => $organizationId,
        ], $program->id);
        $this->updateGoals($newSet, $set);
      }
      else {
        $this->updateGoals([], $set);
        $repository->delete($set->id, $program->id);
      }
    }

    return $key;
  }

  private function updateGoals(array $setData, ProgramSet $set)
  {
    $repository = new GoalRepository();

    foreach($set->goals as $goal) {
      $newGoal = collect($setData['goals'] ?? [])->filter(fn(array $item) => $item['id'] === $goal->id)->first();

      if($newGoal !== null) {
        $repository->update([
          'id' => $newGoal['id'],
          'name' => $newGoal['name'],
          'program_set_id' => $set->id,
        ], $set->id);
      }
      else {
        $repository->delete($goal->id, $set->id);
      }
    }
  }
}
