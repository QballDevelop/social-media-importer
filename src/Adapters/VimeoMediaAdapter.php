<?php
namespace Codenetix\SocialMediaImporter\Adapters;

use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use Codenetix\SocialMediaImporter\Support\TagsFromStringExtractor;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class VimeoMediaAdapter implements MediaAdapterInterface
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param MediaFactoryMethodInterface $mediaFactoryMethod
     * @return \Codenetix\SocialMediaImporter\Contracts\MediaInterface
     */
    public function transform(MediaFactoryMethodInterface $mediaFactoryMethod){
        $media = $mediaFactoryMethod->make();
        $media->setId($this->data->video_id);
        $media->setType('video');
        $media->setSourceType('vimeo');
        $media->setDescription($this->data->description);
        $media->setSourceURL('');
        $media->setThumbnailURL($this->data->thumbnail_url);
        $media->setTags(TagsFromStringExtractor::extract($media->getDescription()));
        return $media;
    }
}