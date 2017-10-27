<?php
namespace Codenetix\SocialMediaImporter\FactoryMethods;

use Codenetix\SocialMediaImporter\Adapters\InstagramPhotoAdapter;
use Codenetix\SocialMediaImporter\Adapters\InstagramVideoAdapter;
use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;
use Codenetix\SocialMediaImporter\Exceptions\ImportException;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class InstagramMediaAdapterFactoryMethod
{

    /**
     * @param $type
     * @param $data
     * @return InstagramPhotoAdapter|InstagramVideoAdapter
     * @throws ImportException
     */
    public function make($type, $data){
        switch ($type){
            case 'video':
                return new InstagramVideoAdapter($data);
            case 'image':
                return new InstagramPhotoAdapter($data);
        }

        throw new ImportException("Unsupported media type " . $type);
    }
}