<?php

namespace App\Rules\Lead;

use App\Services\MarketService;
use Illuminate\Contracts\Validation\Rule;

class CheckMobileNo implements Rule
{
    public $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
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
            $marketService = resolve(MarketService::class);
            $id =  $this->id ?? 0;
            $result = $marketService->checkLeadMobile($value,$id);
            //dd($result);
            if($result === true)
            return false;
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mobile No Already Exists';
    }
}
