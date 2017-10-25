<?php

namespace Codenetix\SocialMediaImporter\Importers;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class FacebookVideosImporter extends AFacebookBulkMediaImporter
{

    protected function getURL()
    {
        return '/me/videos/uploaded?fields=description,source,id,thumbnails,embed_html';
    }

    protected function getType()
    {
        return 'video';
    }
}