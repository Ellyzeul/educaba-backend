<?php

namespace App\Actions\Patient;

use App\Http\Requests\CreatePatientRequest;
use App\Repositories\PatientRepository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class CreateAction
{
  use HandlesImage;

  public function __construct()
  {
    $this->disk = Storage::disk('profile_picture');
  }

  public function handle(CreatePatientRequest $request)
  {
    $data = $request->validated();
    $data['image'] = $this->handleImage($data['image']);

    return (new PatientRepository)->create($data, $request->user()->organization_id);
  }
}
