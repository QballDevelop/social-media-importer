<?php
namespace Codenetix\SocialMediaImporter\FactoryMethods;

use Codenetix\SocialMediaImporter\Adapters\FacebookPhotoAdapter;
use Codenetix\SocialMediaImporter\Adapters\FacebookVideoAdapter;
use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaInterface;
use Codenetix\SocialMediaImporter\Entities\Media;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class MediaFactoryMethod implements MediaFactoryMethodInterface
{
    /**
     * @return Media
     */
    public function make(){
        return new Media();
    }
}