<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Support\Facades\DB;

class availableQtyRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $availableQty = DB::table('products')->value('stock_quantity');

        if ($value > $availableQty) {
            $fail("The {$attribute} must be strictly less than or equal to {$availableQty}.");
        }
    }
}
