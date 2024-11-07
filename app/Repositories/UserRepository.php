<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
  const TTL = 86400;

  public function list(?string $organizationId): Collection
  {
    if(!isset($organizationId)) {
      return collect([]);
    }

    return Cache::remember(
      $this->key($organizationId),
      self::TTL,
      fn() => User::where('organization_id', $organizationId)->get() ?? collect([])
    );
  }

  public function find(string $id, ?string $organizationId)
  {
    return $this->list($organizationId)
      ->filter(fn(User $user) => $user->id ===$id)
      ->first();
  }

  public function create(array $data)
  {
    if(User::where('email', $data['email'])->exists()) {
      return false;
    }
    
    $user = new User($data);
    if(isset($data['organization_id']) && (new OrganizationRepository())->find($data['organization_id']) !== null) {
      $user->organization_id = $data['organization_id'];
    }

    $user->save();

    $this->updateCache($user, $user->organization_id);

    return $user;
  }

  public function update(array $data, ?string $organizationId)
  {
    $user = $this->find($data['id'], $organizationId);
    if($user === null) return false;

    collect($data)->each(fn($value, $attr) => $user->{$attr} = $value);
    $user->save();

    $this->updateCache($user, $organizationId);

    return $user;
  }

  public function delete(string $id, ?string $organizationId, bool $onlyMemory = false)
  {
    $user = $this->find($id, $organizationId);
    if($user === null) return false;

    if(!$onlyMemory) {
      $user->delete();
    }
  
    $this->updateCache($user, $organizationId, delete: true);

    return true;
  }

  private function updateCache(User $user, ?string $organizationId, bool $delete = false)
  {
    if($this->key($organizationId) === null) return;

    $users = $this->list($organizationId)->filter(fn(User $item) => $item->email !== $user->email);
    Cache::put($this->key($organizationId), $delete ? $users : $users->push($user));
  }

  private function key(?string $organizationId)
  {
    if(!isset($organizationId)) {
      return null;
    }

    return "users-from-$organizationId";
  }
}
