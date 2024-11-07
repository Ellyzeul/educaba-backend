<?php

namespace App\Actions\User;

use App\Http\Requests\UnlinkOrganizationUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class UnlinkOrganizationAction
{
  private UserRepository $repository;

  public function __construct()
  {
    $this->repository = new UserRepository();
  }

  public function handle(UnlinkOrganizationUserRequest $request)
  {
    $organizationId = $request->user()->organization_id;
    $user = $this->repository->find($request->validated()['id'], $organizationId);

    if($user === null) {
      return response([
        'message' => __('messages.action.user.unlink_organization.not_found'),
      ], Response::HTTP_BAD_REQUEST);
    }

    $this->repository->delete($user->id, $organizationId, onlyMemory: true);
    $user->organization_id = null;
    $user->save();

    return [
      'message' => __('messages.action.user.unlink_organization.ok'),
    ];
  }
}
