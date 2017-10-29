<?php

namespace Codenetix\SocialMediaImporter\Importers;

use Codenetix\SocialMediaImporter\Contracts\AuthContextInterface;
use Codenetix\SocialMediaImporter\Contracts\DraugiemClientInterface;
use Codenetix\SocialMediaImporter\Contracts\FacebookClientInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use Codenetix\SocialMediaImporter\FactoryMethods\FacebookMediaAdapterFactoryMethod;
use DraugiemApi;
use Facebook\Facebook;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
abstract class ADraugiemMediaImporter extends AMediaImporter
{
    protected $draugiemClient;

    /**
     * ADraugiemMediaImporter constructor.
     * @param AuthContextInterface $authContext
     * @param MediaFactoryMethodInterface|null $mediaFactoryMethod
     * @param FacebookClientInterface|null $draugiemClient
     */
    public function __construct(AuthContextInterface $authContext, MediaFactoryMethodInterface $mediaFactoryMethod = null, FacebookClientInterface $draugiemClient = null)
    {
        parent::__construct($mediaFactoryMethod);

        if (!$draugiemClient) {
            $this->draugiemClient = new DraugiemApi($authContext->getAppId(),
                $authContext->getAppSecret(),
                $authContext->getAuthToken()
            );
        } else {
            $this->draugiemClient = $draugiemClient;
        }
    }


}