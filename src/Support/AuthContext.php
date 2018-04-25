<?php

namespace Codenetix\SocialMediaImporter\Support;
use Codenetix\SocialMediaImporter\Contracts\AuthContextInterface;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class AuthContext implements AuthContextInterface
{
    /**
     * @var string $authToken
     */
    private $authToken;

    /**
     * @var string $appId
     */
    private $appId;

    /**
     * @var string $appSecret
     */
    private $appSecret;

    /**
     * @var string $providerUserId
     */
    private $providerUserId;
    
    /**
     * AuthContext constructor.
     * @param string $authToken
     * @param string $appId
     * @param string $appSecret
     * @param string $providerUserId
     */
    public function __construct($appId, $appSecret, $authToken, $providerUserId = null)
    {
        $this->authToken = $authToken;
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->providerUserId = $providerUserId;
    }

    /**
     * @return string
     */
    public function getAuthToken(){
        return $this->authToken;
    }

    /**
     * @return string
     */
    public function getAppId(){
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getAppSecret(){
        return $this->appSecret;
    }

    /**
     * @return string
     */
    public function getProviderUserId(){
        return $this->providerUserId;
    }
}