<?php

namespace App\Repositories;

use App\Models\Patient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PatientRepository
{
  private const TTL = 86400;
  private const KEY = 'patients';

  public function list(): Collection
  {
    return Cache::remember(self::KEY, self::TTL, fn() => Patient::get());
  }

  public function find(mixed $value, string $field = 'id')
  {
    return $this->list()
      ->filter(fn(Patient $patient) => $patient->{$field} === $value)
      ->first();
  }

  public function create(array $data)
  {
    $patient = new Patient($data);
    $patient->save();

    $this->updateCache($patient);

    return $patient;
  }

  public function update(array $data)
  {
    $patient = $this->find($data['id']);
    if($patient === null) return false;

    collect($data)->each(fn($value, $attr) => $patient->{$attr} = $value);
    $patient->save();

    $this->updateCache($patient);

    return $patient;
  }

  private function updateCache(Patient $patient, bool $delete = false)
  {
    $all = $this->list()->filter(fn(Patient $cached) => $cached->id !== $patient->id);

    Cache::put(self::KEY, $delete ? $all : $all->push($patient));
  }
}
