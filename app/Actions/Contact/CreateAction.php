<?php

namespace App\Actions\Contact;

use App\Http\Requests\CreateContactRequest;
use App\Repositories\ContactRepository;

class CreateAction
{
  public function handle(CreateContactRequest $request)
  {
    return (new ContactRepository)->create([
      'name' => $request->name,
      'cpf' => $request->cpf,
      'relationship' => $request->relationship,
      'email' => $request->email,
      'phone_primary' => $request->phone_primary,
      'phone_secondary' => $request->phone_secondary,
      'patient_id' => $request->patient_id,
    ], $request->patient_id);
  }
}