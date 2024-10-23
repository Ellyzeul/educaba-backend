<?php

namespace App\Rules;

use App\Repositories\OrganizationRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class OrganizationId implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string = null): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value === null) {
            return;
        }

        if(!is_string($value)) {
            $fail("The $attribute field must be a string.");
        }

        if(Str::length($value) !== 26) {
            $fail("The $attribute field doesn't have 26 characters.");
        }

        if((new OrganizationRepository)->find($value) === null) {
            $fail("The $attribute passed doesn't exists.");
        }
    }
}
