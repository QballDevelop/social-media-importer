<?php
namespace Codenetix\SocialMediaImporter\Adapters;

use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use Codenetix\SocialMediaImporter\Support\TagsFromStringExtractor;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class DraugiemMediaAdapter implements MediaAdapterInterface
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
        $media->setId($this->data['id']);
        $media->setType($this->data['type'] == 'picture' ? 'image' : 'video');
        $media->setSourceType($this->data['type']);
        $media->setDescription(!empty($this->data['description']) ? $this->data['description'] : '');
        $media->setSourceURL($this->data['url']);
        $media->setThumbnailURL($this->data['thumbnail']);
        $media->setTags(TagsFromStringExtractor::extract($media->getDescription()));
        return $media;
    }
}