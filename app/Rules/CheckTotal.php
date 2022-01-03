<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckTotal implements Rule
{

    public $title;
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
        $this->title = $attribute;
        if($value == 100)
        {
            return true;
        }else{
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
        $attribute = $this->title;
        if($attribute == 'scheme_code_equity_regular_residence_total')
        {
            return 'Equity reqular residence total must be 100%';
        }
        if($attribute == 'scheme_code_equity_regular_nri_total')
        {
            return 'Equity reqular nri total must be 100%';
        }
        if($attribute == 'amc_code_equity_swp_residence_total')
        {
            return 'Equity swp residence total must be 100%';
        }
        if($attribute == 'scheme_code_equity_swp_nri_total')
        {
            return 'Equity swp nri total must be 100%';
        }
        if($attribute == 'scheme_code_debt_regular_residence_total')
        {
            return 'Debt reqular residence total must be 100%';
        }
        if($attribute == 'scheme_code_debt_regular_nri_total')
        {
            return 'Debt reqular nri total must be 100%';
        }
        if($attribute == 'amc_code_debt_swp_residence_total')
        {
            return 'Debt swp residence total must be 100%';
        }
        if($attribute == 'scheme_code_debt_swp_nri_total')
        {
            return 'Debt swp nri total must be 100%';
        }
    }
}
