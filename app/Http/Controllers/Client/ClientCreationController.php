<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientCreationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $client_id = $request->client_id;
            $profile_id = $request->profile_id;
            $profile = $this->marketService->getClientProfileDetail($client_id,$profile_id);
            $profile->net_worth_date = Carbon::parse($profile->net_worth_date)->format('d-m-Y');
            return response()->json($profile);
        }else{
            $title = base64_decode($request->title);
            $message = base64_decode($request->message);
            return view('client.message',[
                'title' => $title,
                'message' => $message,
            ]);
        }
        //dd('shashi');
        //return view('client.creation');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request->all());
        //return $data;
        $name = $request->account_count .' - ';
        $id = [];
        $nominee2_id = [];
        $nominee3_id = [];
        $client_id = $request->client_id;
        $client = $this->marketService->getClientDetail($request->client_id);
        $relations = $this->marketService->getRelationList();
        $accountContent = $this->addNewAccount($client, $relations);
        $first_holder = 'first_holder'.$request->account_count;
        $first_holder = $request->$first_holder;
        $second_holder = 'second_holder'.$request->account_count;
        $second_holder = $request->$second_holder;
        $third_holder = 'third_holder'.$request->account_count;
        $third_holder = $request->$third_holder;
        $account_type = 'client_account_type'.$request->account_count;
        $account_type = $request->$account_type;
        $has_nominee = 'has_nominee'.$request->account_count;
        $has_nominee = $request->$has_nominee;

        $nominee_id_1 = 'nominee_id_1'.$request->account_count;
        $nominee_id_1 = $request->$nominee_id_1;
        $nominee_id_2 = 'nominee_id_2'.$request->account_count;
        $nominee_id_2 = $request->$nominee_id_2;
        $nominee_id_3 = 'nominee_id_3'.$request->account_count;
        $nominee_id_3 = $request->$nominee_id_3;
        $nominee_guardian_1 = 'nominee_guardian_1'.$request->account_count;
        $nominee_guardian_1 = $request->$nominee_guardian_1;
        $nominee_guardian_2 = 'nominee_guardian_2'.$request->account_count;
        $nominee_guardian_2 = $request->$nominee_guardian_2;
        $nominee_guardian_3 = 'nominee_guardian_3'.$request->account_count;
        $nominee_guardian_3 = $request->$nominee_guardian_3;
        $nominee_relationship_1 = 'nominee_relationship_1'.$request->account_count;
        $nominee_relationship_1 = $request->$nominee_relationship_1;
        $nominee_relationship_2 = 'nominee_relationship_2'.$request->account_count;
        $nominee_relationship_2 = $request->$nominee_relationship_2;
        $nominee_relationship_3 = 'nominee_relationship_3'.$request->account_count;
        $nominee_relationship_3 = $request->$nominee_relationship_3;
        $nominee_applicable_1 = 'nominee_applicable_1'.$request->account_count;
        $nominee_applicable_1 = $request->$nominee_applicable_1;
        $nominee_applicable_2 = 'nominee_applicable_2'.$request->account_count;
        $nominee_applicable_2 = $request->$nominee_applicable_2;
        $nominee_applicable_3 = 'nominee_applicable_3'.$request->account_count;
        $nominee_applicable_3 = $request->$nominee_applicable_3;
        $default_bank = 'default_bank'.$request->account_count;
        $default_bank = $request->$default_bank;
        $other_bank = 'other_bank'.$request->account_count;
        $other_bank = $request->$other_bank;
        //dd($nominee_id_1,$nominee_id_2,$nominee_id_3);
        $profile = $this->marketService->getClientProfileDetail($client_id,$first_holder);
        $is_minor = $profile->client_guardian_id != null ? 1 : 0;
        //dd($is_minor);
        $name .= $profile->name;
        $id[] = $profile->id;
        $nominee2_id[] = $profile->id;
        $nominee3_id[] = $profile->id;
        //return $fff;
        $profile2 = '';
        $profile3 = '';
        $non_tax_status = ['NRI','On Behalf of Minor'];
        if(!empty($second_holder))
        {
            $name .= ' + ';
            $profile2 = $this->marketService->getClientProfileDetail($client_id,$second_holder);
            $name .= $profile2->name;
            $id[] = $profile2->id;
            $nominee2_id[] = $profile2->id;
            $nominee3_id[] = $profile2->id;
        }
        if(!empty($third_holder))
        {
            $name .= ' + ';
            $profile3 = $this->marketService->getClientProfileDetail($client_id,$third_holder);
            $name .= $profile3->name;
            $id[] = $profile3->id;
            $nominee2_id[] = $profile3->id;
            $nominee3_id[] = $profile3->id;
        }
        if(!empty($nominee_id_2) && $nominee_id_2 > 0)
        {
            $nominee2_id[] = $nominee_id_1;
            $nominee3_id[] = $nominee_id_1;
        }

        if(!empty($nominee_id_3) && $nominee_id_3 > 0)
        {
            $nominee3_id[] = $nominee_id_2;
        }
        //dd($nominee2_id);
       //dd($profile2);
        //dd($client);
        $content = '';
        $headContent = '';
        //<!--Begin :: New Account-->
        $content .= '<input type="hidden" class="account-accountid" name="account-accountid_'.$request->account_count.'" id="account-accountid_'.$request->account_count.'" value="0">';
        $content .= '<div class="tab-pane fade show" id="account'.$request->account_count.'" role="tabpanel" aria-labelledby="account-tab_'.$request->account_count.'">';
            $content .= '<div class="form-sections">';
                $content .= '<h4 class="form-section-title text-uppercase">Account Details</h4>';
                $content .= '<div class="row">';
                    $content .= '<div class="col-sm-4 account-first_holder_'.$request->account_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="account-first_holder_'.$request->account_count.'">First Holder</label>';
                            $content .= '<select class="form-control account-first_holder" id="account-first_holder_'.$request->account_count.'" name="account-first_holder_'.$request->account_count.'">';
                                $content .= '<option value="" disabled selected>Select First Holder</option>';
                                foreach ($client->client_profiles as $fprofile) {
                                    if($fprofile->account_type == 1 && $fprofile->is_account_profile == 1)
                                    {
                                        if($fprofile->id == $first_holder)

                                        $content .= '<option value="'.$fprofile->id.'" Selected>'.$fprofile->name.'</option>';
                                        else
                                        $content .= '<option value="'.$fprofile->id.'">'.$fprofile->name.'</option>';
                                    }else if($fprofile->account_type == 2 && $fprofile->is_account_profile == 1 && $fprofile->is_account_holder == false)
                                    {
                                        if($fprofile->id == $first_holder)
                                        $content .= '<option value="'.$fprofile->id.'" Selected>'.$fprofile->name.'</option>';
                                        else
                                        $content .= '<option value="'.$fprofile->id.'">'.$fprofile->name.'</option>';
                                    }
                                }
                            $content .= '</select><input type="hidden" class="form-control" id="account-first_holder_tax_status_'.$request->account_count.'" name="account-first_holder_tax_status_'.$request->account_count.'" placeholder="Enter First Holder Name" value="'.$profile->tax_status.'" />';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 account-second_holder_'.$request->account_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="account-second_holder_'.$request->account_count.'">Second Holder</label>';
                            if(!empty($profile2))
                            $content .= '<select class="form-control account-second_holder" id="account-second_holder_'.$request->account_count.'" name="account-second_holder_'.$request->account_count.'">';
                            else
                            $content .= '<select class="form-control account-second_holder" id="account-second_holder_'.$request->account_count.'" name="account-second_holder_'.$request->account_count.'" readonly>';
                                $content .= '<option value="" disabled selected>Select Second Holder</option>';

                                foreach ($client->client_profiles as $sprofile) {
                                    if($sprofile->account_type == 1 && $sprofile->is_account_profile == 1)
                                    {
                                        if($sprofile->id == $second_holder)
                                        $content .= '<option value="'.$sprofile->id.'" Selected>'.$sprofile->name.'</option>';
                                        else
                                        $content .= '<option value="'.$sprofile->id.'">'.$sprofile->name.'</option>';
                                    }
                                }
                            $content .= '</select>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 account-third_holder_'.$request->account_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="account-third_holder_'.$request->account_count.'">Third holder</label>';
                            if(!empty($profile3))
                            $content .= '<select class="form-control account-third_holder" id="account-third_holder_'.$request->account_count.'" name="account-third_holder_'.$request->account_count.'">';
                            else
                            $content .= '<select class="form-control account-third_holder" id="account-third_holder_'.$request->account_count.'" name="account-third_holder_'.$request->account_count.'" readonly>';
                                $content .= '<option value="" disabled selected>Select Third Holder</option>';
                                foreach ($client->client_profiles as $tprofile) {
                                    if($tprofile->account_type == 1 && $tprofile->is_account_profile == 1)
                                    {
                                        if($tprofile->id == $third_holder)
                                        $content .= '<option value="'.$tprofile->id.'" Selected>'.$tprofile->name.'</option>';
                                        else
                                        $content .= '<option value="'.$tprofile->id.'">'.$tprofile->name.'</option>';
                                    }
                                }
                            $content .= '</select>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 account-account_type_'.$request->account_count.'">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="account-account_type_'.$request->account_count.'"> Account type*</label>';
                            if(in_array($account_type, ['SINGLE','NON INDIVIDUAL']))
                            $content .= '<select class="form-control account-account_type" id="account-account_type_'.$request->account_count.'" name="account-account_type_'.$request->account_count.'" readonly>';
                            else
                            $content .= '<select class="form-control account-account_type" id="account-account_type_'.$request->account_count.'" name="account-account_type_'.$request->account_count.'">';
                                $content .= '<option value="" disabled selected>Select Account type</option>';
                                if($account_type == "SINGLE")
                                $content .= '<option value="SINGLE" Selected>SINGLE</option>';
                                else
                                $content .= '<option value="SINGLE">SINGLE</option>';

                                if($account_type == "JOINT")
                                $content .= '<option value="JOINT" Selected>JOINT</option>';
                                else
                                $content .= '<option value="JOINT">JOINT</option>';

                                if($account_type == "ANYONE OR SURVIVOR")
                                $content .= '<option value="ANYONE OR SURVIVOR" Selected>ANYONE OR SURVIVOR</option>';
                                else
                                $content .= '<option value="ANYONE OR SURVIVOR">ANYONE OR SURVIVOR</option>';

                                if($client->company_member_count > 0){
                                    if($account_type == "NON INDIVIDUAL")
                                    $content .= '<option value="NON INDIVIDUAL" Selected>NON INDIVIDUAL</option>';
                                    else
                                    $content .= '<option value="NON INDIVIDUAL">NON INDIVIDUAL</option>';
                                }
                            $content .= '</select>';
                        $content .= '</div>';
                    $content .= '</div>';
                    if($account_type == "NON INDIVIDUAL" || $is_minor == 1)
                    $content .= '<div class="col-sm-12 account-nominee_detail_'.$request->account_count.' nominee_hide">';
                    else
                    $content .= '<div class="col-sm-12 account-nominee_detail_'.$request->account_count.'">';
                        $content .= '<div class="form-group custom-checkbox account-has_nominee_'.$request->account_count.'">';
                            if($has_nominee == 1)
                            $content .= '<input type="checkbox" id="account-has_nominee_'.$request->account_count.'" name="account-has_nominee_'.$request->account_count.'" class="nominee-checkbox account-has_nominee" value="1" checked>';
                            else
                            $content .= '<input type="checkbox" id="account-has_nominee_'.$request->account_count.'" name="account-has_nominee_'.$request->account_count.'" class="nominee-checkbox account-has_nominee" value="0">';
                            $content .= '<label for="account-has_nominee_'.$request->account_count.'">Nominee?</label>';
                        $content .= '</div>';
                        if($has_nominee == 1)
                        $content .= '<div class="form-sections mt-5 mb-0">';
                        else
                        $content .= '<div class="form-sections mt-5 mb-0 nominee_reset">';
                            $content .= '<h4 class="form-section-title text-uppercase"> NOMINEE DETAILS</h4>';
                            if($nominee_id_1 != null)
                            {
                                if(!empty($nominee_id_1) || $nominee_id_1 == 0)
                                $content .= '<div class="row account-nominee_1_'.$request->account_count.' valid">';
                                else
                                $content .= '<div class="row account-nominee_1_'.$request->account_count.'">';
                                    $content .= '<div class="col-sm-3 account-nominee_id_1_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="account-nominee_id_1_'.$request->account_count.'">Nominee Name</label>';
                                            if(!empty($nominee_id_1) || $nominee_id_1 == 0)
                                            $content .= '<select id="account-nominee_id_1_'.$request->account_count.'" name="account-nominee_id_1_'.$request->account_count.'" class="form-control account-nominee_id_1">';
                                            else
                                            $content .= '<select id="account-nominee_id_1_'.$request->account_count.'" name="account-nominee_id_1_'.$request->account_count.'" class="form-control account-nominee_id_1" readonly>';
                                                $content .= '<option value="" disabled selected>Select Nominee</option>';
                                                foreach ($client->client_profiles as $nprofile)
                                                {
                                                    if($nprofile->account_type == 1)
                                                    {
                                                        if(!in_array($nprofile->id, $id))
                                                        {
                                                            if($nominee_id_1 == $nprofile->id)
                                                            $content .= '<option value="'.$nprofile->id.'" Selected>'.$nprofile->name.'</option>';
                                                            else
                                                            $content .= '<option value="'.$nprofile->id.'">'.$nprofile->name.'</option>';
                                                        }
                                                    }
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                    $content .= '<div class="col-sm-3 account-nominee_guardian_1_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="account-nominee_guardian_1_'.$request->account_count.'">Guardian Name</label>';
                                            if(!empty($nominee_guardian_1))
                                            $content .= '<select id="account-nominee_guardian_1_'.$request->account_count.'" name="account-nominee_guardian_1_'.$request->account_count.'" class="form-control account-nominee_guardian_1">';
                                            else
                                            $content .= '<select id="account-nominee_guardian_1_'.$request->account_count.'" name="account-nominee_guardian_1_'.$request->account_count.'" class="form-control account-nominee_guardian_1" readonly>';
                                                $content .= '<option value="" disabled selected>Select Nominee</option>';
                                                foreach ($client->client_profiles as $nprofile)
                                                {
                                                    if($nprofile->account_type == 1)
                                                    {
                                                        if(!in_array($nprofile->id, $id))
                                                        {
                                                            if($nominee_guardian_1 == $nprofile->id)
                                                            $content .= '<option value="'.$nprofile->id.'" Selected>'.$nprofile->name.'</option>';
                                                            else
                                                            $content .= '<option value="'.$nprofile->id.'">'.$nprofile->name.'</option>';
                                                        }
                                                    }
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                    $content .= '<div class="col-sm-3 account-nominee_relationship_1_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="account-nominee_relationship_1_'.$request->account_count.'">Relationship</label>';
                                            if(!empty($nominee_relationship_1))
                                            $content .= '<select class="form-control account-nominee_relationship_1" id="account-nominee_relationship_1_'.$request->account_count.'" name="account-nominee_relationship_1_'.$request->account_count.'">';
                                            else
                                            $content .= '<select class="form-control account-nominee_relationship" id="account-nominee_relationship_1_'.$request->account_count.'" name="account-nominee_relationship_1_'.$request->account_count.'" readonly>';
                                                $content .= '<option value="" disabled selected>Select Relationship</option>';
                                                foreach ($relations as $relationship)
                                                {
                                                    if($nominee_relationship_1 == $relationship->name)
                                                    $content .= '<option value="'.$relationship->name.'" Selected>'.$relationship->name.'</option>';
                                                    else
                                                    $content .= '<option value="'.$relationship->name.'">'.$relationship->name.'</option>';
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                    $content .= '<div class="col-sm-3 account-nominee_applicable_1_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="nominee_applicable_1_'.$request->account_count.'">Applicable</label>';
                                            if(!empty($nominee_applicable_1))
                                            $content .= '<select class="form-control account-nominee_applicable_1" id="account-nominee_applicable_1_'.$request->account_count.'" name="account-nominee_applicable_1_'.$request->account_count.'">';
                                            else
                                            $content .= '<select class="form-control account-nominee_applicable_1" id="account-nominee_applicable_1_'.$request->account_count.'" name="account-nominee_applicable_1_'.$request->account_count.'" readonly>';
                                                $content .= '<option value="" disabled selected> -%- </option>';

                                                for ($i=0; $i <= 100; $i++) {
                                                    if($nominee_applicable_1 == $i)
                                                    $content .= '<option value="'.$i.'" Selected >'.$i.'</option>';
                                                    else
                                                    $content .= '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                $content .= '</div>';
                            }
                            if($nominee_id_2 != null)
                            {
                                if(!empty($nominee_id_2) || $nominee_id_2 == 0)
                                $content .= '<div class="row account-nominee_2_'.$request->account_count.' valid">';
                                else
                                $content .= '<div class="row account-nominee_2_'.$request->account_count.'">';
                                    $content .= '<div class="col-sm-3 account-nominee_id_2_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="account-nominee_id_2_'.$request->account_count.'">Nominee Name</label>';
                                            if(!empty($nominee_id_2) || $nominee_id_2 == 0)
                                            $content .= '<select id="account-nominee_id_2_'.$request->account_count.'" name="account-nominee_id_2_'.$request->account_count.'" class="form-control account-nominee_id_2">';
                                            else
                                            $content .= '<select id="account-nominee_id_2_'.$request->account_count.'" name="account-nominee_id_2_'.$request->account_count.'" class="form-control account-nominee_id_2" readonly>';
                                                $content .= '<option value="" disabled selected>Select Nominee</option>';
                                                foreach ($client->client_profiles as $nprofile)
                                                {
                                                    if(!in_array($nprofile->id, $nominee2_id))
                                                    {
                                                        if($nominee_id_2 == $nprofile->id)
                                                        $content .= '<option value="'.$nprofile->id.'" Selected>'.$nprofile->name.'</option>';
                                                        else
                                                        $content .= '<option value="'.$nprofile->id.'">'.$nprofile->name.'</option>';
                                                    }
                                                }

                                                if(!empty($nominee_id_2) || $nominee_id_2 == 0)
                                                {
                                                    if($nominee_id_2 == 0)
                                                    $content .= '<option value="0" Selected>Other</option>';
                                                }
                                                else{
                                                $content .= '<option value="0">Other</option>';
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                    $content .= '<div class="col-sm-3 account-nominee_guardian_2_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="account-nominee_guardian_2_'.$request->account_count.'">Guardian Name</label>';
                                            if(!empty($nominee_guardian_2))
                                            $content .= '<select id="account-nominee_guardian_2_'.$request->account_count.'" name="account-nominee_guardian_2_'.$request->account_count.'" class="form-control account-nominee_guardian_2">';
                                            else
                                            $content .= '<select id="account-nominee_guardian_2_'.$request->account_count.'" name="account-nominee_guardian_2_'.$request->account_count.'" class="form-control account-nominee_guardian_2" readonly>';
                                                $content .= '<option value="" disabled selected>Select Nominee</option>';
                                                foreach ($client->client_profiles as $nprofile)
                                                {
                                                    if($nprofile->account_type == 1)
                                                    {
                                                        if(!in_array($nprofile->id, $id))
                                                        {
                                                            if($nominee_guardian_2 == $nprofile->id)
                                                            $content .= '<option value="'.$nprofile->id.'" Selected>'.$nprofile->name.'</option>';
                                                            else
                                                            $content .= '<option value="'.$nprofile->id.'">'.$nprofile->name.'</option>';
                                                        }
                                                    }
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                    $content .= '<div class="col-sm-3 account-nominee_relationship_2_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="account-nominee_relationship_2_'.$request->account_count.'">Relationship</label>';
                                            if(!empty($nominee_relationship_2))
                                            $content .= '<select class="form-control account-nominee_relationship_2" id="account-nominee_relationship_2_'.$request->account_count.'" name="account-nominee_relationship_2_'.$request->account_count.'">';
                                            else
                                            $content .= '<select class="form-control account-nominee_relationship" id="account-nominee_relationship_2_'.$request->account_count.'" name="account-nominee_relationship_2_'.$request->account_count.'" readonly>';
                                                $content .= '<option value="" disabled selected>Select Relationship</option>';
                                                foreach ($relations as $relationship)
                                                {
                                                    if($nominee_relationship_2 == $relationship->name)
                                                    $content .= '<option value="'.$relationship->name.'" Selected>'.$relationship->name.'</option>';
                                                    else
                                                    $content .= '<option value="'.$relationship->name.'">'.$relationship->name.'</option>';
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                    $content .= '<div class="col-sm-3 account-nominee_applicable_2_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="nominee_applicable_2_'.$request->account_count.'">Applicable</label>';
                                            if(!empty($nominee_applicable_2))
                                            $content .= '<select class="form-control account-nominee_applicable_2" id="account-nominee_applicable_2_'.$request->account_count.'" name="account-nominee_applicable_2_'.$request->account_count.'">';
                                            else
                                            $content .= '<select class="form-control account-nominee_applicable_2" id="account-nominee_applicable_2_'.$request->account_count.'" name="account-nominee_applicable_2_'.$request->account_count.'" readonly>';
                                                $content .= '<option value="" disabled selected> -%- </option>';

                                                for ($i=0; $i <= 100; $i++) {
                                                    if($nominee_applicable_2 == $i)
                                                    $content .= '<option value="'.$i.'" Selected >'.$i.'</option>';
                                                    else
                                                    $content .= '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                $content .= '</div>';
                            }
                            if($nominee_id_3 != null)
                            {
                                if(!empty($nominee_id_3) || $nominee_id_3 == 0)
                                $content .= '<div class="row account-nominee_3_'.$request->account_count.' valid">';
                                else
                                $content .= '<div class="row account-nominee_3_'.$request->account_count.'">';
                                    $content .= '<div class="col-sm-3 account-nominee_id_3_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="account-nominee_id_3_'.$request->account_count.'">Nominee Name</label>';
                                            if(!empty($nominee_id_3) || $nominee_id_3 == 0)
                                            $content .= '<select id="account-nominee_id_3_'.$request->account_count.'" name="account-nominee_id_3_'.$request->account_count.'" class="form-control account-nominee_id_3">';
                                            else
                                            $content .= '<select id="account-nominee_id_3_'.$request->account_count.'" name="account-nominee_id_3_'.$request->account_count.'" class="form-control account-nominee_id_3" readonly>';
                                                $content .= '<option value="" disabled selected>Select Nominee</option>';
                                                foreach ($client->client_profiles as $nprofile)
                                                {
                                                    if(!in_array($nprofile->id, $nominee2_id))
                                                    {
                                                        if($nominee_id_3 == $nprofile->id)
                                                        $content .= '<option value="'.$nprofile->id.'" Selected>'.$nprofile->name.'</option>';
                                                        else
                                                        $content .= '<option value="'.$nprofile->id.'">'.$nprofile->name.'</option>';
                                                    }
                                                }

                                                if(!empty($nominee_id_3) || $nominee_id_3 == 0)
                                                {
                                                    if($nominee_id_3 == 0)
                                                    $content .= '<option value="0" Selected>Other</option>';
                                                }
                                                else{
                                                $content .= '<option value="0">Other</option>';
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                    $content .= '<div class="col-sm-3 account-nominee_guardian_3_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="account-nominee_guardian_3_'.$request->account_count.'">Guardian Name</label>';
                                            if(!empty($nominee_guardian_3))
                                            $content .= '<select id="account-nominee_guardian_3_'.$request->account_count.'" name="account-nominee_guardian_3_'.$request->account_count.'" class="form-control account-nominee_guardian_3">';
                                            else
                                            $content .= '<select id="account-nominee_guardian_3_'.$request->account_count.'" name="account-nominee_guardian_3_'.$request->account_count.'" class="form-control account-nominee_guardian_3" readonly>';
                                                $content .= '<option value="" disabled selected>Select Nominee</option>';
                                                foreach ($client->client_profiles as $nprofile)
                                                {
                                                    if($nprofile->account_type == 1)
                                                    {
                                                        if(!in_array($nprofile->id, $id))
                                                        {
                                                            if($nominee_guardian_3 == $nprofile->id)
                                                            $content .= '<option value="'.$nprofile->id.'" Selected>'.$nprofile->name.'</option>';
                                                            else
                                                            $content .= '<option value="'.$nprofile->id.'">'.$nprofile->name.'</option>';
                                                        }
                                                    }
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                    $content .= '<div class="col-sm-3 account-nominee_relationship_3_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="account-nominee_relationship_3_'.$request->account_count.'">Relationship</label>';
                                            if(!empty($nominee_relationship_3))
                                            $content .= '<select class="form-control account-nominee_relationship_3" id="account-nominee_relationship_3_'.$request->account_count.'" name="account-nominee_relationship_3_'.$request->account_count.'">';
                                            else
                                            $content .= '<select class="form-control account-nominee_relationship" id="account-nominee_relationship_3_'.$request->account_count.'" name="account-nominee_relationship_3_'.$request->account_count.'" readonly>';
                                                $content .= '<option value="" disabled selected>Select Relationship</option>';
                                                foreach ($relations as $relationship)
                                                {
                                                    if($nominee_relationship_3 == $relationship->name)
                                                    $content .= '<option value="'.$relationship->name.'" Selected>'.$relationship->name.'</option>';
                                                    else
                                                    $content .= '<option value="'.$relationship->name.'">'.$relationship->name.'</option>';
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                    $content .= '<div class="col-sm-3 account-nominee_applicable_3_'.$request->account_count.'">';
                                        $content .= '<div class="form-group">';
                                            $content .= '<label for="nominee_applicable_3_'.$request->account_count.'">Applicable</label>';
                                            if(!empty($nominee_applicable_3))
                                            $content .= '<select class="form-control account-nominee_applicable_3" id="account-nominee_applicable_3_'.$request->account_count.'" name="account-nominee_applicable_3_'.$request->account_count.'">';
                                            else
                                            $content .= '<select class="form-control account-nominee_applicable_3" id="account-nominee_applicable_3_'.$request->account_count.'" name="account-nominee_applicable_3_'.$request->account_count.'" readonly>';
                                                $content .= '<option value="" disabled selected> -%- </option>';

                                                for ($i=0; $i <= 100; $i++) {
                                                    if($nominee_applicable_3 == $i)
                                                    $content .= '<option value="'.$i.'" Selected >'.$i.'</option>';
                                                    else
                                                    $content .= '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            $content .= '</select>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                $content .= '</div>';
                            }
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-12 account-bank_detail_'.$request->account_count.'">';
                        $content .= '<div class="form-sections">';
                            $content .= '<h4 class="form-section-title text-uppercase">Bank Details</h4>';
                            $content .= '<div class="row">';
                                $content .= '<div class="col-sm-4 account-default_bank_'.$request->account_count.'">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="account-default_bank_'.$request->account_count.'"> Default Bank</label>';
                                        if(!empty($default_bank))
                                        $content .= '<select id="account-default_bank_'.$request->account_count.'" name="account-default_bank_'.$request->account_count.'" class="form-control account-default_bank">';
                                        else
                                        $content .= '<select id="account-default_bank_'.$request->account_count.'" name="account-default_bank_'.$request->account_count.'" class="form-control account-default_bank" readonly>';
                                            $content .= '<option value="" disabled selected>Select Default Bank</option>';
                                            //dd($profile);
                                            foreach($profile->banks as $bank)
                                            {
                                                $bank_atype = $bank->account_type;
                                                $bank_account_type = '';
                                                switch ($bank_atype) {
                                                    case "Saving":
                                                        $bank_account_type = 'SB';
                                                        break;
                                                    case "Non-resident external":
                                                        $bank_account_type = 'NRE';
                                                        break;
                                                    case "Non-resident ordinary":
                                                        $bank_account_type = 'NRO';
                                                        break;
                                                    case "Current":
                                                        $bank_account_type = 'CB';
                                                        break;
                                                    default:
                                                        $bank_account_type = $bank_atype;
                                                    }

                                                if($bank->id == $default_bank)
                                                $content .= '<option value="'.$bank->id.'" selected>'.$bank->bank_name.' - '.$bank_account_type.'</option>';
                                                else
                                                $content .= '<option value="'.$bank->id.'">'.$bank->bank_name.' - '.$bank_account_type.'</option>';
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-4 account-other_bank_'.$request->account_count.'" id="account-other_bank_detail_'.$request->account_count.'">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="account-other_bank_'.$request->account_count.'">Other Bank</label>';
                                        $content .= '<div class="dropdown customMulti">';
                                            $content .= '<a class="dropdown-toggle select-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                                $content .= '<span class="text-grey">Select Other bank</span>';
                                            $content .= '</a>';
                                            $content .= '<div id="account-other_bank_'.$request->account_count.'" class="dropdown-menu dropdown-menu-left select-dropdown-list" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-start">';
                                                $content .= '<div class="data-list">';
                                                foreach($profile->banks as $bank)
                                                {
                                                    $bank_atype = $bank->account_type;
                                                    $bank_account_type = '';
                                                    switch ($bank_atype) {
                                                        case "Saving":
                                                            $bank_account_type = 'SB';
                                                            break;
                                                        case "Non-resident external":
                                                            $bank_account_type = 'NRE';
                                                            break;
                                                        case "Non-resident ordinary":
                                                            $bank_account_type = 'NRO';
                                                            break;
                                                        case "Current":
                                                            $bank_account_type = 'CB';
                                                            break;
                                                        default:
                                                            $bank_account_type = $bank_atype;
                                                        }
                                                        //dd($profile);
                                                    if($bank->id == $default_bank || in_array($profile->tax_status, $non_tax_status))
                                                    $content .= '<a class="dropdown-item d-none">';
                                                    else
                                                    $content .= '<a class="dropdown-item">';
                                                        $content .= '<div class="form-group custom-checkbox m-0">';
                                                            if(in_array($bank->id, $other_bank))
                                                            $content .= '<input type="checkbox" name="account-other_bank_'.$request->account_count.'[]" id="account-other_bank_'.$request->account_count.'_'.$bank->id.'" value="'.$bank->id.'" checked>';
                                                            else
                                                            $content .= '<input type="checkbox" name="account-other_bank_'.$request->account_count.'[]" id="account-other_bank_'.$request->account_count.'_'.$bank->id.'" value="'.$bank->id.'">';
                                                            $content .= '<label for="account-other_bank_'.$request->account_count.'_'.$bank->id.'">'.$bank->bank_name.'</label>';
                                                        $content .= '</div>';
                                                    $content .= '</a>';
                                                }
                                                    $content .= '<a class="dropdown-item">';
                                                        $content .= '<div class="form-group custom-checkbox m-0">';
                                                            if(in_array(0, $other_bank))
                                                            $content .= '<input type="checkbox" name="account-other_bank_'.$request->account_count.'[]" id="account-other_bank_'.$request->account_count.'_0" value="0" checked>';
                                                            else
                                                            $content .= '<input type="checkbox" name="account-other_bank_'.$request->account_count.'[]" id="account-other_bank_'.$request->account_count.'_0" value="0">';
                                                            $content .= '<label for="account-other_bank_'.$request->account_count.'_0">NA</label>';
                                                        $content .= '</div>';
                                                    $content .= '</a>';

                                                $content .= '</div>';
                                            $content .= '</div>';
                                        $content .= '</div>';
                                        //if(!empty($other_bank) || $other_bank == 0)
                                        //$content .= '<select id="account-other_bank_'.$request->account_count.'" class="form-control account-other_bank" name="account-other_bank_'.$request->account_count.'">';
                                        //else
                                        //$content .= '<select id="account-other_bank_'.$request->account_count.'" class="form-control account-other_bank" name="account-other_bank_'.$request->account_count.'" readonly>';
                                            //$content .= '<option value="" disabled selected>Select Other Bank</option>';
                                            // foreach($profile->banks as $bank)
                                            // {
                                            //     //if($bank->id != $default_bank)
                                            //     //{
                                            //         if($bank->id == $other_bank)
                                            //         $content .= '<option value="'.$bank->id.'" selected>'.$bank->bank_name.'</option>';
                                            //         else
                                            //         $content .= '<option value="'.$bank->id.'">'.$bank->bank_name.'</option>';
                                            //     //}
                                            // }
                                            // if($other_bank == 0)
                                            // $content .= '<option value="0" selected>NA</option>';
                                            // else
                                            // $content .= '<option value="0">NA</option>';
                                        //$content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                            $content .= '</div>';
                        $content .= '</div>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';
        $content .= '</div>';
        //<!--End :: New Account-->
        $headContent .= '<li class="nav-item mb-3" role="presentation" data-count="' . $request->account_count . '">';
            $headContent .= '<a class="nav-link account_tab"  id="account-tab_' . $request->account_count . '"';
            $headContent .= 'data-toggle="tab"  href="#account' . $request->account_count . '" role="tab"';
            $headContent .= 'aria-selected="false">' . $name . '</a>';
        $headContent .= '<span class="remove-account"><i class="icon-close"></i></span></li>';
        $data = [
            $content,$headContent,$accountContent
        ];

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->is_verify);
        $data = $request->all();
        //return response()->json($data);
        // dd($data);
        $client = $this->marketService->setClientDetails($data);
        dd($client);

        $accounts = $client->client_accounts;

        $is_verify_one = [];
        $is_verify_two = [];
        foreach($accounts as $account)
        {
            $is_verify_one[] = $account->is_verified;
            $is_verify_two[] = $account->is_verified_two;
        }
        //dd($is_verify_one);
        $status = 1;
        $client_id = $account->client_id;
        $title = 'Hooray';
        $message = '';
        if(in_array(0, $is_verify_one))
        {
            if($request->is_verify == 0)
            {
                $status = 2;
                $message = 'New Client has been created and send for Admin verification.';
            }
            if($request->is_verify == 1 && $request->is_reject == 0){
                $status = 3;
                $title = 'Hooray';
                $message = 'Request has been send to client for verification.';
            }
            if($request->is_verify == 1 && $request->is_reject == 1){
                $status = 4;
                $title = 'Weldone';
                $message = 'Request has been send for reverification.';
            }
            if($request->is_verify == 2){
                $status = 5;
                $title = 'Hooray';
                $message = 'Request has been send for Admin verification.';
            }
            $title = base64_encode($title);
            $message = base64_encode($message);
        }
        $data  = [
            'status'=>$status,
            'client_id'=>$client_id,
            'title'=>$title,
            'message'=>$message
        ];
        //dd($data);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $client = $this->marketService->getClientDetail($id);
        $relations = $this->marketService->getRelationList();
        $new_account = $this->addNewAccount($client, $relations);
        //dd($client);
        return view('client.creation')
        ->with([
            'client_id' => $id,
            'client' => $client,
            'relations' => $relations,
            'new_account' => $new_account,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = $this->marketService->getClientDetail($id);
        $relations = $this->marketService->getRelationList();
        $clientdata = $this->addNewAccount($client, $relations);

        return response()->json($clientdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addNewAccount($client,$relations)
    {
        $content = '';
        $active = '';

        if(isset($client->accountsdata) && empty($client->accountsdata)){$active = 'active';}
        $content .= '<div class="tab-pane fade show '.$active.'" id="add-account" role="tabpanel" aria-labelledby="add-tab">';
            $content .= '<div class="form-sections">';
                $content .= '<h4 class="form-section-title text-uppercase">Account Details</h4>';
                $content .= '<div class="addAccountTab row">';

                    $content .= '<div class="col-sm-4 first_holder">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="first_holder">First Holder</label>';
                            $content .= '<select class="form-control" id="first_holder" name="first_holder">';
                                $content .= '<option value="" disabled selected>Select First Holder</option>';
                                foreach($client->client_profiles as $profile)
                                {
                                    if($profile->account_type == 1 && $profile->is_account_profile == 1)
                                    {
                                        $content .= '<option value="'.$profile->id.'">'.$profile->name.'</option>';
                                    }elseif($profile->account_type == 2 && $profile->is_account_profile == 1 && $profile->is_account_holder == false)
                                    {
                                        $content .= '<option value="'.$profile->id.'">'.$profile->name.'</option>';
                                    }
                                }
                            $content .= '</select>';
                            $content .= '<input type="hidden" class="form-control" id="first_holder_account_type" name="first_holder_account_type" placeholder="Enter First Holder Name" value="" />';
                        $content .= '</div>';
                    $content .= '</div>';

                    $content .= '<div class="col-sm-4 second_holder">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="second_holder">Second Holder</label>';
                            $content .= '<select class="form-control" id="second_holder" name="second_holder" readonly>';
                                $content .= '<option value="" disabled selected>Select Second Holder</option>';
                                foreach($client->client_profiles as $profile)
                                {
                                    if($profile->account_type == 1 && $profile->is_account_profile == 1 && $profile->age >= 18)
                                    {
                                        $content .= '<option value="'.$profile->id.'">'.$profile->name.'</option>';
                                    }
                                }
                            $content .= '</select>';
                            //$content .= '{{-- <input type="text" class="form-control" id="second_holder" name="second_holder" placeholder="Enter Second Holder Name" /> --}}';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 third_holder">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="third_holder">Third holder</label>';

                            $content .= '<select class="form-control" id="third_holder" name="third_holder" readonly>';
                                $content .= '<option value="" disabled selected>Select Third Holder</option>';
                                foreach($client->client_profiles as $profile)
                                {
                                    if($profile->account_type == 1 && $profile->is_account_profile == 1 && $profile->client_guardian_id == null && $profile->age >= 18)
                                    {
                                        $content .= '<option value="'.$profile->id.'">'.$profile->name.'</option>';
                                    }
                                }
                            $content .= '</select>';
                            //$content .= '{{-- <input type="text" class="form-control" id="third_holder" name="third_holder" placeholder="Enter Third holder Name" /> --}}';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-4 client_account_type">';
                        $content .= '<div class="form-group">';
                            $content .= '<label for="client_account_type"> Account type*</label>';
                            $content .= '<select class="form-control" id="client_account_type" name="client_account_type">';
                                $content .= '<option value="" disabled selected>Select Account type</option>';
                                $content .= '<option value="SINGLE">SINGLE</option>';
                                $content .= '<option value="JOINT">JOINT</option>';
                                $content .= '<option value="ANYONE OR SURVIVOR">ANYONE OR SURVIVOR</option>';
                                if($client->company_member_count > 0)
                                {
                                    $content .= '<option value="NON INDIVIDUAL">NON INDIVIDUAL</option>';
                                }
                            $content .= '</select>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-12 nominee_detail">';
                        $content .= '<div class="form-group custom-checkbox has_nominee" readonly>';
                            $content .= '<input type="checkbox" id="has_nominee" name="has_nominee" class="nominee-checkbox" value="0" readonly>';
                            $content .= '<label for="has_nominee">Nominee?</label>';
                        $content .= '</div>';
                        $content .= '<div class="form-sections mt-5 mb-0 nominee_set">';
                            $content .= '<h4 class="form-section-title text-uppercase"> NOMINEE DETAILS (Max 3)</h4>';
                            $content .= '<div class="row nominee_1">';
                                $content .= '<div class="col-sm-3 nominee_id_1">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_id_1">Nominee Name</label>';
                                        $content .= '<select id="nominee_id_1" name="nominee_id_1" class="form-control" readonly>';
                                            $content .= '<option value="" disabled selected>Select Nominee</option>';
                                            foreach($client->client_profiles as $profile)
                                            {
                                                if($profile->account_type == 1)
                                                {
                                                    $content .= '<option data-age="'.$profile->age.'" value="'.$profile->id.'">'.$profile->name.'</option>';
                                                }
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-3 nominee_guardian_1">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_guardian_1">Guardian Name</label>';
                                        $content .= '<select id="nominee_guardian_1" name="nominee_guardian_1" class="form-control" readonly>';
                                            $content .= '<option value="" disabled selected>Select Guardian</option>';
                                            foreach($client->client_profiles as $profile)
                                            {
                                                if($profile->account_type == 1 && $profile->age > 18)
                                                {
                                                    $content .= '<option value="'.$profile->id.'">'.$profile->name.'</option>';
                                                }
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-3 nominee_relationship_1">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_relationship_1">Relationship</label>';
                                        $content .= '<select class="form-control" id="nominee_relationship_1" name="nominee_relationship_1" readonly>';
                                            $content .= '<option value="" disabled selected>Select Relationship</option>';
                                            foreach($relations as $relationship)
                                            {
                                                $content .= '<option value="'.$relationship->name.'">'.$relationship->name.'</option>';
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-3 nominee_applicable_1">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_applicable_1">Applicable</label>';
                                        $content .= '<select class="form-control" id="nominee_applicable_1" name="nominee_applicable_1" readonly>';
                                            $content .= '<option value="" disabled selected> -%- </option>';
                                            for ($i=0; $i <= 100; $i++) {
                                                if($i < 10)
                                                $content .= '<option value="'.$i.'">0'.$i.'</option>';
                                                else
                                                $content .= '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                            $content .= '</div>';
                            $content .= '<div class="row nominee_2">';
                                $content .= '<div class="col-sm-3 nominee_id_2">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_id_2">Nominee Name</label>';
                                        $content .= '<select id="nominee_id_2" name="nominee_id_2" class="form-control" readonly>';
                                            $content .= '<option value="" disabled selected>Select Nominee</option>';
                                            foreach($client->client_profiles as $profile)
                                            {
                                                if($profile->account_type == 1)
                                                {
                                                    $content .= '<option data-age="'.$profile->age.'" value="'.$profile->id.'">'.$profile->name.'</option>';
                                                }
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-3 nominee_guardian_2">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_guardian_2">Guardian Name</label>';
                                        $content .= '<select id="nominee_guardian_2" name="nominee_guardian_2" class="form-control" readonly>';
                                            $content .= '<option value="" disabled selected>Select Guardian</option>';
                                            foreach($client->client_profiles as $profile)
                                            {
                                                if($profile->account_type == 1 && $profile->age > 18)
                                                {
                                                    $content .= '<option value="'.$profile->id.'">'.$profile->name.'</option>';
                                                }
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-3 nominee_relationship_2">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_relationship_2">Relationship</label>';
                                        $content .= '<select class="form-control" id="nominee_relationship_2" name="nominee_relationship_2" readonly>';
                                            $content .= '<option value="" disabled selected>Select Relationship</option>';
                                            foreach($relations as $relationship)
                                            {
                                                $content .= '<option value="'.$relationship->name.'">'.$relationship->name.'</option>';
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-3 nominee_applicable_2">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_applicable_2">Applicable</label>';
                                        $content .= '<select class="form-control" id="nominee_applicable_2" name="nominee_applicable_2" readonly>';
                                            $content .= '<option value="" disabled selected> -%- </option>';
                                            for ($i=0; $i <= 100; $i++) {
                                                if($i < 10)
                                                $content .= '<option value="'.$i.'">0'.$i.'</option>';
                                                else
                                                $content .= '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                            $content .= '</div>';
                            $content .= '<div class="row nominee_3">';
                                $content .= '<div class="col-sm-3 nominee_id_3">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_id_3">Nominee Name</label>';
                                        $content .= '<select id="nominee_id_3" name="nominee_id_3" class="form-control" readonly>';
                                            $content .= '<option value="" disabled selected>Select Nominee</option>';
                                            foreach($client->client_profiles as $profile)
                                            {
                                                if($profile->account_type == 1)
                                                {
                                                    $content .= '<option data-age="'.$profile->age.'" value="'.$profile->id.'">'.$profile->name.'</option>';
                                                }
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-3 nominee_guardian_3">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_guardian_3">Guardian Name</label>';
                                        $content .= '<select id="nominee_guardian_3" name="nominee_guardian_3" class="form-control" readonly>';
                                            $content .= '<option value="" disabled selected>Select Guardian</option>';
                                            foreach($client->client_profiles as $profile)
                                            {
                                                if($profile->account_type == 1 && $profile->age > 18)
                                                {
                                                    $content .= '<option value="'.$profile->id.'">'.$profile->name.'</option>';
                                                }
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-3 nominee_relationship_3">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_relationship_3">Relationship</label>';
                                        $content .= '<select class="form-control" id="nominee_relationship_3" name="nominee_relationship_3" readonly>';
                                            $content .= '<option value="" disabled selected>Select Relationship</option>';
                                            foreach($relations as $relationship)
                                            {
                                                $content .= '<option value="'.$relationship->name.'">'.$relationship->name.'</option>';
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-3 nominee_applicable_3">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="nominee_applicable_3">Applicable</label>';
                                        $content .= '<select class="form-control" id="nominee_applicable_3" name="nominee_applicable_3" readonly>';
                                            $content .= '<option value="" disabled selected> -%- </option>';
                                            for ($i=0; $i <= 100; $i++) {
                                                if($i < 10)
                                                $content .= '<option value="'.$i.'">0'.$i.'</option>';
                                                else
                                                $content .= '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                            $content .= '</div>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<div class="col-sm-12 bank_detail">';
                        $content .= '<div class="form-sections">';
                            $content .= '<h4 class="form-section-title text-uppercase">Bank Details</h4>';
                            $content .= '<div class="row">';
                                $content .= '<div class="col-sm-4 default_bank">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="default_bank"> Default Bank</label>';
                                        $content .= '<select id="default_bank" name="default_bank" class="form-control" readonly>';
                                            $content .= '<option value="" disabled selected>Select Default Bank</option>';

                                        $content .= '</select>';
                                    $content .= '</div>';
                                $content .= '</div>';
                                $content .= '<div class="col-sm-4 other_bank" id="other_bank_detail">';
                                    $content .= '<div class="form-group">';
                                        $content .= '<label for="other_bank">Other Bank</label>';
                                        $content .= '<div class="dropdown customMulti" readonly>';
                                            $content .= '<a class="dropdown-toggle select-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true"';
                                                $content .= 'aria-expanded="false"><span class="text-grey">Select Other bank</span></a>';
                                            $content .= '<div id="other_bank" class="dropdown-menu dropdown-menu-left select-dropdown-list">';

                                            $content .= '</div>';
                                        $content .= '</div>';
                                    $content .= '</div>';
                                $content .= '</div>';
                            $content .= '</div>';
                        $content .= '</div>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';
        $content .= '</div>';

        return $content;
    }
}
