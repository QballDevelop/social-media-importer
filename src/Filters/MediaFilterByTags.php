<?php

namespace Codenetix\SocialMediaImporter\Filters;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class MediaFilterByTags
{
    /**
     * @param array $items
     * @param array $tags
     * @return array
     */
    public function filter($items, $tags)
    {
        return array_filter($items, function($v) use($tags) {
            return !empty(array_intersect($v->getTags(), $tags));
        });
    }
}