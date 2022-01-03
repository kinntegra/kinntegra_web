<?php

namespace App\Http\Controllers\Admin\MasterUpload;

use App\Http\Controllers\Controller;
use App\Services\MarketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class BankMasterController extends Controller
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
        if($request->ajax())
        {
            $banks = $this->marketService->getBankMaster();
            return Datatables::of($banks)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a><a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }else{
            return view('admin.master_view.bank_master');
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = 'bankcodes';
        $date = $this->marketService->getMasterLastUpdatedDate($code);

        return view('admin.master_upload.bank_master')->with([
            'date' => $date,
        ]);
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
        $validator = Validator::make($data, [
                'bank_upload' => 'required|mimes:csv,xlsx,xls',
            ],
            [
                'bank_upload.required' => 'Please upload file',
                'bank_upload.mimes' => 'Please upload only excel file'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data['bank_upload'] = fopen($request->bank_upload->path(), 'r');
        $bank_master = $this->marketService->uploadBankMaster($data);

        if($bank_master->status == 1)
        {
            return redirect()->back()->with('success', [$bank_master->remarks]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


}
