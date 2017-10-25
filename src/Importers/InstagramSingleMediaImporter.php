<?php

namespace Codenetix\SocialMediaImporter\Importers;
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
        return (new InstagramMediaAdapterFactoryMethod())->make($item->data->type, $item->data)->transform($this->mediaFactoryMethod);
    }
}