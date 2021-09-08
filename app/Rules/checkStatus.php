<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class checkStatus implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (strtolower($value) === "on going" || strtolower($value) === "done") {
            return true;
        } 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' Must input "On Going" or "Done" ';
    }
}
