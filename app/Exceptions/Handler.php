<?php

namespace App\Exceptions;

use ErrorException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->renderable(function (ErrorException $e, $request) {
        //     abort(403, $e->getMessage());
        // });

        $this->renderable(function (ClientException $e, $request){
            return $this->handleClientException($e, $request);
        });
    }

    /**
     *  Handle correctly the exception when sending the request
     *  @return void
     */
    protected function handleClientException($exception, $request)
    {
        $code = $exception->getCode();

        $response = json_decode($exception->getResponse()->getBody()->getContents());

        $errorMessage = $response->error;

        switch ($code) {
            case Response::HTTP_UNAUTHORIZED:$request->session()->invalidate();

                if($request->user())
                {
                    Auth::logout();

                    return redirect()
                        ->route('login')
                        ->withErrors(['message' => 'The Authentication failed. Please login again']);
                }

                return redirect()
                        ->route('login')
                        ->withErrors(['message' => 'The Authentication failed. Please login again']);
                //abort(500, 'Error Authentication failed. Please login again');

            default:
                if($request->ajax())
                {
                    //dd($errorMessage);
                    return response()->json(['server_errors' => $errorMessage], Response::HTTP_NOT_FOUND);
                }else{
                    return redirect()->back()->withErrors($errorMessage);
                }


        }
    }

    protected function add_error($error_msg, $key = 'default') {
        $errors = Session::get('errors', new ViewErrorBag);

        if (! $errors instanceof ViewErrorBag) {
            $errors = new ViewErrorBag;
        }

        $bag = $errors->getBags()['default'] ?? new MessageBag;
        $bag->add($key, $error_msg);

        Session::flash(
            'errors', $errors->put('default', $bag)
        );
    }
}
