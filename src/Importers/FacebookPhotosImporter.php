<?php

namespace Codenetix\SocialMediaImporter\Importers;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class FacebookPhotosImporter extends AFacebookBulkMediaImporter
{
    protected function getURL()
    {
        return '/me/photos/uploaded?fields=name,images,id';
    }

    protected function getType()
    {
        return 'image';
    }
}