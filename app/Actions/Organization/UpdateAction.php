<?php

namespace App\Actions\Organization;

use App\Http\Requests\UpdateOrganizationRequest;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\Response;

class UpdateAction
{
  public function handle(UpdateOrganizationRequest $request)
  {
    $organization = (new OrganizationRepository)->update($request->validated());

    if(!$organization) {
      return response([
        'message' => __('messages.action.organization.not_found'),
      ], Response::HTTP_BAD_REQUEST);
    }

    return response($organization, Response::HTTP_OK);
  }
}
