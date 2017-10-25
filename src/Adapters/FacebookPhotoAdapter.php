<?php
namespace Codenetix\SocialMediaImporter\Adapters;

use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use Codenetix\SocialMediaImporter\Support\TagsFromStringExtractor;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class FacebookPhotoAdapter implements MediaAdapterInterface
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
        $video->setId($this->data['id']);
        $video->setType('image');
        $video->setSourceType('facebook');
        $video->setDescription(!empty($this->data['name']) ? $this->data['name'] : '');
        $video->setSourceURL($this->data['webp_images'][0]);
        $video->setThumbnailURL($this->data['webp_images'][count($this->data['webp_images'])-1]);
        $video->setTags(TagsFromStringExtractor::extract($video->getDescription()));
        return $video;
    }
}