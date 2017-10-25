<?php

namespace Codenetix\SocialMediaImporter\Importers;
use Codenetix\SocialMediaImporter\Contracts\AuthContextInterface;
use Codenetix\SocialMediaImporter\Contracts\InstagramClientInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use MetzWeb\Instagram\Instagram;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
abstract class AInstagramMediaImporter extends AMediaImporter
{
    protected $instagramClient;

    /**
     * AInstagramMediaImporter constructor.
     * @param AuthContextInterface $authContext
     * @param MediaFactoryMethodInterface|null $mediaFactoryMethod
     * @param InstagramClientInterface $instagramClient
     */
    public function __construct(AuthContextInterface $authContext, MediaFactoryMethodInterface $mediaFactoryMethod = null, InstagramClientInterface $instagramClient = null)
    {
        parent::__construct($mediaFactoryMethod);

        if(!$instagramClient){
            $this->instagramClient = new Instagram(array(
                'apiKey'      => $authContext->getAppId(),
                'apiSecret'   => $authContext->getAppSecret(),
                'apiCallback' => ''
            ));
        } else {
            $this->instagramClient = $instagramClient;
        }

        $this->instagramClient->setAccessToken($authContext->getAuthToken());
    }
}