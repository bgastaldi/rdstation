<?php

namespace RDStation;

class AccessToken
{
    /**
     * Authentication
     *
     * @var Authentication
     */
    private $auth;    

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

    public function __construct(Authentication $auth = null, string $token = null, int $expiresIn = null, string $refreshToken = null)
    {
        $this->auth = $auth;
        $this->token = $token;
        $this->expiresIn = $expiresIn;
        $this->refreshToken = $refreshToken;
    }

    public function refresh()
    {
        if (!$this->auth) {
            throw new \Exception('No authentication exists on AccessToken. Try setting it calling the method AccessToken::setAuth(Authentication $auth).');
        }

        $this->auth->refreshAccessToken($this->refreshToken);
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

    /**
     * Get authentication
     *
     * @return  Authentication
     */ 
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Set authentication
     *
     * @param  Authentication  $auth  Authentication
     *
     * @return  self
     */ 
    public function setAuth(Authentication $auth)
    {
        $this->auth = $auth;

        return $this;
    }
}