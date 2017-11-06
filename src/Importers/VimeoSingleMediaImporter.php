<?php

namespace Codenetix\SocialMediaImporter\Importers;
use Codenetix\SocialMediaImporter\Adapters\VimeoMediaAdapter;
use Codenetix\SocialMediaImporter\Exceptions\RequestedDataNotFoundException;
use Codenetix\SocialMediaImporter\Exceptions\WrongInputURLException;
use Codenetix\SocialMediaImporter\FactoryMethods\MediaFactoryMethod;


/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class VimeoSingleMediaImporter
{
    private function checkURL($url)
    {
        if (preg_match('/^https:\/\/vimeo\.com\/[0-9]+\/?/', $url)) {
           return true;
        }

        if (!preg_match('/^https:\/\/vimeo\.com\/[0-9]+\/[0-9]+\/video\/[0-9]+\/?/', $url)) {
            return true;
        }

        if (!preg_match('/^https:\/\/vimeo\.com\/album\/[0-9]+\/video\/[0-9]+\/?/', $url)) {
            return true;
        }

        if (!preg_match('/^https:\/\/vimeo\.com\/channels\/[0-9]+\/[0-9]+\/?/', $url)) {
            return true;
        }

        if (!preg_match('/^https:\/\/vimeo\.com\/groups\/[0-9]+\/videos\/[0-9]+\/?/', $url)) {
            return true;
        }

        if (!preg_match('/^https:\/\/vimeo\.com\/ondemand\/[0-9]+\/[0-9]+\/?/', $url)) {
            return true;
        }

        throw new WrongInputURLException("Wrong URL format");
    }

    public function importByURL($url)
    {
        $this->checkURL($url);

        $jsonUrl = 'http://vimeo.com/api/oembed.json?url=' . rawurlencode($url) . '&width=640';

        $result = json_decode($this->curlGet($jsonUrl));

        if(!$result){
            throw new RequestedDataNotFoundException("Requested media was not found");
        }

        return (new VimeoMediaAdapter($result))->transform(new MediaFactoryMethod());
    }

    private function curlGet($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return $return;
    }

}