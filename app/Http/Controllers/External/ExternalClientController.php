<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use App\Services\MarketService;
use App\Services\MyServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExternalClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarketService $marketService)
    {
        //$this->middleware('client.credentials');

        parent::__construct($marketService);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($client_id, $profile_id)
    {
        $data = $this->marketService->getExternalClientAccountDetail($client_id,$profile_id);
        //dd($data);
        return view('external.client.accounts')->with([
            'client' => $data,
            'client_id' => $client_id,
            'profile_id' => $profile_id,
        ]);
    }

    public function postVerify(Request $request)
    {
        $status = $request->userstatus;
        $data = $request->all();
        $data['status'] = $status;
        //return response()->json($data);
        $v = Validator::make($request->all(), [
            //'user_agree' => 'required_if:userstatus,0',
            'verification_remarks' => 'required_if:userstatus,1',
        ], [
            //'user_agree.required_if' => 'Please accept terms and conditions',
            'verification_remarks.required_if' => 'Please provide some input',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'success' => 'false',
                'errors'  => $v->getMessageBag()->toArray(),
            ], 400);
        }

        $data = $request->all();

        $data = $this->marketService->setExternalClientAccountDetail($data,$request->client_id,$request->profile_id);
        //dd($data);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejected($client_id,$profile_id)
    {
        return view('external.client.rejected');
    }

    public function approved($client_id,$profile_id)
    {
        return view('external.client.approved');
    }

}
