<?php

namespace Codenetix\SocialMediaImporter\Importers;

use Codenetix\SocialMediaImporter\Exceptions\ImportException;
use Codenetix\SocialMediaImporter\Exceptions\RequestedDataNotFoundException;
use Codenetix\SocialMediaImporter\FactoryMethods\InstagramMediaAdapterFactoryMethod;
use Codenetix\SocialMediaImporter\Scrapers\InstagramScraper;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class InstagramSingleMediaImporter extends AInstagramMediaImporter
{
    public function importByURL($url)
    {
        $item = $this->instagramClient->getMedia((new InstagramScraper($url))->id());

        if(!$item){
            throw new RequestedDataNotFoundException("Requested media was not found");
        }

        if($item->meta->code != 200){
            throw new ImportException($item->meta->error_message);
        }

        return (new InstagramMediaAdapterFactoryMethod())->make($item->data->type, $item->data)->transform($this->mediaFactoryMethod);
    }
}