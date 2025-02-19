<?php

namespace App\Repositories;

use App\Models\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ApplicationRepository
{
  private const TTL = 86400;

  public function list(string $goalId): Collection
  {
    return Cache::remember(
      $this->key($goalId),
      self::TTL,
      fn() => Application::where('goal_id', $goalId)->get()
    );
  }

  public function find(mixed $value, string $goalId, string $field = 'id')
  {
    return $this->list($goalId)
      ->filter(fn(Application $application) => $application->{$field} === $value)
      ->first();
  }

  public function create(array $data, string $goalId)
  {
    $application = new Application($data);
    $application->save();

    $this->updateCache($application, $goalId);

    return $application;
  }

  public function update(array $data, string $goalId)
  {
    $application = $this->find($data['id'], $goalId);
    if($application === null) return false;

    collect($data)->each(fn($value, $attr) => $application->{$attr} = $value);
    $application->save();

    $this->updateCache($application, $goalId);

    return $application;
  }

  public function delete(string $id, string $goalId)
  {
    $application = $this->find($id, $goalId);
    if($application === null) return false;

    $application->delete();
    $this->updateCache($application, $goalId, delete: true);

    return true;
  }

  private function updateCache(Application $application, string $goalId, bool $delete = false)
  {
    $all = $this->list($goalId)->filter(fn(Application $cached) => $cached->id !== $application->id);

    Cache::put($this->key($goalId), $delete ? $all : $all->push($application));
  }

  private function key(string $goalId)
  {
    return "applications-from-$goalId";
  }
}
