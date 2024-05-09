<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GreatThanZero implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $price = (integer)(floatval(str_replace(' ', '', $value)) * 100);

        if($price < 0)
            $fail('The :attribute must be greater than zero.');

    }
}
