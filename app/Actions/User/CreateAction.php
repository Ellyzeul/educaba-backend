<?php

namespace App\Actions\User;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class CreateAction
{
  public function handle(CreateUserRequest $request)
  {
    $user = (new UserRepository())->create($request->validated());

    if(!$user) {
      return response([
        'message' => __('messages.action.user.create.duplicate'),
      ], Response::HTTP_BAD_REQUEST);
    }

    return $user;
  }
}
