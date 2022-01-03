<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
class checkGST implements Rule
{
    protected $pan;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($pan)
    {
        $this->pan = $pan;
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
            $cnt = Str::length($value);
            //dd('astart'.$value.'aend'.$this->pan);
            if($cnt == 15)
            {
                $pan = strtoupper(substr($value, 2, 10));

                if($pan == strtoupper($this->pan))
                {
                    $val1 = substr($value, 0, 2);
                    if(is_numeric($val1))
                    {
                        $val2 = substr($value, 13, 1);
                        if($val2 == 'Z' || $val2 =='z')
                        {
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Enter Valid GST NO.';
    }
}
