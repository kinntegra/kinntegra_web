<?php

namespace App\Traits;

trait ClientAuthorization
{
    /**
     *  Generates a URL to obtain Users authorization
     *  @return string
     */
    public function resolveAuthorizationUrl()
    {
        $query = http_build_query([
            'client_id' => $this->clientId,
            'redirect_uri' => route('authorization'),
            'response_type' => 'code',
        ]);
        return "{$this->baseUri}/oauth/authorize?{$query}";
    }

    /**
     *  Obtains an access token from a given code
     *  @return stdClass
     */
    public function getCodeToken($code)
    {
        $formParams = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => route('authorization'),
            'code' => $code
        ];

        $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);

        $this->storeValidToken($tokenData, 'authorization_code');

        return $tokenData;
    }
}
