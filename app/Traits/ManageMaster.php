<?php

namespace App\Traits;

trait ManageMaster
{

    /**
     *
     *
     */
    public function getProfessions()
    {
        return $this->makeRequest('Get', 'master/profession');
    }

    /**
     *
     *
     */
    public function getEntityTypes($type = 0)
    {
        return $this->makeRequest('Get', 'master/entitytype', ['type' => $type]);
    }

    /**
     *
     *
     */
    public function getCommercials()
    {
        return $this->makeRequest('Get', 'master/commercial');
    }

    /**
     *
     *
     */
    public function getCommercialTypes()
    {
        return $this->makeRequest('Get', 'master/commercialtype');
    }

    /**
     *
     *
     */
    public function getCountryList($id = '', $name = '')
    {
        return $this->makeRequest('Get', "master/countries",
                        ['id' => $id,'name' => $name],
                    );
    }

    /**
     *
     *
     */
    public function getCountrySingle($id)
    {
        return $this->makeRequest('Get', "master/countries/{$id}");
    }

    /**
     *
     *
     */
    public function getStateList($country_id,$data)
    {
        return $this->makeRequest('Get', "master/countries/{$country_id}/states",$data);
    }

    /**
     *
     *
     */
    public function getRelationList()
    {
        return $this->makeRequest('Get', "master/relations");
    }

    /**
     *
     *
     */
    public function getDepartmentList()
    {
        return $this->makeRequest('Get', "master/department");
    }

    public function getDepartment($id)
    {
        return $this->makeRequest('Get', "master/department/{$id}");
    }

