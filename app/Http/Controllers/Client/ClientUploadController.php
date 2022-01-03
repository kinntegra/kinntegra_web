<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(isset($request->is_verify))
        {
            $title = "Ready for transaction";
            $message = "Client is now ready for transction";
        }else{
            $title = "Send for verification";
            $message = "Your request has send for admin verification";
        }

        return view('client.message')->with([
            'title' => $title,
            'message' => $message,
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
        //return response()->json($data);
        if($request->is_verify == 0 && $request->has_new_upload == 0)
        {
            $result = [
                'status' => 1,
            ];
            return response()->json($result);
        }
        //return response()->json($request->all());
        //dd($data);


        if($request->is_verify == 0 && $request->has_new_upload == 1)
        {
            $indivudual_count = (int)$request->individual_count;
            $nonindividual_count = (int)$request->nonindividual_count;
            $total_count = $indivudual_count + $nonindividual_count;
            $unique_account_id = [];
            $count = 0;
            for ($i=1; $i <= $total_count; $i++)
            {   //print_r($i);
                $data = $request->all();
                $send_to_server = 0;
                foreach($data as $key => $value)
                {
                    if(Str::endsWith($key, '_upload'))
                    {
                        if($request->hasFile($key))
                        {
                            $key_array = explode("_",$key);
                            if(!array_key_exists($i, $unique_account_id) && !in_array($key_array[1], $unique_account_id))
                            {
                                $unique_account_id[$i] = $key_array[1];
                                $data['client_account_id'] = $key_array[1];
                                $data['send1of1verification'] = 0;
                                foreach($data as $skey => $svalue)
                                {
                                    if(Str::endsWith($skey, '_upload'))
                                    {
                                        if($request->hasFile($skey))
                                        {
                                            $skey_array = explode("_",$skey);

                                            if($skey_array[1] == $key_array[1])
                                            {
                                                $first_key = $skey_array[0];

                                                $last_key = $skey_array[count($skey_array)-1];
                                                $final_key = $first_key.'_'.$last_key;

                                                $data[$final_key] = fopen($request->$skey->path(), 'r');
                                                //
                                                $filename = $request->$skey->getClientOriginalName();
                                                $extension = $request->$skey->getClientOriginalExtension();
                                                $ogname = str_replace(".".$extension,"",$filename);
                                                $final_ogname = $first_key.'_name';
                                                $data[$final_ogname] = $ogname;
                                                $final_ext = $first_key.'_extension';
                                                $data[$final_ext] = $extension;
                                                $final_key = $first_key.'_filename';
                                                $data[$final_key] = $filename;
                                                $send_to_server++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                //dd($send_to_server);
                if($send_to_server > 0)
                {
                    $client = $this->marketService->setClientDetails($data);

                }
            }

            $count = count($unique_account_id);
            //dd($count);
            $newdata = $request->all();
            $newdata['account_ids'] = json_encode($unique_account_id);
            $newdata['send1of1verification'] = 1;
            //dd($data);
            $client = $this->marketService->setClientDetails($newdata);
            $result = [
                'status' => 2,
            ];
            return response()->json($result);
        }

        if($request->is_verify == 1)
        {
            //return response()->json($data);
            $client = $this->marketService->setClientDetails($data);
            if($request->is_reject == 1)
            {
                $result = [
                    'status' => 4,
                ];
            }else{
                $result = [
                    'status' => 3,
                ];
            }
            return response()->json($result);
        }

        //dd($unique_account_id);
        // return response()->json($client);


        // dd($data);
        //$client = $this->marketService->setClientDetails($data);
        // dd($client);
        // if($request->ajax())
        // {
        //     return response()->json($client);
        // }
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
        //dd($client);
        return view('client.upload')
        ->with([
            'client_id' => $id,
            'client' => $client,
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
