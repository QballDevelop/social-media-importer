<?php

namespace Codenetix\SocialMediaImporter\Importers;
use Codenetix\SocialMediaImporter\Contracts\AuthContextInterface;
use Codenetix\SocialMediaImporter\Contracts\FacebookClientInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use Codenetix\SocialMediaImporter\FactoryMethods\FacebookMediaAdapterFactoryMethod;
use Facebook\Facebook;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
abstract class AFacebookMediaImporter extends AMediaImporter
{
    private $facebookClient;

    protected abstract function getURL();

    protected abstract function getType();

    /**
     * AFacebookMediaImporter constructor.
     * @param AuthContextInterface $authContext
     * @param MediaFactoryMethodInterface|null $mediaFactoryMethod
     * @param FacebookClientInterface|null $facebookClient
     */
    public function __construct(AuthContextInterface $authContext, MediaFactoryMethodInterface $mediaFactoryMethod = null, FacebookClientInterface $facebookClient = null)
    {
        parent::__construct($mediaFactoryMethod);

        if(!$facebookClient){
            $this->facebookClient = new Facebook([
                'app_id' => $authContext->getAppId(),
                'app_secret' => $authContext->getAppSecret(),
                'default_graph_version' => 'v2.10',
                'default_access_token' => $authContext->getAuthToken()
            ]);
        } else {
            $this->facebookClient = $facebookClient;
        }

    }

    /**
     * @return array
     */
    public function import(){
        $edge = $this->facebookClient->get($this->getURL())->getGraphEdge();
        $videos = [];
        do {
            foreach ($edge as $edgeItem){
                array_push($videos, (new FacebookMediaAdapterFactoryMethod())->make($this->getType(), $edgeItem->asArray())->transform($this->mediaFactoryMethod));
            }
        } while($edge = $this->facebookClient->next($edge));

        return $videos;
    }

}