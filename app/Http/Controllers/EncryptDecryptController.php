<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use App\Services\MyServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PDF;

class EncryptDecryptController extends Controller
{
    /**
     * Create a new controller instance
     * @return Void
     */
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');
        parent::__construct($marketService);
    }

    public function encrypt(Request $request)
    {
        if(isset($request->data))
        {
            $data = $request->data;
            $data = MyServices::getencryptNo($data);
        }
        if(isset($request->data1))
        {
            $data1 = $request->data1;
            $data1 = MyServices::getencryptNo($data1);

            $data = [$data,$data1];
        }

        if($request->ajax())
        {
            return response()->json($data);
        }
    }

    public function decrypt(Request $request)
    {
        $data = $request->data;
        $data = Crypt::decrypt($data);
        if($request->ajax())
        {
            return response()->json($data);
        }
    }

    public function printPDF()
    {
       // This  $data array will be passed to our PDF blade
       $data = [
          'title' => "First PDF for Medium",
          'heading' => "Hello from 99Points.info",
          'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged."
            ];

        $pdf = PDF::loadView('pdf_view', $data);
        return $pdf->download('medium.pdf');
    }

    public function encryptNo(Request $request)
    {
        $id = $request->id;

        $service = MyServices::getencryptNo($id);
        echo $service;
        echo "<br>";
        $service = MyServices::getdecryptNo($service);
        dd($service);

    }

    public function decryptNo(Request $request)
    {
        $code = $request->code;

        $service = MyServices::getdecryptNo($code);
        dd($service);
    }
}
