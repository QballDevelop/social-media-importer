<?php
namespace Codenetix\SocialMediaImporter\Adapters;

use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class InstagramPhotoAdapter implements MediaAdapterInterface
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
        $video = $mediaFactoryMethod->make();
        $video->setId($this->data->id);
        $video->setType('image');
        $video->setSourceType('instagram');
        $video->setDescription(!empty($this->data->caption->text) ? $this->data->caption->text : '');
        $video->setSourceURL($this->data->images->standard_resolution->url);
        $video->setThumbnailURL($this->data->images->low_resolution->url);
        $video->setSourceHTML($this->data->link);
        $video->setTags($this->data->tags);
        return $video;
    }

}