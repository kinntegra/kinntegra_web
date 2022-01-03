<?php

namespace App\Traits;

trait ManageTradeLog
{
    public function getTradeLogClients()
    {
        return $this->makeRequest('Post', "tradelog");
    }

    public function getTradeLogGroups($trans_buy_clients_id,$ucc,$type)
    {
        return $this->makeRequest('Get', "tradelog_group/{$trans_buy_clients_id}/{$ucc}/{$type}");
    }

    public function getTradeLogTransactions($trans_buy_clients_id,$type)
    {
        return $this->makeRequest('Get', "tradelog_transaction/{$trans_buy_clients_id}/{$type}");
    }
}
