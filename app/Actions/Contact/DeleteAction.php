<?php

namespace App\Actions\Contact;

use App\Http\Requests\DeleteContactRequest;
use App\Repositories\ContactRepository;

class DeleteAction
{
  public function handle(DeleteContactRequest $request)
  {
    return (new ContactRepository)->delete($request->id, $request->patient_id)
      ? response(['message' => __('messages.action.contact.delete.ok')])
      : response(['message' => __('messages.action.contact.delete.not_found')]);
  }
}