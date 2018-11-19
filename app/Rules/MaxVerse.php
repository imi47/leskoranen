<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxVerse implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $max , $allowed;
    public function __construct($max)
    {
        $this->max = $max;
        $this->allowed = 0;
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
        $this->allowed = 25;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Max Verse can be ' . $allowed;
    }
}
