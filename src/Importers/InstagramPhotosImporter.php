<?php

namespace Codenetix\SocialMediaImporter\Importers;
use Codenetix\FactoryMethods\Entities\InstagramMediaAdapterFactoryMethod;
use Codenetix\SocialMediaImporter\Support\AuthContext;
use MetzWeb\Instagram\Instagram;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class InstagramPhotosImporter extends AInstagramBulkMediaImporter
{
    protected function getType()
    {
        return 'image';
    }
}