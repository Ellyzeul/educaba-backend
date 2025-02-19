<?php

namespace App\Actions\Patient;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Symfony\Component\Uid\Ulid;

trait HandlesImage
{
  private Filesystem $disk;

  private function handleImage(array $imageData, ?Model $updateModel = null)
  {
    if($updateModel !== null) {
      $this->deleteCurrentImage($updateModel);
    }

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

  private function deleteCurrentImage(Model $model)
  {
    $this->disk->delete(Str::replace('/profile-picture', '', $model->image));
  }
}
