<?php

namespace App\Rules;

use App\Services\MarketService;
use Illuminate\Contracts\Validation\Rule;

class CheckPIN implements Rule
{
    protected $pin;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($pin)
    {
        $this->pin = $pin;
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
        if($value)
        {
            if($this->pin == $value)
            {
                return true;
            }
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Enter Valid PIN.';
    }
}
