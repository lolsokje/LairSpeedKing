<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PositionsProvided implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return array_key_exists('position', $value[0]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'You must provide at least one position.';
    }
}
