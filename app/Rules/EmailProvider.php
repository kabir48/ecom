<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class EmailProvider implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
      public function passes($attribute, $value)
    {
        $domain = explode('@', $value)[1] ?? '';

        if (strpos($domain, 'gmail.com') !== false) {
            return true;
        } elseif (strpos($domain, 'yahoo.com') !== false) {
            return true;
        } elseif (strpos($domain, 'hotmail.com') !== false || strpos($domain, 'outlook.com') !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function message()
    {
        return 'The :attribute must be a valid Gmail, Yahoo, Hotmail, or Outlook email address.';
    }
}
