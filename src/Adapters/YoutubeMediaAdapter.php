<?php
namespace Codenetix\SocialMediaImporter\Adapters;

use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use Codenetix\SocialMediaImporter\Support\TagsFromStringExtractor;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class YoutubeMediaAdapter implements MediaAdapterInterface
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

        $media->setId($this->data->id);
        $media->setType('video');
        $media->setSourceType('youtube');
        $media->setDescription($this->data->snippet->description);
        $media->setSourceURL("https://www.youtube.com/embed/".$this->data->id);
        if(isset($this->data->snippet->thumbnails) && $this->data->snippet->thumbnails) {
            $media->setThumbnailURL($this->data->snippet->thumbnails->standard->url);
        }
        $media->setTags(TagsFromStringExtractor::extract($media->getDescription()));
        return $media;
    }
}