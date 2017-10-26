<?php
namespace Codenetix\SocialMediaImporter\FactoryMethods;

use Codenetix\SocialMediaImporter\Adapters\FacebookPhotoAdapter;
use Codenetix\SocialMediaImporter\Adapters\FacebookVideoAdapter;
use Codenetix\SocialMediaImporter\Contracts\MediaAdapterInterface;
use Codenetix\SocialMediaImporter\Exceptions\ImportException;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class FacebookMediaAdapterFactoryMethod
{

    /**
     * @param $type
     * @param $data
     * @return FacebookPhotoAdapter|FacebookVideoAdapter
     * @throws ImportException
     */
    public function make($type, $data){
        switch ($type){
            case 'video':
                return new FacebookVideoAdapter($data);
            case 'image':
                return new FacebookPhotoAdapter($data);
        }

        throw new ImportException("Unsupported media type " . $type);
    }
}