<?php

namespace Codenetix\SocialMediaImporter\Importers;

use Codenetix\SocialMediaImporter\Exceptions\AuthenticationException;
use Codenetix\SocialMediaImporter\Exceptions\ImportException;
use Codenetix\SocialMediaImporter\Exceptions\WrongInputURLException;
use Codenetix\SocialMediaImporter\FactoryMethods\FacebookMediaAdapterFactoryMethod;
use Facebook\Exceptions\FacebookAuthenticationException;
use Facebook\Exceptions\FacebookSDKException;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class FacebookSingleMediaImporter extends AFacebookMediaImporter
{
    private function checkURL($url)
    {
        if (preg_match('/^https:\/\/(?:www\.)?facebook\.com\/photo\.php\?fbid=[0-9]+&?/', $url)) {
            return;
        }

        if (preg_match('/^https:\/\/(?:www\.)?facebook\.com\/[\w]+\/photos\/(?:[a-z\.0-9]+\/)?([0-9]+)\/?\??/', $url)) {
            return;
        }

        if (preg_match('/^https:\/\/(?:www\.)?facebook\.com\/[\w]+\/videos\/(?:[a-z\.0-9]+\/)?([0-9]+)\/?\??/', $url)) {
            return;
        }

        throw new WrongInputURLException("Wrong Facebook URL has been provided - ".$url);
    }

    public function importByURL($url)
    {
        $this->checkURL($url);

        $data = $this->getRequestDataFromURL($url);

        try {
            $item = $this->facebookClient->get($data['url'])->getDecodedBody();
        } catch(FacebookAuthenticationException $e){
            throw new AuthenticationException("Wrong access token is provided");
        } catch(FacebookSDKException $e){
            throw new ImportException($e->getMessage());
        }

        return (new FacebookMediaAdapterFactoryMethod())->make($data['type'], $item)->transform($this->mediaFactoryMethod);
    }

    private function getRequestDataFromURL($url)
    {
        if (preg_match('#photo\.php\?fbid=([0-9]+)#', $url, $result)) {
            return ['url' => $result[1] . '?fields=name,source,id,images', 'type' => 'image'];
        } else if (preg_match('#photos\/(?:[a-z\.0-9]+\/)?([0-9]+)#', $url, $result)) {
            return ['url' => $result[1] . '?fields=name,source,id,images', 'type' => 'image'];
        } else if (preg_match('#videos\/(?:[a-z\.0-9]+\/)?([0-9]+)#', $url, $result)) {
            return ['url' => $result[1] . '?fields=description,source,id,thumbnails,embed_html', 'type' => 'video'];
        }

        throw new WrongInputURLException("Wrong Facebook URL has been provided - ".$url);
    }
}