    public function setSubDepartment($data)
    {
        return $this->makeRequest('POST',
            "master/department",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getSubDepartmentList($data)
    {
        return $this->makeRequest('Get', "master/department", $data);
    }

    /**
     *
     *
     */
    public function getDesignationList($id = '', $name = '')
    {
        return $this->makeRequest('Get', "master/designation",['id' => $id,'name' => $name],);
    }

    /**
     *
     *
     */
    public function setDesignation($data)
    {
        return $this->makeRequest('POST',
            "master/designation",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getSupervisiorList()
    {
        //return $this->makeRequest('Get', "");
    }

    /**
     *
     *
     */
    public function getTaxStatus($data)
    {
        return $this->makeRequest('Get', "master/taxstatus", $data);
    }

    /**
     *
     *
     */
    public function setTaxStatus($data)
    {
        return $this->makeRequest('POST',
            "master/taxstatus",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getTaxSlab($data)
    {
        return $this->makeRequest('Get', "master/taxslab", $data);
    }

    /**
     *
     *
     */
    public function setTaxSlab($data)
    {
        return $this->makeRequest('POST',
            "master/taxslab",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getWealthSource($id = '', $name = '')
    {
        return $this->makeRequest('Get',
                    "master/wealthsource",
                    ['id' => $id,'name' => $name],
                );
    }

    /**
     *
     *
     */
    public function setWealthSource($data)
    {
        return $this->makeRequest('POST',
            "master/wealthsource",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getCorpService()
    {
        return $this->makeRequest('Get', "master/corpservice");
    }

    /**
     *
     *
     */
    public function GetGrossAnnualIncome($id = '', $name = '')
    {
        return $this->makeRequest('Get',
            "master/grossannualincome",
            ['id' => $id,'name' => $name],
        );
    }

    /**
     *
     *
     */
    public function SetGrossAnnualIncome($data)
    {
        return $this->makeRequest('POST',
            "master/grossannualincome",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getOccupations($id = '', $name = '')
    {
        return $this->makeRequest('Get', "master/occupation", ['id' => $id,'name' => $name],);
    }


    /**
     *
     *
     */
    public function setOccupation($data)
    {
        return $this->makeRequest('POST',
            "master/occupation",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getKycStatus($id = '', $name = '')
    {
        return $this->makeRequest('Get',
                "master/kycstatus",
                ['id' => $id,'name' => $name],
            );
    }

    /**
     *
     *
     */
    public function setKycStatus($data)
    {
        return $this->makeRequest('POST',
            "master/kycstatus",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getBankMaster()
    {
        return $this->makeRequest('Get', "master/bankcode");
    }

    /**
     *
     *
     */
    public function uploadBankMaster($data)
    {
        //dd($data);
        return $this->makeRequest(
            'POST',
            "master/bankcode",
            [],
            $data,
            [],
            $hasFile = isset($data['bank_upload'])
        );
    }

    /**
     *
     *
     */
    public function getSchemeMaster()
    {
        return $this->makeRequest('Get', "master/masterscheme");
    }

    /**
     *
     *
     */
    public function uploadSchemeMaster($data)
    {
        //dd($data);
        return $this->makeRequest(
            'POST',
            "master/masterscheme",
            [],
            $data,
            [],
            $hasFile = isset($data['masterscheme_upload'])
        );
    }


    /**
     *
     *
     */
    public function getSipSchemeMaster()
    {
        return $this->makeRequest('Get', "master/mastersipscheme");
    }

    /**
     *
     *
     */
    public function uploadSipSchemeMaster($data)
    {
        //dd($data);
        return $this->makeRequest(
            'POST',
            "master/mastersipscheme",
            [],
            $data,
            [],
            $hasFile = isset($data['mastersipscheme_upload'])
        );
    }


    /**
     *
     *
     */
    public function getNavMaster()
    {
        return $this->makeRequest('Get', "master/masternav");
    }

    /**
     *
     *
     */
    public function uploadNavMaster($data)
    {
        //dd($data);
        return $this->makeRequest(
            'POST',
            "master/masternav",
            [],
            $data,
            [],
            $hasFile = isset($data['nav_upload'])
        );
    }


    /**
     *
     *
     */
    public function getAmfiMaster()
    {
        return $this->makeRequest('Get', "master/amfischemecode");
    }

    /**
     *
     *
     */
    public function uploadAmfiMaster($data)
    {
        //dd($data);
        return $this->makeRequest(
            'POST',
            "master/amfischemecode",
            [],
            $data,
            [],
            $hasFile = isset($data['amfischemecode_upload'])
        );
    }

    /**
     *
     *
     */
    public function getMasterAddressType($id = '', $name = '')
    {
        return $this->makeRequest('Get',
                    "master/addresstype",
                    ['id' => $id,'name' => $name],
                );
    }

    /**
     *
     *
     */
    public function setMasterAddressType($data)
    {
        return $this->makeRequest('POST',
            "master/addresstype",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getAccountType($id = '', $name = '')
    {
        return $this->makeRequest('Get',
                    "master/accounttype",
                    ['id' => $id,'name' => $name],
                );
    }

    /**
     *
     *
     */
    public function setAccountType($data)
    {
        return $this->makeRequest('POST',
            "master/accounttype",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getIncomeCategory($id = '', $name = '')
    {
        return $this->makeRequest('Get',
                    "master/incomecategory",
                    ['id' => $id,'name' => $name],
                );
    }

    /**
     *
     *
     */
    public function setIncomeCategory($data)
    {
        return $this->makeRequest('POST',
            "master/incomecategory",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getAMCCodes()
    {
        return $this->makeRequest('Get',"master/getamccode");
    }

    /**
     *
     *
     */
    public function getSchemeCodes($code,$type)
    {
        return $this->makeRequest('Get',"master/getschemename/{$code}/{$type}");
    }

    /**
     *
     *
     */
    public function getAllSchemeCodes($type)
    {
        return $this->makeRequest('Get',"master/getschemes/{$type}");
    }

    /**
     *
     *
     */
    public function getAllSchemeView($date)
    {
        return $this->makeRequest('Get',"master/masterportfolioview", ['selected_date' => $date]);
    }

    /**
     *
     *
     */
    public function getAllSchemeDateView()
    {
        return $this->makeRequest('Get',"master/masterportfolioview",['get_all_date' => 1]);
    }

    /**
     *
     *
     */
    public function storeNewPortfolio($data)
    {
        return $this->makeRequest(
            'Post',
            "master/masterportfolio",
            [],
            $data
        );
    }

    /**
     *
     *
     */
    public function getMasterLastUpdatedDate($code)
    {
        return $this->makeRequest('Get',"master/getlastupdatedate",['model' => $code]);
    }

    /**
     *
     *
     */
    public function getTransactionSchemeLogs()
    {
        return $this->makeRequest('Get',"master/transactionmaster");
    }
}
