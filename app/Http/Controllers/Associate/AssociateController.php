<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Associate\AssociateRequest;
use App\Services\MarketService;
use App\Services\MyServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class AssociateController extends Controller
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
    public function index()
    {
        $associates = $this->marketService->getAssoicates();
        //dd($associates);
        $employees = $this->marketService->getEmployees();
        //dd($employees);
        return view('associate.index')
            ->with([
                'associates' => $associates,
                'employees' => $employees,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 1;
        $associates = $this->marketService->getAssoicates($active);
        $professions = $this->marketService->getProfessions();
        $entitytypes = $this->marketService->getEntityTypes();
        $commercials = $this->marketService->getCommercials();
        $commercialtypes = $this->marketService->getCommercialTypes();
        $countries = $this->marketService->getCountryList();
        $relations = $this->marketService->getRelationList();
        $details = 0;
        return view('associate.create')
            ->with([
                'associates' => $associates,
                'professions' => $professions,
                'entitytypes' => $entitytypes,
                'commercials' => $commercials,
                'commercialtypes' => $commercialtypes,
                'countries' => $countries,
                'relations' => $relations,
                'details' => $details,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssociateRequest $request)
    {

        //$validated = $request->validated();
        //dd($validated);
        $data = $request->all();
        //return response()->json($data);
        foreach($data as $key => $value) {

            if(Str::endsWith($key, '_upload'))
            {
                if($request->hasFile($key))
                {
                    $data[$key] = fopen($request->$key->path(), 'r');
                }
            }
        }
        if(isset($request->ria_certificate_type) && !empty($request->ria_certificate_type))
        {
            $data['ria_certificate_type'] = json_encode($request->ria_certificate_type);
        }
        //dd($data);
        //return response()->json($data);
        $associates = $this->marketService->setAssoicates($data);
        //dd($associates);
        return response()->json($associates);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        //$ecrypt = MyServices::getEncryptedString($id);

        $dcrypt = MyServices::getdecryptNo($id);

        $associate = $this->marketService->getSingleAssociate($dcrypt);
        //dd($associate);
        if($request->ajax())
        {
            return response()->json($associate);
        }
        if($associate->status == 2)
        {
            $name = $associate->entity_name .' - Created/Updated Successfully';
            $data = 'Associate send for Supervisior Verification';
        }
        else if($associate->status == 3 || $associate->status == 5)
        {
            $name = 'Verification process for '. $associate->entity_name . ' is completed';
            $data = 'Details send to Associate for self verification';
        }
        else if($associate->status == 4)
        {
            $name = 'Verification process for '. $associate->entity_name . ' is completed and Rejected';
            $data = 'Associate Details is send again for further updates as mentioned in rejection reason.';
        }else{
            return redirect()->route('associate.index');
        }
        return view('associate.success', compact('name','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = MyServices::getdecryptNo($id);

        $data = $this->marketService->getSingleAssociate($id);
        //dd($data->status);
        //dd($data);
        $download = [];
        $details = 0;
        $associates = $this->marketService->getAssoicates();
        $professions = $this->marketService->getProfessions();
        $entitytypes = $this->marketService->getEntityTypes();
        $commercials = $this->marketService->getCommercials();
        $commercialtypes = $this->marketService->getCommercialTypes();
        $countries = $this->marketService->getCountryList();
        $relations = $this->marketService->getRelationList();
        if($data->status == 10 || $data->status == 8)
        {
            $download['path'] = $this->marketService->getDownloadAssociate($id);
            $download['name'] = basename($download['path']);
         // dd($download);
        }
        return view('associate.create')
            ->with([
                'data' => $data,
                'associates' => $associates,
                'professions' => $professions,
                'entitytypes' => $entitytypes,
                'commercials' => $commercials,
                'commercialtypes' => $commercialtypes,
                'countries' => $countries,
                'relations' => $relations,
                'download' => $download,
                'details' => $details,
        ]);
    }

    public function showDetail($id)
    {
        $id = MyServices::getdecryptNo($id);

        $data = $this->marketService->getSingleAssociate($id);
        //dd($data->status);
        //dd($data);
        $download = [];
        $details = 1;
        $associates = $this->marketService->getAssoicates();
        $professions = $this->marketService->getProfessions();
        $entitytypes = $this->marketService->getEntityTypes();
        $commercials = $this->marketService->getCommercials();
        $commercialtypes = $this->marketService->getCommercialTypes();
        $countries = $this->marketService->getCountryList();
        $relations = $this->marketService->getRelationList();
        if($data->status == 10 || $data->status == 8)
        {
            $download['path'] = $this->marketService->getDownloadAssociate($id);
            $download['name'] = basename($download['path']);
            //dd($download);
        }
        return view('associate.create')
            ->with([
                'data' => $data,
                'associates' => $associates,
                'professions' => $professions,
                'entitytypes' => $entitytypes,
                'commercials' => $commercials,
                'commercialtypes' => $commercialtypes,
                'countries' => $countries,
                'relations' => $relations,
                'download' => $download,
                'details' => $details,
        ]);
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

    public function showMessage($id)
    {
        $aid = MyServices::getdecryptNo($id);
        $data = $this->marketService->getSingleAssociate($aid);
        $download = $this->marketService->getDownloadAssociate($aid);

        return view('associate.message')->with([
            'download' => $download,
            'data' => $data,
            'id' => $id,
        ]);
    }

    // public function sendMessage($id, Request $request)
    // {
    //     $aid = MyServices::getdecryptNo($id);

    //     return response()->json($request->all());
    // }

    public function showLogs($id)
    {
        $aid = MyServices::getdecryptNo($id);
        $logs = $this->marketService->getLogsAssociate($aid);
        $logs = $logs->logs;
        //dd($logs);
        foreach($logs as $log)
        {
            $log->created_time = Carbon::parse($log->created_at)->format('h:m:s A');
            $log->created_day = Carbon::parse($log->created_at)->format('l, jS F Y');
        }
        return response()->json($logs);
    }

    public function resetPassword($id)
    {
        $aid = MyServices::getdecryptNo($id);
        $associate = $this->marketService->getSingleAssociate($aid);
        $data = [];
        $data['username'] = $associate->pan_no;
        $success = $this->marketService->forgotPassword($data);
        return response()->json($success);
    }
}
