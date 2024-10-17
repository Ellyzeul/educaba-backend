<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait HasApiFailResponse
{
  public function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response([
        'success' => false,
        'errors' => $validator->errors(),
    ], 422));
  }
}
