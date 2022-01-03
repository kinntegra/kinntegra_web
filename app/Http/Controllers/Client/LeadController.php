<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\LeadRequest;
use App\Services\MarketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active = 1;
        $associates = $this->marketService->getAssoicates($active);
        $data = [];
        $user_associate = '';
        $employees = '';
        if(Auth::user()->hasRole('admin'))
        {
            $user_associate = $this->marketService->getUserAssociate(Auth::user()->service_id);
        }
        if(Auth::user()->hasRole('employee'))
        {
            $employee = $this->marketService->getSingleEmployee(Auth::user()->service_id);
            $user_associate = $this->marketService->getUserAssociate($employee->associate_id);
        }
        if($user_associate)
        {
            $data['associate_id'] = $user_associate->id;
            $employees = $this->marketService->getAssoicateEmployees($user_associate->id);
        }
        $countries = $this->marketService->getCountryList();
        $leads = $this->marketService->getLeads();

        $introleads = $this->marketService->getIntroductionLeads();
        $compreleads = $this->marketService->getComprehensiveLeads();
        $accountOpenleads = $this->marketService->getAccountOpenedLeads();
        $accountPendingleads = $this->marketService->getAccountPendingLeads();
        //dd($accountOpenleads);
        //dd($leads);
        return view('client.lead.index')
            ->with([
                'countries' => $countries,
                'associates' => $associates,
                'user_associate' => $user_associate,
                'employees' => $employees,
                'leads' => $leads,
                'introleads' => $introleads,
                'compreleads' => $compreleads,
                'accountOpenleads' => $accountOpenleads,
                'accountPendingleads' => $accountPendingleads,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $lead = $this->marketService->setLead($data);
        //dd($lead);
        return response()->json($lead);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $data = $request->all();
        $data['id'] = $id;
        $lead = $this->marketService->setLead($data);
        //dd($lead);
        $lead = $this->marketService->getSingleLead($id);
        return response()->json($lead);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
