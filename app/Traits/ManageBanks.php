<?php

namespace App\Traits;

trait ManageBanks
{
    /**
     *  Get the Bank information from API
     */
    public function getBankInfo($id)
    {
        return $this->makeRequest('Get', "/master/bankcode/{$id}");
    }
}
