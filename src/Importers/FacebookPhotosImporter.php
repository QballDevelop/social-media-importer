<?php

namespace Codenetix\SocialMediaImporter\Importers;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class FacebookPhotosImporter extends AFacebookMediaImporter
{
    protected function getURL()
    {
        return '/me/photos/uploaded?fields=name,webp_images,id';
    }

    protected function getType()
    {
        return 'image';
    }
}