<?php

namespace App\Traits;

trait ManageTransaction
{
    public function getTransactionClients()
    {
        return $this->makeRequest('Get', "transaction/client");
    }

    public function getPendingTransactions()
    {
        return $this->makeRequest('Get', "transaction/newtransaction", ['pending_list' => 1]);
    }

    public function getTransactionClientDetails($id)
    {
        return $this->makeRequest('Get', "transaction/newtransaction", ['id' => $id]);
    }

    public function getTransactionLogClientDetails($id)
    {
        return $this->makeRequest('Get', "transaction/newtransaction", ['id' => $id]);
    }

    public function getTransactionPaymentDetails($tid,$id)
    {
        return $this->makeRequest('Get', "transaction/{$tid}/payment/{$id}");
    }

    public function setNewTransaction($data)
    {
        return $this->makeRequest('POST', "transaction/newtransaction", [], $data);
    }

    public function setNewTransactionAllocation($data,$id)
    {
        return $this->makeRequest('POST', "transaction/newtransaction/{$id}", [], $data);
    }

    public function setNewTransactionPayment($data)
    {
        return $this->makeRequest('POST', "transaction/newtransaction", [], $data);
    }

    public function getTransactionClientAllocationDetails($id,$data)
    {
        return $this->makeRequest('GET', "transaction/newtransaction", $data);
    }

    public function getTransactionAllocationDetails($id)
    {
        return $this->makeRequest('GET', "transaction/allocation", ['id' => $id]);
    }

    public function delSWPTransaction($id)
    {
        return $this->makeRequest('GET', "transaction/newtransaction/{$id}");
    }

    public function setTransactionamount($id,$amount,$withdrawal_amount,$equity,$type,$description)
    {
        return $this->makeRequest('GET', "transaction/newtransaction/create",
        [
            'id' => $id,
            'amount' => $amount,
            'withdrawal_amount' => $withdrawal_amount,
            'equity' =>$equity,
            'type' => $type,
            'description' => $description,
        ]);
    }

    public function GetTransactionDetail($id)
    {
        return $this->makeRequest('Get', "transaction/payment", ['id' => $id]);
    }

    public function setPaymentMode($data)
    {

        return $this->makeRequest(
			'POST',
			"transaction/{$data['transactionsession']}/payment",
			[],
			$data,
            [],
            $hasFile = isset($data['cheque_upload'])
                    || isset($data['cheque_upload_1'])
                    || isset($data['cheque_upload_2'])
                    || isset($data['cheque_upload_3'])
                    || isset($data['cheque_upload_4'])
                    || isset($data['cheque_upload_5'])
                    || isset($data['cheque_upload_6'])
                    || isset($data['cheque_upload_7'])
		);
    }

    public function deleteTransactionClientDetails($tid,$id)
    {
        return $this->makeRequest(
            'DELETE',
            "transaction/{$tid}/payment/{$id}"
        );

    }

}
