<?php

namespace App\Actions\Contact;

use App\Http\Requests\ReadContactRequest;
use App\Repositories\ContactRepository;

class ReadAction
{
  public function handle(ReadContactRequest $request)
  {
    return (new ContactRepository)->list($request->patient_id)->values();
  }
}