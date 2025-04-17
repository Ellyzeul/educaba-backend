<?php

namespace App\Actions\Contact;

use App\Http\Requests\UpdateContactRequest;
use App\Repositories\ContactRepository;
use Illuminate\Http\Response;

class UpdateAction
{
  public function handle(UpdateContactRequest $request)
  {
    $contact = (new ContactRepository)->update($request->validated(), $request->patient_id);

    if(!$contact) {
      return response([
        'message' => __('messages.action.contact.update.not_found'),
      ], Response::HTTP_BAD_REQUEST);
    }

    return $contact;
  }
}