<?php

namespace App\Traits;

trait ManageLeads
{

    /**
     *  Get All leads
     *
     */
    public function getLeads()
    {
        return $this->makeRequest('GET','lead');
    }

    /**
     *
     *
     */
    public function getIntroductionLeads()
    {
        return $this->makeRequest('GET','lead', ['type' => 'introduction']);
    }

    /**
     *
     *
     */
    public function getComprehensiveLeads()
    {
        return $this->makeRequest('GET','lead', ['type' => 'comprehensive']);
    }

    /**
     *
     *
     */
    public function getAccountOpenedLeads()
    {
        return $this->makeRequest('GET','lead', ['type' => 'account_opened']);
    }

    /**
     *
     *
     */
    public function getAccountPendingLeads()
    {
        return $this->makeRequest('GET','lead', ['type' => 'account_pending']);
    }


    /**
     * Create or Update New Lead
     *
     */
    public function setLead($data)
    {
        return $this->makeRequest(
			'POST',
			'lead',
			[],
			$data
		);
    }

    public function getSingleLead($id)
    {
        return $this->makeRequest('GET', "lead/{$id}/edit");
    }

    public function getSingleClientIntro($id)
    {
        return $this->makeRequest('GET', "client/{$id}/introduction");
    }

    public function getClientDetail($id)
    {
        return $this->makeRequest('GET', "client",['id' => $id]);
    }

    public function getClientProfileDetail($client_id,$profile_id)
    {
        return $this->makeRequest('GET', "client/{$client_id}/profile/{$profile_id}");
    }

    public function getSingleClient($id)
    {
        return $this->makeRequest('GET', "client/{$id}");
    }

    public function setIntroduction($id, $data)
    {
        return $this->makeRequest(
			'POST',
			"client/{$id}/introduction",
			[],
			$data
		);
    }

    public function setClientDetails($data,$count=0)
    {
        return $this->makeRequest(
			'POST',
			"client",
			[],
			$data,
            [],
            $hasFile = isset($data['pan_upload'])
                    || isset($data['kyc_upload'])
                    || isset($data['address_upload'])
                    || isset($data['birth_upload'])
                    || isset($data['bank1_upload'])
                    || isset($data['bank2_upload'])
                    || isset($data['bank3_upload'])
                    || isset($data['bank4_upload'])
                    || isset($data['bank5_upload'])
                    || isset($data['aof_upload'])
                    || isset($data['loe_upload'])
                    || isset($data['mandate1_upload'])
                    || isset($data['mandate2_upload'])
                    || isset($data['mandate3_upload'])
                    || isset($data['mandate4_upload'])
                    || isset($data['mandate5_upload'])
                    || isset($data['mandate6_upload'])
                    || isset($data['mandate7_upload'])
                    || isset($data['mandate8_upload'])
                    || isset($data['mandate9_upload'])
                    || isset($data['mandate10_upload'])
		);
    }

    public function setKycDetail($id, $data)
    {
        return $this->makeRequest(
			'POST',
			"client/{$id}/kycdetail",
			[],
			$data
		);
    }

    public function getKycProfileNames($id)
    {
        return $this->makeRequest('GET',"client/{$id}/kycdetail");
    }

    public function getClientProfiles($id)
    {
        return $this->makeRequest('GET',"client/{$id}/kycinformation");
    }

    public function getClientGuardians($id)
    {
        return $this->makeRequest('GET',"client/{$id}/kycinformation/guardian");
    }

    public function getAddressType()
    {
        return $this->makeRequest('Get', "master/addresstype");
    }

    public function setClientKycInformation($id,$data)
    {
        return $this->makeRequest(
            'POST',
            "client/{$id}/kycinformation",
            [],
            $data,
            [],
            $hasFile = isset($data['pan_upload'])
                    || isset($data['kyc_upload'])
                    || isset($data['address_upload'])
                    || isset($data['bank1_upload'])
                    || isset($data['bank2_upload'])
                    || isset($data['bank3_upload'])
                    || isset($data['bank4_upload'])
                    || isset($data['bank5_upload'])
        );
    }
}
