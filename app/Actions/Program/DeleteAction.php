<?php

namespace App\Actions\Program;

use App\Http\Requests\DeleteProgramRequest;
use App\Models\{Application, Goal, Program, ProgramSet};
use App\Repositories\{ApplicationRepository, GoalRepository, ProgramRepository, ProgramSetRepository};
use Illuminate\Http\Response;

class DeleteAction
{
  public function handle(DeleteProgramRequest $request)
  {
    $repository = new ProgramRepository();
    $program = $repository->find($request->id, $request->patient_id);

    $this->deleteApplications($program);
    $this->deleteSets($program);

    return $repository->delete($request->id, $request->patient_id)
      ? response(['message' => __('messages.action.program.delete.ok')], Response::HTTP_OK)
      : response(['message' => __('messages.action.program.delete.not_found')], Response::HTTP_BAD_REQUEST);
  }

  private function deleteApplications(Program $program)
  {
    $repository = new ApplicationRepository();

    $repository->list($program->id)->each(fn(Application $application) => $repository->delete(
      $application->id,
      $program->id,
    ));
  }

  private function deleteSets(Program $program)
  {
    $repository = new ProgramSetRepository();

    $repository->list($program->id)->each(function(ProgramSet $programSet) use($repository, $program) {
      $this->deleteGoals($programSet);

      $repository->delete($programSet->id, $program->id);
    });
  }

  private function deleteGoals(ProgramSet $programSet)
  {
    $repository = new GoalRepository();

    $repository->list($programSet->id)->each(fn(Goal $goal) => $repository->delete(
      $goal->id,
      $programSet->id,
    ));
  }
}