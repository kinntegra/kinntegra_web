<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Services\MarketService;
use App\Services\MyServices;

class NewPasswordController extends Controller
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
     * Display the password reset view.
     *
     * @return \Illuminate\View\View
     */
    public function create($token)
    {
        $user = $this->marketService->CheckPasswordToken($token);

        return view('auth.reset-password_new', ['user' => $user]);
    }

    /**
     * Display the password reset view.
     *
     * @return \Illuminate\View\View
     */
    public function createFirst()
    {
        $user = $this->marketService->getUserInformation();

        return view('auth.reset-password_new_first', compact('user'));
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|confirmed',
            'pin' => 'required|string|confirmed',
        ]);
        $data = $this->marketService->resetPassword($request->all());

        $title = "Success";
        $title = MyServices::getEncryptedString($title);
        $message = "Your Password and 2FA has been reset successfully!";
        $message = MyServices::getEncryptedString($message);

        return redirect()->route('password.success',['title'=>$title,'message'=>$message]);

    }

    public function storeFirst(Request $request)
    {
        $data = $this->marketService->resetPasswordFirst($request->all());

        $title = "Success";
        $title = MyServices::getEncryptedString($title);
        $message = "Your Password and 2FA has been reset successfully!";
        $message = MyServices::getEncryptedString($message);

        return redirect()->route('password.success',['title'=>$title,'message'=>$message]);
    }
}
