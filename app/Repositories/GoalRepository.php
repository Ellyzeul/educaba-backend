<?php

namespace App\Repositories;

use App\Models\Goal;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class GoalRepository
{
  private const TTL = 86400;

  public function list(string $programSetId): Collection
  {
    return Cache::remember(
      $this->key($programSetId),
      self::TTL,
      fn() => Goal::where('program_set_id', $programSetId)->get()
    );
  }

  public function find(mixed $value, string $programSetId, string $field = 'id')
  {
    return $this->list($programSetId)
      ->filter(fn(Goal $goal) => $goal->{$field} === $value)
      ->first();
  }

  public function create(array $data, string $programSetId)
  {
    $goal = new Goal($data);
    $goal->save();

    $this->updateCache($goal, $programSetId);

    return $goal;
  }

  public function update(array $data, string $programSetId)
  {
    $goal = $this->find($data['id'], $programSetId);
    if($goal === null) return false;

    collect($data)->each(fn($value, $attr) => $goal->{$attr} = $value);
    $goal->save();

    $this->updateCache($goal, $programSetId);

    return $goal;
  }

  public function delete(string $id, string $programSetId)
  {
    $goal = $this->find($id, $programSetId);
    if($goal === null) return false;

    $goal->delete();
    $this->updateCache($goal, $programSetId, delete: true);

    return true;
  }

  private function updateCache(Goal $goal, string $programSetId, bool $delete = false)
  {
    $all = collect($this
      ->list($programSetId)
      ->filter(fn(Goal $cached) => $cached->id !== $goal->id)
      ->values()
    );

    Cache::put($this->key($programSetId), $delete ? $all : $all->push($goal));
  }

  private function key(string $programSetId)
  {
    return "goals-from-$programSetId";
  }
}
