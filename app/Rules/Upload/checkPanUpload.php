<?php

namespace App\Rules\Upload;

use Illuminate\Contracts\Validation\Rule;

class checkPanUpload implements Rule
{
    protected $id;
    protected $edit;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id,$edit)
    {
        $this->id = $id;
        $this->edit = $edit;
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

        if(($this->id == 1 || $this->id == 2 || $this->id == 3 || $this->id == 4) && $this->edit == 0)
        {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Upload Pancard';
    }
}
