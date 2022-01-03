<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\MarketService;

class CheckUsername implements Rule
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
        if($value)
        {
            $Service = resolve(MarketService::class);
            $result = $Service->checkUsername($value);
            if($result === true)
            return true;
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
        return 'PAN No not found in our record';
    }
}
