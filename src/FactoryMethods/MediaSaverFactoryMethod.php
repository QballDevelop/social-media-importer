<?php namespace SocialMediaImporter\FactoryMethods;

use SocialMediaImporter\Savers\PhotoSaver;
use SocialMediaImporter\Savers\VideoSaver;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class MediaSaverFactoryMethod
{
    public function make($media, $allowedTerms){
        switch ($media->getType()){
            case 'image':
                return new PhotoSaver($media, $allowedTerms);
            case 'video':
                return new VideoSaver($media, $allowedTerms);
        }
    }
}