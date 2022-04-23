<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PositionsAreUnique implements Rule
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
        $positions = collect($value)->map(fn($row) => $row['position']);

        return count($positions) === count($positions->unique());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The provided positions must be unique.';
    }
}
