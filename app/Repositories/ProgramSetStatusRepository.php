<?php

namespace App\Repositories;

use App\Models\ProgramSetStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProgramSetStatusRepository
{
  private const TTL = 86400;

  public function list(string $organizationId): Collection
  {
    return Cache::remember(
      $this->key($organizationId),
      self::TTL,
      fn() => ProgramSetStatus::where('organization_id', $organizationId)
        ->orwhere('organization_id', null)
        ->get()
    );
  }

  public function find(mixed $value, string $organizationId, string $field = 'id')
  {
    return $this->list($organizationId)
      ->filter(fn(ProgramSetStatus $programSetStatus) => $programSetStatus->{$field} === $value)
      ->first();
  }

  public function create(array $data, string $organizationId)
  {
    $programSetStatus = new ProgramSetStatus($data);
    $programSetStatus->save();

    $this->updateCache($programSetStatus, $organizationId);

    return $programSetStatus;
  }

  public function update(array $data, string $organizationId)
  {
    $programSetStatus = $this->find($data['id'], $organizationId);
    if($programSetStatus === null) return false;

    collect($data)->each(fn($value, $attr) => $programSetStatus->{$attr} = $value);
    $programSetStatus->save();

    $this->updateCache($programSetStatus, $organizationId);

    return $programSetStatus;
  }

  public function delete(string $id, string $organizationId)
  {
    $programSetStatus = $this->find($id, $organizationId);
    if($programSetStatus === null) return false;

    $programSetStatus->delete();
    $this->updateCache($programSetStatus, $organizationId, delete: true);

    return true;
  }

  private function updateCache(ProgramSetStatus $programSetStatus, string $organizationId, bool $delete = false)
  {
    $all = collect($this
      ->list($organizationId)
      ->filter(fn(ProgramSetStatus $cached) => $cached->id !== $programSetStatus->id)
      ->values()
    );

    Cache::put($this->key($organizationId), $delete ? $all : $all->push($programSetStatus));
  }

  private function key(string $organizationId)
  {
    return "program-set-statuses-from-$organizationId";
  }
}
