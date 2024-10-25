<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Image implements ValidationRule
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

        if(!isset($value['base64']) || !isset($value['extension'])) {
            $fail("The $attribute field must have the following properties: ['base64', 'extension'].");
            return;
        }

        if(!$this->isBase64($value['base64'])) {
            $fail("The $attribute field is not a valid base64 string.");
        }
    }

    private function isBase64(string $str)
    {
        if(!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $str)) {
            return false;
        }
    
        $decoded = base64_decode($str, true);
        if($decoded === false) {
            return false;
        }

        if(base64_encode($decoded) != $str) {
            return false;
        }
    
        return true;
    }
}
