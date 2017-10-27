<?php
namespace Codenetix\SocialMediaImporter\Adapters;

use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use Codenetix\SocialMediaImporter\Support\TagsFromStringExtractor;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class FacebookVideoAdapter implements MediaAdapterInterface
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
        $video->setType('video');
        $video->setSourceType('facebook');
        $video->setDescription(!empty($this->data['description']) ? $this->data['description'] : '');
        $video->setSourceURL($this->data['source']);
        $video->setThumbnailURL(isset($this->data['thumbnails']['data'][0]['uri']) ? $this->data['thumbnails']['data'][0]['uri'] : $this->data['thumbnails'][0]['uri']);
        $video->setSourceHTML($this->data['embed_html']);
        $video->setTags(TagsFromStringExtractor::extract($video->getDescription()));
        return $video;
    }

}