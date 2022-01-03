<?php

namespace App\Services;

use App\Traits\ClientAuthorization;
use App\Traits\ConsumeExternalServices;
use App\Traits\InteractsWithMarketResponses;

class MarketAuthenticationService
{
    use ConsumeExternalServices, InteractsWithMarketResponses, ClientAuthorization;
    /**
     *  The URL to send a request
     *  @var string
     */
    protected $baseUri;

    /**
     *  The Client Id to identify the client in the API
     *  @var string
     */
    protected $clientId;

    /**
     *  The Client Secret to identify the client in the API
     *  @var string
     */
    protected $clientSecret;

    /**
     *  The Client Id to identify the Password client in the API
     *  @var string
     */
    protected $passwordClientId;

    /**
     *  The Client Secret to identify the Password client in the API
     *  @var string
     */
    protected $passwordClientSecret;

    public function __construct()
    {
        $this->baseUri = config('services.market.base_uri');
        $this->clientId = config('services.market.client_id');
        $this->clientSecret = config('services.market.client_secret');
        $this->passwordClientId = config('services.market.password_client_id');
        $this->passwordClientSecret = config('services.market.password_client_secret');
    }

    /**
     *  Obtains an Access Associated with client
     *  @return StdClass
     */
    public function getClientCredentialsToken()
    {
        if($token = $this->existingValidToken())
        {
            return $token;
        }
        $formParams = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);

        $this->storeValidToken($tokenData, 'client_credentials');

        return $tokenData->access_token;
    }

    /**
     *  Obtains an access token the user credentials
     *
     *  @return stdClass
     */
    public function getPasswordToken($username, $password)
    {
        $formParams = [
            'grant_type' => 'password',
            'client_id' => $this->passwordClientId,
            'client_secret' => $this->passwordClientSecret,
            'username' => $username,
            'password' => $password
        ];

        $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);

        $this->storeValidToken($tokenData, 'password');

        return $tokenData;
    }

    /**
     *  Obtains a vlaid access token from the current user
     *  @return String
     */
    public function getAuthenticatedUserToken()
    {
        $user = auth()->user();

        if(now()->lt($user->token_expires_at))
        {
            return $user->access_token;
        }
        return $this->refreshAuthenticatedUserToken($user);
    }


    /**
     *  Refresh a valid token for a user
     *
     *  @return string
     */
    public function refreshAuthenticatedUserToken($user)
    {
        $clientId = $this->clientId;
        $clientSecret = $this->clientSecret;
        if($user->grant_type === 'password')
        {
            $clientId = $this->passwordClientId;
            $clientSecret = $this->passwordClientSecret;
        }

        $formParams = [
            'grant_type' => 'refresh_token',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $user->refresh_token,
        ];

        $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);

        $this->storeValidToken($tokenData, $user->grant_type);

        $user->fill([
            'access_token' => $tokenData->access_token,
            'refresh_token' => $tokenData->refresh_token,
            'token_expires_at' => $tokenData->token_expires_at,
        ]);

        $user->save();

        return $tokenData->access_token;
    }

    /**
     *  Stores a valid token with some attributes
     *  @return void
     */
    public function storeValidToken($tokenData, $grantType)
    {
        $tokenData->token_expires_at = now()->addSeconds($tokenData->expires_in -5);
        $tokenData->access_token = "{$tokenData->token_type} {$tokenData->access_token}";
        $tokenData->grant_type = $grantType;

        session()->put(['current_token' => $tokenData]);
    }

    /**
     *  Verify if there is any valid token on the session
     *  @return string/boolean
     */
    public function existingValidToken()
    {
        if(session()->has('current_token'))
        {
            $tokenData = session()->get('current_token');

            if(now()->lt($tokenData->token_expires_at)){
                return $tokenData->access_token;
            }
            return false;
        }
    }
}
