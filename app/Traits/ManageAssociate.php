<?php

namespace App\Traits;

//use PhpParser\Node\Expr\FuncCall;

trait ManageAssociate
{
    /**
     *  Obtian the list of Associate
     *  @return stdClass
     */
    public function getAssoicates($active = 0)
    {
        return $this->makeRequest('Get', 'associate', ['active' => $active]);
    }

    public function getEmployees($data = '')
    {
        //dd($data);
        return $this->makeRequest('Get', 'employee', $data);
    }

    public function getSingleEmployee($id)
    {
        return $this->makeRequest('Get', "employee/{$id}");
    }

    public function getUserAssociate($id)
    {
        return $this->makeRequest('Get', "user/{$id}/associate");
    }

    /**
     *
     */
    public function getSingleAssociate($id)
    {
        return $this->makeRequest('Get', "associate/{$id}");
    }

    public function getAssoicateById($id)
    {
        return $this->makeRequest('Get', "associate/{$id}/user");
    }

    /**
     *
     *
     */
    public function getAssoicateEmployees($id)
    {
        return $this->makeRequest('Get', "associate/{$id}/employee");
    }

    /**
     *  Get Employee Supervisior Id
     *
     */
    public function getEmployeeSupervisior($id, $designation_id)
    {
        return $this->makeRequest('Get', "associate/{$id}/employee/create", ['designation_id' => $designation_id]);
    }

    /**
     *
     *
     */
    public function getAssoicateAddress($id)
    {
        return $this->makeRequest('Get', "associate/{$id}/address");
    }

    /**
     *  Set Associate
     */
    public function setAssoicates($data)
    {
        return $this->makeRequest(
			'POST',
			"associate",
			[],
			$data,
			[],
            $hasFile = isset($data['photo_upload'])
                    || isset($data['pan_upload'])
                    || isset($data['aadhar_upload'])
                    || isset($data['address_upload'])
                    || isset($data['cheque_upload'])
                    || isset($data['mfd_ria_cheque_upload'])
                    || isset($data['gst_upload'])
                    || isset($data['shop_est_upload'])
                    || isset($data['pd_upload'])
                    || isset($data['pd_asl_upload'])
                    || isset($data['pd_coi_upload'])
                    || isset($data['co_moa_upload'])
                    || isset($data['co_aoa_upload'])
                    || isset($data['co_coi_upload'])
                    || isset($data['co_asl_upload'])
                    || isset($data['co_br_upload'])
                    || isset($data['logo_upload'])
                    || isset($data['arn_upload'])
                    || isset($data['euin_upload'])
                    || isset($data['ria_upload'])
                    || isset($data['nism_va_upload'])
                    || isset($data['nism_xa_upload'])
                    || isset($data['nism_xb_upload'])
                    || isset($data['cfp_upload'])
                    || isset($data['cwm_upload'])
                    || isset($data['ca_upload'])
                    || isset($data['cs_upload'])
                    || isset($data['course_upload'])
                    || isset($data['guardian_pan_upload'])

		);
    }

    /**
     * Set Employee
     */
    public function setEmployees($data, $id)
    {
        return $this->makeRequest(
			'POST',
			"associate/{$id}/employee",
			[],
			$data,
			[],
			$hasFile =  isset($data['photo_upload'])
                        || isset($data['pan_upload'])
                        || isset($data['aadhar_upload'])
                        || isset($data['c_address_upload'])
                        || isset($data['p_address_upload'])
                        || isset($data['cheque_upload'])
                        || isset($data['euin_upload'])
                        || isset($data['nism_va_upload'])
                        || isset($data['nism_xa_upload'])
                        || isset($data['nism_xb_upload'])
                        || isset($data['cfp_upload'])
                        || isset($data['cwm_upload'])
                        || isset($data['ca_upload'])
                        || isset($data['cs_upload'])
                        || isset($data['course_upload'])
		);
    }

    public function getEmployee($aid, $eid)
    {
        return $this->makeRequest('Get', "associate/{$aid}/employee/{$eid}");
    }

    public function getDownloadAssociate($id)
    {
        return $this->makeRequest('Get', "associate/download/{$id}");
    }
    public function getDownloadEmployee($id)
    {
        return $this->makeRequest('Get', "employee/download/{$id}");
    }

    public function getLogsAssociate($id)
    {
        return $this->makeRequest('Get', "associate/logs/{$id}");
    }

    public function getLogsEmployee($id)
    {
        return $this->makeRequest('Get', "employee/logs/{$id}");
    }

}
