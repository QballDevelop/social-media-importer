<?php

namespace Codenetix\SocialMediaImporter\Importers;

use Codenetix\SocialMediaImporter\Exceptions\ImportException;
use Codenetix\SocialMediaImporter\Exceptions\RequestedDataNotFoundException;
use Codenetix\SocialMediaImporter\Exceptions\WrongInputURLException;
use Codenetix\SocialMediaImporter\FactoryMethods\InstagramMediaAdapterFactoryMethod;
use Codenetix\SocialMediaImporter\Scrapers\InstagramScraper;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class InstagramSingleMediaImporter extends AInstagramMediaImporter
{
    private function checkURL($url)
    {
        if (!preg_match('/^https?:\/\/(?:www\.)?instagram\.com\/p\/[a-zA-Z0-9_-]+\/?/', $url)) {
            throw new WrongInputURLException("Wrong URL format");
        }
    }

    public function importByURL($url)
    {
        $this->checkURL($url);

        $item = $this->instagramClient->getMedia((new InstagramScraper($url))->id());

        if(!$item){
            throw new RequestedDataNotFoundException("Requested media was not found");
        }

        if($item->meta->code != 200){
            throw new ImportException($item->meta->error_message);
        }

//        $embedItemRaw = $this->curlGet('https://api.instagram.com/oembed/?url='.rawurlencode($url));
//        $embedItem = json_decode($embedItemRaw);
//
//        if(is_null($embedItem)){
//            throw new RequestedDataNotFoundException("Requested media was not found");
//        }
//
//        $item->data->html = $embedItem->html;

        return (new InstagramMediaAdapterFactoryMethod())->make($item->data->type, $item->data)->transform($this->mediaFactoryMethod);
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