<?php

namespace Codenetix\SocialMediaImporter\Importers;
use Codenetix\SocialMediaImporter\Contracts\AuthContextInterface;
use Codenetix\SocialMediaImporter\Contracts\InstagramClientInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use Codenetix\SocialMediaImporter\FactoryMethods\InstagramMediaAdapterFactoryMethod;
use MetzWeb\Instagram\Instagram;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
abstract class AInstagramMediaImporter extends AMediaImporter
{
    private $instagramClient;

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

    protected abstract function getType();

    public function import(){
        $items = $this->instagramClient->getUserMedia('self');
        $result = [];
        do {
            foreach ($items->data as $item){
                if($item->type != $this->getType()){
                    continue;
                }
                array_push($result, (new InstagramMediaAdapterFactoryMethod())->make($this->getType(), $item)->transform($this->mediaFactoryMethod));
            }
        } while($items = $this->instagramClient->pagination($items));

        return $result;
    }
}