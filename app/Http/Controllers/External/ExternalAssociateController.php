<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use App\Services\MyServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExternalAssociateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = MyServices::getdecryptNo($request->id);
        $data = $this->marketService->getExternalAssociate($id);
        return view('external.terms');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'user_agree' => 'required_if:userstatus,0',
            'reject_reason' => 'required_if:userstatus,1',
        ], [
            'user_agree.required_if' => 'Please accept terms and conditions',
            'reject_reason.required_if' => 'Please provide some input',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'success' => 'false',
                'errors'  => $v->getMessageBag()->toArray(),
            ], 400);
        }
        $data = $request->all();

        $associate = $this->marketService->updateExternalAssociateStatus($data);
        return response()->json($associate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = MyServices::getdecryptNo($id);
        $data = $this->marketService->getExternalAssociate($id);
        //dd($data);
        $commercials = $data->commercials;
        $commercialtypes = $data->commercialtypes;
        //dd($data);
        return view('external.associate')->with([
            'data' => $data,
            'commercials' => $commercials,
            'commercialtypes' => $commercialtypes,
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
        //$data[] = '';
        $data['associate_id']  = MyServices::getdecryptNo($id);
        $data['approved'] = '1';
        $data['accepted'] = '0';
        $associate = $this->marketService->getExternalAssociateApproved($data);
        //dd($associate);
        return view('external.terms')->with(
            ['id' => $id]
        );
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
        $v = Validator::make($request->all(), [
            'user_agree' => 'accepted',
        ], [
            'user_agree.accepted' => 'Please Accept Aggrement policies',
        ]);

        if ($v->fails())
        {
            return redirect()->back()
                        ->withErrors($v)
                        ->withInput();
        }
        $id = MyServices::getdecryptNo($id);

        $data['associate_id']  = $id;
        $data['approved'] = '1';
        $data['accepted'] = '1';

        $associate = $this->marketService->getExternalAssociateAccepted($data);
        //dd($associate);
        return view('external.success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejected($id)
    {
        $id = MyServices::getdecryptNo($id);
        $data = $this->marketService->getExternalAssociate($id);
        return view('external.rejected');
    }
}
