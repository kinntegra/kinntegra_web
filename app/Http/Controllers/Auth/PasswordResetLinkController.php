<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\checkUsername;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Services\MarketService;
use App\Services\MyServices;

class PasswordResetLinkController extends Controller
{
    protected $marketService;

    /**
     *  Create a new controller instance
     *
     *  @return Void
     */
    public function __construct(MarketService $marketService)
    {
        parent::__construct($marketService);
    }



    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('auth.forgot-password_new', ['title' => $request->target]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->usernamevalidator($request->all())->validate();
        $data = request(['username']);

        $this->marketService->forgotPassword($data);

        $title = "Check Your Email";
        $title = MyServices::getEncryptedString($title);
        $message = "An e-mail has been sent to you with the password reset link.";
        $message = MyServices::getEncryptedString($message);

        return redirect()->route('password.success',['title'=>$title,'message'=>$message]);

    }

    public function usernamevalidator(array $data)
    {
        $validator = Validator::make($data, [
            'username' => ['required', new checkUsername()],
        ], [
            'username.required' => 'Enter Your PAN NO',
        ]);
        return $validator;
    }

    public function createSuccess(Request $request)
    {
        $title = MyServices::getDecryptedString($request->title);
        $message = MyServices::getDecryptedString($request->message);
        return view('auth.success', ['title' => $title, 'message' => $message]);
    }
}
