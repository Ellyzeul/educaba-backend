<?php

namespace App\Actions\Patient;

use App\Http\Requests\CreatePatientRequest;
use App\Repositories\PatientRepository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Uid\Ulid;

class CreateAction
{
  private Filesystem $disk;

  public function __construct()
  {
    $this->disk = Storage::disk('profile_picture');
  }

  public function handle(CreatePatientRequest $request)
  {
    $data = $request->validated();
    $data['image'] = $this->handleImage($data['image']);

    return (new PatientRepository)->create($data);
  }

  private function handleImage(array $imageData)
  {
    $ext = $imageData['extension'];
    $filename = $this->getImageFilename($ext);

    $this->disk->put("/$filename", base64_decode($imageData['base64']));

    return "/profile-picture/$filename";
  }

  private function getImageFilename(string $ext)
  {
    $filename = Ulid::generate() . ".$ext";

    while($this->disk->exists($filename)) {
      $filename = Ulid::generate() . ".$ext";
    }

    return $filename;
  }
}
