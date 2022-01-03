<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\CheckPIN;
use App\Services\MarketAuthenticationService;
use App\Services\MarketService;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{

    /**
     *  The service to authenticate actions
     *  @var App\Services\MarketAuthenticationService
     */
    protected $marketAuthenticationService;

    protected $marketService;

    /**
     *  Create a new controller instance
     *
     *  @return Void
     */
    public function __construct(MarketAuthenticationService $marketAuthenticationService, MarketService $marketService)
    {
        $this->marketAuthenticationService = $marketAuthenticationService;

        parent::__construct($marketService);
    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login_new');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        try {
            $tokenData = $this->marketAuthenticationService->getPasswordToken($request->username, $request->password);

            $userData = $this->marketService->getUserInformation();

            if($userData->is_active == 1){

                //If User Has Role - Admin or Employee or Client
                //First Employee is Active or Not
                //End
                if($userData->is_first == 1){

                    return redirect()->route('password.reset.first');
                }
                $user = $this->registerOrUpdateUser($userData, $tokenData);

                return redirect()->route('loginpin');
            }else{
                return back()->withErrors(['username' => ['INACTIVE Account : Contact Admin']]);
            }


        }catch (ClientException $e) {
            $message = json_encode($e->getMessage());

            if(Str::contains($message, 'invalid_grant'))
            {
                $request->authenticate();
            }
            if(Str::contains($message, 'invalid_client'))
            {
                $request->authenticate();
            }

            throw $e;
        }

    }

    public function createpin()
    {
        return view('auth.login_pin');
    }

    public function storepin(Request $request)
    {
        $userData = $this->marketService->getUserInformation();

        $this->pinvalidator($request->all(), $userData->pin)->validate();

        $user = User::where('service_id',$userData->id)->firstorFail();

        $this->loginUser($user);

        $request->session()->regenerate();

        $user->last_seen_at = Carbon::now()->format('Y-m-d H:i:s');

        $user->save();
        //dd(Auth::user());
        //return redirect(RouteServiceProvider::HOME);
        return redirect()->intended('dashboard');
    }

    public function pinvalidator(array $data, $pin)
    {
        $validator = Validator::make($data, [
            'pin' => ['required', new CheckPIN($pin)],
        ], [
            'pin.required' => 'Enter Your Pin',
        ]);
        return $validator;
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $this->marketService->userLogout();

        return redirect('/');
    }

    /**
     *  Resolve User authorization
     *
     *  @return \Illuminate\HttpResponse
     */
    public function authorization(Request $request)
    {
        if($request->has('code'))
        {
            $tokenData = $this->marketAuthenticationService->getCodeToken($request->code);

            $userData = $this->marketService->getUserInformation();

            $user = $this->registerOrUpdateUser($userData, $tokenData);

            $this->loginUser($user, $request->has('remember'));

            return redirect()->intended('home');
        }
        return redirect()
            ->route('login')
            ->withErrors(['You cancelled the authorization process']);
    }

    /**
     *  Create or Update User using Information form the API
     *
     *  @return App\User
     */
    public function registerOrUpdateUser($userData, $tokenData)
    {
        return User::updateOrCreate(
            ['service_id' => $userData->id],
            [
                'grant_type' => $tokenData->grant_type,
                'access_token' => $tokenData->access_token,
                'refresh_token' => $tokenData->refresh_token,
                'token_expires_at' => $tokenData->token_expires_at,
            ]
        );
    }

    /**
     *  Create User Session in the Http Client
     *  @return Void
     */
    public function loginUser(User $user, $remember = true)
    {
        Auth::login($user, $remember);

        //session()->regenerate();
    }

    protected function authenticated(Request $request, $user)
    {
        $user->last_seen_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->save();

    }


}
