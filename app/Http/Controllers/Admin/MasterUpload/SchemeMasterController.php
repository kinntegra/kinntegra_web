<?php

namespace App\Http\Controllers\Admin\MasterUpload;

use App\Http\Controllers\Controller;
use App\Services\MarketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SchemeMasterController extends Controller
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
            $schemes = $this->marketService->getSchemeMaster();
            return Datatables::of($schemes)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<div class="dropdown text-right">';
                           $btn .= '<a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                           $btn .= '<i class="icon-dots"></i>';
                           $btn .= '</a>';
                           $btn .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">';
                           $btn .= '<a class="dropdown-item" href="#">View Details</a>';
                           $btn .= '<a class="dropdown-item" href="#">Edit Details</a>';
                           $btn .= '</div>';
                           $btn .= '</div>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }else{
            return view('admin.master_view.scheme_master');
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master_upload.scheme_master');
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
                'masterscheme_upload' => 'required|mimes:csv,xlsx,xls,txt',
            ],
            [
                'masterscheme_upload.required' => 'Please upload file',
                'masterscheme_upload.mimes' => 'Please upload only excel or txt file'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data['masterscheme_upload'] = fopen($request->masterscheme_upload->path(), 'r');
        $bank_master = $this->marketService->uploadSchemeMaster($data);

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
