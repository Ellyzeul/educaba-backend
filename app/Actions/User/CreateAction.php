<?php

namespace App\Actions\User;

use App\Http\Requests\CreateUserRequest;
use App\Models\Organization;
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

    if(!isset($user->organization_id)) {
      $organization = $this->createEmptyOrganization($user);
      
      $user->organization_id = $organization->id;
      $user->save();
    }

    return $user;
  }

  private function createEmptyOrganization(User $user)
  {
    $organization = new Organization(['user_id' => $user->id]);
    $organization->save();

    return $organization;
  }
}
