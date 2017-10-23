<?php

namespace Codenetix\SocialMediaImporter\Support;


/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class TagsFromStringExtractor
{
    public static function extract($description)
    {
        if (preg_match_all('/#([\w]+)(?![\w])/i', $description, $matches)) {
            return $matches[1];
        }
        return [];
    }
}