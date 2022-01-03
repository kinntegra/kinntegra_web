<?php

namespace App\Traits;

trait ManageExternal
{
    /**
     *
     *
     */
    public function getExternalAssociate($id)
    {
        return $this->makeRequest('Get', "external_associate/{$id}");
    }

    public function updateExternalAssociateStatus($data)
    {
        return $this->makeRequest(
			'POST',
			"external_associate",
			[],
			$data,
		);
    }

    public function updateExternalEmployeeStatus($data)
    {
        return $this->makeRequest(
			'POST',
			"external_employee",
			[],
			$data,
		);
    }

    public function getExternalAssociateApproved($data)
    {
        return $this->makeRequest(
			'POST',
			"external_associate",
			[],
			$data,
		);
    }

    //
    public function getExternalAssociateAccepted($data)
    {
        return $this->makeRequest(
			'POST',
			"external_associate",
			[],
			$data,
		);
    }

    /**
     * Get Associate Details
     *
     */
    public function getExternalEmployee($id)
    {
        return $this->makeRequest('Get', "external_employee/{$id}");
    }

    /**
     * Get External Client Account Details
     *
     */
    public function getExternalClientAccountDetail($client_id,$profile_id)
    {
        return $this->makeRequest('Get', "external/client/{$client_id}/profile/{$profile_id}/verify");
    }

    /**
     * Set External Client Account Details
     *
     */
    public function setExternalClientAccountDetail($data,$client_id,$profile_id)
    {
        return $this->makeRequest(
                                'POST',
                                "external/client/{$client_id}/profile/{$profile_id}/verify",
                                [],
                                $data,
                            );
    }

    public function getExternalBuyOrder($id)
    {
        return $this->makeRequest('Get', "transactionbuyorder",['param' => $id]);
    }

    public function getExternalSchemeLogDetail($id)
    {
        return $this->makeRequest('Get', "transactionorder",['fund_id' => $id]);
    }

    public function setExternalBuyOrder($data)
    {
        return $this->makeRequest(
            'POST',
            "transactionbuyorder",
            [],
            $data,
        );
    }

    public function setExternalBuyPaymentOrder($id)
    {
        return $this->makeRequest(
            'POST',
            "transactionbuyorder/payment/{$id}",
        );
    }
}
