<?php

namespace App\Repositories;

use App\Models\Program;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProgramRepository
{
  private const TTL = 86400;

  public function list(string $patientId): Collection
  {
    return Cache::remember(
      $this->key($patientId),
      self::TTL,
      fn() => Program::where('patient_id', $patientId)->get()
    );
  }

  public function find(mixed $value, string $patientId, string $field = 'id')
  {
    return $this->list($patientId)
      ->filter(fn(Program $program) => $program->{$field} === $value)
      ->first();
  }

  public function create(array $data, string $patientId)
  {
    $program = new Program($data);
    $program->save();

    $this->updateCache($program, $patientId);

    return $program;
  }

  public function update(array $data, string $patientId)
  {
    $program = $this->find($data['id'], $patientId);
    if($program === null) return false;

    collect($data)->each(fn($value, $attr) => $program->{$attr} = $value);
    $program->save();

    $this->updateCache($program, $patientId);

    return $program;
  }

  public function delete(string $id, string $patientId)
  {
    $program = $this->find($id, $patientId);
    if($program === null) return false;

    $program->delete();
    $this->updateCache($program, true);

    return true;
  }

  private function updateCache(Program $program, string $patientId, bool $delete = false)
  {
    $all = $this->list($patientId)->filter(fn(Program $cached) => $cached->id !== $program->id);

    Cache::put($this->key($patientId), $delete ? $all : $all->push($program));
  }

  private function key(string $patientId)
  {
    return "programs-from-$patientId";
  }
}
