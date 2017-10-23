<?php
namespace Codenetix\SocialMediaImporter\FactoryMethods;

use Codenetix\SocialMediaImporter\Adapters\InstagramPhotoAdapter;
use Codenetix\SocialMediaImporter\Adapters\InstagramVideoAdapter;
use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class InstagramMediaAdapterFactoryMethod
{

    /**
     * @param string$type
     * @param array $data
     * @return MediaAdapterInterface
     */
    public function make($type, $data){
        switch ($type){
            case 'video':
                return new InstagramVideoAdapter($data);
            case 'image':
                return new InstagramPhotoAdapter($data);
        }
    }
}