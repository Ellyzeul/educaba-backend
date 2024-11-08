<?php

namespace App\Actions\User;

use App\Http\Requests\LinkOrganizationUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class LinkOrganizationAction
{
  public function handle(LinkOrganizationUserRequest $request)
  {
    $user = User::where('email', $request->input('email'))->first();

    if($user === null) {
      return response([
        'message' => __('messages.action.user.link_organization.not_found'),
      ], Response::HTTP_BAD_REQUEST);
    }

    if($user->organization_id !== null) {
      return response([
        'message' => __('messages.action.user.link_organization.already_linked'),
      ], Response::HTTP_BAD_REQUEST);
    }

    $organizationId = $request->user()->organization_id;
    $user->organization_id = $organizationId;
    $user->save();

    (new UserRepository)->push($user, $organizationId);

    return [
      'message' => __('messages.action.user.link_organization.ok'),
    ];
  }
}
