<?php

namespace App\Actions\Patient;

use App\Http\Requests\DeletePatientRequest;
use App\Models\{Contact, Patient};
use App\Repositories\{ContactRepository, PatientRepository};
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DeleteAction
{
  use HandlesImage;
  
  private PatientRepository $respository;

  public function __construct()
  {
    $this->respository = new PatientRepository();
    $this->disk = Storage::disk('profile_picture');
  }

  public function handle(DeletePatientRequest $request)
  {
    $organzationId = $request->user()->organization_id;
    $patient = $this->respository->find($request->input('id'), $organzationId);

    $this->deleteCurrentImage($patient);
    $this->deleteContacts($patient);

    $success = (new PatientRepository)->delete($request->input('id'), $organzationId);

    return $success
      ? response(['message' => __('messages.action.patient.delete.ok')], Response::HTTP_OK)
      : response(['message' => __('messages.action.patient.delete.not_found')], Response::HTTP_BAD_REQUEST);
  }

  private function deleteContacts(Patient $patient)
  {
    $repository = new ContactRepository();

    $repository->list($patient->id)->each(fn(Contact $contact) => $repository->delete(
      $contact->id,
      $patient->id,
    ));
  }
}
