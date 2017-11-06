<?php

namespace Codenetix\SocialMediaImporter\Importers;

use Codenetix\SocialMediaImporter\Exceptions\AuthenticationException;
use Codenetix\SocialMediaImporter\Exceptions\ImportException;
use Codenetix\SocialMediaImporter\FactoryMethods\FacebookMediaAdapterFactoryMethod;
use Facebook\Exceptions\FacebookAuthenticationException;
use Facebook\Exceptions\FacebookAuthorizationException;
use Facebook\Exceptions\FacebookSDKException;


/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
abstract class AFacebookBulkMediaImporter extends AFacebookMediaImporter
{
    protected abstract function getURL();

    protected abstract function getType();

    /**
     * @return array
     * @throws AuthenticationException
     * @throws ImportException
     */
    public function import()
    {
        try {
            $edge = $this->facebookClient->get($this->getURL())->getGraphEdge();
        } catch (FacebookAuthenticationException $e) {
            throw new AuthenticationException("Wrong access token is provided");
        } catch (FacebookSDKException $e) {
            throw new ImportException($e->getMessage());
        }

        $videos = [];
        do {
            foreach ($edge as $edgeItem) {
                array_push($videos, (new FacebookMediaAdapterFactoryMethod())->make($this->getType(), $edgeItem->asArray())->transform($this->mediaFactoryMethod));
            }
        } while ($edge = $this->facebookClient->next($edge));

        return $videos;
    }
}