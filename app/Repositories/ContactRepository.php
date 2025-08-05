<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ContactRepository
{
  private const TTL = 86400;

  public function list(string $patientId): Collection
  {
    return Cache::remember(
      $this->key($patientId),
      self::TTL,
      fn() => Contact::where('patient_id', $patientId)->get()
    );
  }

  public function find(mixed $value, string $patientId, string $field = 'id')
  {
    return $this->list($patientId)
      ->filter(fn(Contact $contact) => $contact->{$field} === $value)
      ->first();
  }

  public function create(array $data, string $patientId)
  {
    $contact = new Contact($data);
    $contact->save();

    $this->updateCache($contact, $patientId);

    return $contact;
  }

  public function update(array $data, string $patientId)
  {
    $contact = $this->find($data['id'], $patientId);
    if($contact === null) return false;

    collect($data)->each(fn($value, $attr) => $contact->{$attr} = $value);
    $contact->save();

    $this->updateCache($contact, $patientId);

    return $contact;
  }

  public function delete(string $id, string $patientId)
  {
    $contact = $this->find($id, $patientId);
    if($contact === null) return false;

    $contact->delete();
    $this->updateCache($contact, $patientId, delete: true);

    return true;
  }

  private function updateCache(Contact $contact, string $patientId, bool $delete = false)
  {
    $all = collect($this
      ->list($patientId)
      ->filter(fn(Contact $cached) => $cached->id !== $contact->id)
      ->values()
    );

    Cache::put($this->key($patientId), $delete ? $all : $all->push($contact));
  }

  private function key(string $patientId)
  {
    return "contacts-from-$patientId";
  }
}