<?php

namespace App\Rules;

use App\Services\MarketService;
use Illuminate\Contracts\Validation\Rule;

class CheckPanNo implements Rule
{
    protected $a_id;
    protected $e_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($aid,$eid)
    {
        $this->a_id = $aid;
        $this->e_id = $eid;
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
            $result = $marketService->checkUserPanNo($value, $this->a_id, $this->e_id);
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
        return 'Pan No already exists.';
    }
}
