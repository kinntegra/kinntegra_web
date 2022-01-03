<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\MarketService;

class CheckEmail implements Rule
{
    protected $pan_no;
    protected $a_id;
    protected $e_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($pan,$aid,$eid)
    {
        $this->pan_no = $pan;
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
            $result = $marketService->checkUserEmail($value, $this->pan_no, $this->a_id, $this->e_id);
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
        return 'Email Address Already Exists';
    }
}
