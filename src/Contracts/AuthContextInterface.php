<?php

namespace Codenetix\SocialMediaImporter\Contracts;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
interface AuthContextInterface
{
    /**
     * @return string
     */
    public function getAuthToken();

    /**
     * @return string
     */
    public function getAppId();

    /**
     * @return string
     */
    public function getAppSecret();
}