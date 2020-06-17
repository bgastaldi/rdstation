<?php

namespace RDStation;

class AccessToken
{
    const API_ENDPOINT = 'https://api.rd.services';

    /**
     * Access token
     *
     * @var string
     */
    private $token;

    /**
     * Expire seconds
     *
     * @var int
     */
    private $expiresIn;

    /**
     * Refresh token
     *
     * @var string
     */
    private $refreshToken;

    public function __construct($token = null, $expiresIn = null, $refreshToken = null)
    {
        $this->token = $token;
        $this->expiresIn = $expiresIn;
        $this->refreshToken = $refreshToken;
    }

    public function refresh(string $clientId, string $clientSecret)
    {
        $fields = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $this->refreshToken
        ];

        $response = Request::send('POST', self::API_ENDPOINT . '/auth/token', $fields, [
            'Content-Type: application/json'
        ]);

        if (!$response) {
            throw new \Exception('Could not refresh access token.');
        }

        $this->token = $response['access_token'] ?? null;
        $this->expiresIn = $response['expires_in'] ?? null;
        $this->refreshToken = $response['refresh_token'] ?? null;
    }

    /**
     * Get access token
     *
     * @return  string
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set access token
     *
     * @param  string  $token  Access token
     *
     * @return  self
     */ 
    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get expire seconds
     *
     * @return  int
     */ 
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * Set expire seconds
     *
     * @param  int  $expiresIn  Expire seconds
     *
     * @return  self
     */ 
    public function setExpiresIn(int $expiresIn)
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }

    /**
     * Get refresh token
     *
     * @return  string
     */ 
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set refresh token
     *
     * @param  string  $refreshToken  Refresh token
     *
     * @return  self
     */ 
    public function setRefreshToken(string $refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }
}