<?php

namespace App\Actions\User;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ReadAction
{
  public function handle(Request $request)
  {
    return (new UserRepository)->list($request->user()->organization_id);
  }
}
