<?php

namespace RDStation;

final class Authentication
{
    /**
     * Client id
     *
     * @var string
     */
    private $clientId;

    /**
     * Client secret
     *
     * @var string
     */
    private $clientSecret;

    public function __construct($clientId = null, $clientSecret = null)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Get an Access token
     *
     * @param string $code Authorization code to get access token
     * @return AccessToken
     */
    public function getAccessToken($code)
    {
        $response = null;

        $response = Request::send('POST', '/auth/token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $code
        ]);

        if (!$response) {
            throw new \Exception('RDStation::getAccessToken(): Request failed on response.');
        }

        return new AccessToken($this, $response['access_token'], $response['expires_in'], $response['refresh_token']);
    }

    /**
     * Refresh an access token
     *
     * @param string $refreshToken
     * @return void
     */
    public function refreshAccessToken(string $refreshToken)
    {
        $fields = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $refreshToken
        ];

        $response = Request::send('POST', '/auth/token', $fields, [
            'Content-Type: application/json'
        ]);

        if (!$response) {
            throw new \Exception('Could not refresh access token.');
        }

        return new AccessToken($this, $response['access_token'], $response['expires_in'], $response['refresh_token']);
    }

    /**
     * Get client id
     *
     * @return  string
     */ 
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set client id
     *
     * @param  string  $clientId  Client id
     *
     * @return  self
     */ 
    public function setClientId(string $clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get client secret
     *
     * @return  string
     */ 
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Set client secret
     *
     * @param  string  $clientSecret  Client secret
     *
     * @return  self
     */ 
    public function setClientSecret(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }
}