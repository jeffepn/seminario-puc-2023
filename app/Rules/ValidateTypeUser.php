<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateTypeUser implements ValidationRule
{

    public function __construct(protected int $type)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = User::where('id', $value)->where('type', $this->type)->exists();

        if (!$exists) {
            $fail("Forneça um usuário do tipo {$this->type} válido.");
        }
    }
}
