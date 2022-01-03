<?php

namespace App\Services;


class MarketService extends Services
{
    /**
     *  The URL to send a request
     *  @var string
     */
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.market.base_uri');
    }

    /**
     *  Retrive the User information from the API
     *
     *  @return StdClass
     */
    public function getUserInformation()
    {
        return $this->makeRequest('GET', 'user');
    }

    /**
     *  Logout the user from the API
     *
     *  $return void
     */
    public function userLogout()
    {
        return $this->makeRequest('GET', 'user/logout');
    }

    /**
     *
     *
     */
    public function checkUsername($username)
    {
        return $this->makeRequest('GET', 'user/checkusername', ['username' => $username]);
    }

    /**
     * Check User Mobile no Exist or Not
     *
     */
    public function checkUserMobile($mobile, $pan_no = '',$aid = '', $eid = '')
    {
        return $this->makeRequest('GET', 'user/checkauthusermobile', ['mobile' => $mobile, 'pan_no' => $pan_no ,'associate_id' => $aid, 'employee_id' => $eid]);
    }

    public function checkLeadMobile($mobile,$id = '')
    {
        return $this->makeRequest('GET', "lead/{$id}",['mobile' => $mobile]);
    }

    /**
     * Check User Email Exist or Not
     *
     */
    public function checkUserEmail($email, $pan_no = '',$aid = '', $eid = '')
    {
        return $this->makeRequest('GET', 'user/checkauthuseremail', ['email' => $email, 'pan_no' => $pan_no ,'associate_id' => $aid, 'employee_id' => $eid]);
    }

    public function checkLeadEmail($email,$id = '')
    {
        return $this->makeRequest('GET', "lead/{$id}",['email' => $email]);
    }

    /**
     * Check User Email Exist or Not
     *
     */
    public function checkUserPanNo($pan_no , $aid = '', $eid = '')
    {
        return $this->makeRequest('GET', 'user/checkauthuserpanno', ['pan_no' => $pan_no ,'associate_id' => $aid, 'employee_id' => $eid]);
    }



    /**
     *
     *
     */
    //user/password-pin/create //Post
    public function forgotPassword($data)
    {
        return $this->makeRequest('POST', 'user/password-pin/create', [], $data);
    }

    /**
     *
     *
     */
    //user/password-pin/find/{token} //Get
    public function CheckPasswordToken($token)
    {
        return $this->makeRequest('GET', "user/password-pin/find/{$token}");
    }

    /**
     *
     *
     */
    //user/password-pin/reset //post
    public function resetPassword($data)
    {
        return $this->makeRequest('POST', 'user/password-pin/reset', [], $data);
    }

    public function resetPasswordFirst($data)
    {
        return $this->makeRequest('POST', 'user/password-pin/reset/first', [], $data);
    }

}
