<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ThaiID implements Rule
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
        $value .= '';

        if (strlen($value) !== 13) {
            return false;
        }

        for ($sum = 0, $i = 0; $i < 12; $i++) {
            $sum += (int) ($value[$i]) * (13 - $i);
        }

        return (11 - ($sum % 11)) % 10 === (((int) substr($value, 12, 1)));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'รหัสประจำตัวประชาชนไม่ถูกต้อง';
    }
}
