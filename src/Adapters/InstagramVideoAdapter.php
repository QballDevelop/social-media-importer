<?php
namespace Codenetix\SocialMediaImporter\Adapters;

use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class InstagramVideoAdapter implements MediaAdapterInterface
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
        $video->setDescription(!empty($this->data->caption->text) ? $this->data->caption->text : '');
        $video->setSourceURL($this->data->videos->standard_resolution->url);
        $video->setThumbnailURL($this->data->images->low_resolution->url);
        $video->setSourceHTML('');
        $video->setTags($this->data->tags);
        return $video;
    }

}