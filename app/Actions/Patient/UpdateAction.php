<?php

namespace App\Actions\Patient;

use App\Http\Requests\UpdatePatientRequest;
use App\Repositories\PatientRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UpdateAction
{
  use HandlesImage;

  private PatientRepository $repository;

  public function __construct()
  {
    $this->repository = new PatientRepository();
    $this->disk = Storage::disk('profile_picture');
  }

  public function handle(UpdatePatientRequest $request)
  {
    $data = $request->validated();
    $patient = $this->repository->find($data['id']);

    if(isset($data['image'])) {
      $data['image'] = $this->handleImage($data['image'], $patient);
    }

    $patient = $this->repository->update($data);

    if(!$patient) {
      return response([
        'message' => __('messages.action.patient.update.not_found'),
      ], Response::HTTP_BAD_REQUEST);
    }

    return $patient;
  }
}
