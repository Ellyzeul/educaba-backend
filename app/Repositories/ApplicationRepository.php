<?php

namespace App\Repositories;

use App\Models\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ApplicationRepository
{
  private const TTL = 86400;

  public function list(string $programId): Collection
  {
    return Cache::remember(
      $this->key($programId),
      self::TTL,
      fn() => Application::where('program_id', $programId)->get()
    );
  }

  public function find(mixed $value, string $programId, string $field = 'id')
  {
    return $this->list($programId)
      ->filter(fn(Application $application) => $application->{$field} === $value)
      ->first();
  }

  public function create(array $data, string $programId)
  {
    $application = new Application($data);
    $application->save();

    $this->updateCache($application, $programId);

    return $application;
  }

  public function update(array $data, string $programId)
  {
    $application = $this->find($data['id'], $programId);
    if($application === null) return false;

    collect($data)->each(fn($value, $attr) => $application->{$attr} = $value);
    $application->save();

    $this->updateCache($application, $programId);

    return $application;
  }

  public function delete(string $id, string $programId)
  {
    $application = $this->find($id, $programId);
    if($application === null) return false;

    $application->delete();
    $this->updateCache($application, $programId, delete: true);

    return true;
  }

  private function updateCache(Application $application, string $programId, bool $delete = false)
  {
    $all = $this->list($programId)->filter(fn(Application $cached) => $cached->id !== $application->id);

    Cache::put($this->key($programId), $delete ? $all : $all->push($application));
  }

  private function key(string $programId)
  {
    return "applications-from-$programId";
  }
}
