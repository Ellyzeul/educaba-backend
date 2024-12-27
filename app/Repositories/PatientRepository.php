<?php

namespace App\Repositories;

use App\Models\Patient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PatientRepository
{
  private const TTL = 86400;

  public function list(string $organizationId): Collection
  {
    return Cache::remember(
      $this->key($organizationId),
      self::TTL,
      fn() => Patient::where('organization_id', $organizationId)->get()
    );
  }

  public function find(mixed $value, string $organizationId, string $field = 'id')
  {
    return $this->list($organizationId)
      ->filter(fn(Patient $patient) => $patient->{$field} === $value)
      ->first();
  }

  public function create(array $data, string $organizationId)
  {
    $patient = new Patient($data);
    $patient->save();

    $this->updateCache($patient, $organizationId);

    return $patient;
  }

  public function update(array $data, string $organizationId)
  {
    $patient = $this->find($data['id'], $organizationId);
    if($patient === null) return false;

    collect($data)->each(fn($value, $attr) => $patient->{$attr} = $value);
    $patient->save();

    $this->updateCache($patient, $organizationId);

    return $patient;
  }

  public function delete(string $id, string $organizationId)
  {
    $patient = $this->find($id, $organizationId);
    if($patient === null) return false;

    $patient->delete();
    $this->updateCache($patient, $organizationId, delete: true);

    return true;
  }

  private function updateCache(Patient $patient, string $organizationId, bool $delete = false)
  {
    $all = $this->list($organizationId)->filter(fn(Patient $cached) => $cached->id !== $patient->id);

    Cache::put($this->key($organizationId), $delete ? $all : $all->push($patient));
  }

  private function key(string $organizationId)
  {
    return "patients-from-$organizationId";
  }
}
