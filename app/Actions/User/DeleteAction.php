<?php

namespace App\Actions\User;

use App\Http\Requests\DeleteUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class DeleteAction
{
  public function handle(DeleteUserRequest $request)
  {
    $id = $request->input('id') ?? $request->user()->id;

    $success = (new UserRepository)->delete($id, $request->user()->organization_id);

    return $success
      ? ['message' => __('messages.action.user.delete.ok')]
      : response(['message' => __('messages.action.user.delete.not_found')], Response::HTTP_BAD_REQUEST);
  }
}
