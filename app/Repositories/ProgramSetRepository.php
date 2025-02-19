<?php

namespace App\Repositories;

use App\Models\ProgramSet;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProgramSetRepository
{
  private const TTL = 86400;

  public function list(string $programId): Collection
  {
    return Cache::remember(
      $this->key($programId),
      self::TTL,
      fn() => ProgramSet::where('program_id', $programId)->get()
    );
  }

  public function find(mixed $value, string $programId, string $field = 'id')
  {
    return $this->list($programId)
      ->filter(fn(ProgramSet $programSet) => $programSet->{$field} === $value)
      ->first();
  }

  public function create(array $data, string $programId)
  {
    $programSet = new ProgramSet($data);
    $programSet->save();

    $this->updateCache($programSet, $programId);

    return $programSet;
  }

  public function update(array $data, string $programId)
  {
    $programSet = $this->find($data['id'], $programId);
    if($programSet === null) return false;

    collect($data)->each(fn($value, $attr) => $programSet->{$attr} = $value);
    $programSet->save();

    $this->updateCache($programSet, $programId);

    return $programSet;
  }

  public function delete(string $id, string $programId)
  {
    $programSet = $this->find($id, $programId);
    if($programSet === null) return false;

    $programSet->delete();
    $this->updateCache($programSet, $programId, delete: true);

    return true;
  }

  private function updateCache(ProgramSet $programSet, string $programId, bool $delete = false)
  {
    $all = $this->list($programId)->filter(fn(ProgramSet $cached) => $cached->id !== $programSet->id);

    Cache::put($this->key($programId), $delete ? $all : $all->push($programSet));
  }

  private function key(string $programId)
  {
    return "program-sets-from-$programId";
  }
}
