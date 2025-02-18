<?php

namespace App\Actions\User;

use App\Http\Requests\CreateUserRequest;
use App\Models\Organization;
use App\Models\User;
use App\Repositories\OrganizationRepository;
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

    return response($user, Response::HTTP_CREATED);
  }

  private function createEmptyOrganization(User $user)
  {
    $organization = (new OrganizationRepository)->create(['user_id' => $user->id]);

    return $organization;
  }
}
