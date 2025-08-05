<?php

namespace App\Repositories;

use App\Models\Organization;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class OrganizationRepository
{
  private const TTL = 86400;
  private const KEY = 'organizations';

  public function list(): Collection
  {
    return Cache::remember(self::KEY, self::TTL, fn() => Organization::get());
  }

  public function find(mixed $value, string $field = 'id')
  {
    return $this->list()
      ->filter(fn(Organization $organization) => $organization->{$field} === $value)
      ->first();
  }

  public function create(array $data)
  {
    if($this->find($data['user_id'], 'user_id') !== null) {
      return false;
    }

    $organization = new Organization($data);
    $organization->save();

    $this->updateCache($organization);

    return $organization;
  }

  public function update(array $data)
  {
    $organization = $this->find($data['id']);
    if($organization === null) return false;

    collect($data)->each(fn($value, $attr) => $organization->{$attr} = $value);
    $organization->save();

    $this->updateCache($organization);

    return $organization;
  }

  private function updateCache(Organization $organization, bool $delete = false)
  {
    $all = collect($this
      ->list()
      ->filter(fn(Organization $cached) => $cached->id !== $organization->id)
      ->values()
    );

    Cache::put(self::KEY, $delete ? $all : $all->push($organization));
  }
}
