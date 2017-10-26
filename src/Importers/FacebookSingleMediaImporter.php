<?php

namespace Codenetix\SocialMediaImporter\Importers;

use Codenetix\SocialMediaImporter\Exceptions\ImportException;
use Codenetix\SocialMediaImporter\FactoryMethods\FacebookMediaAdapterFactoryMethod;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class FacebookSingleMediaImporter extends AFacebookMediaImporter
{
    public function importByURL($url)
    {
        $data = $this->getRequestDataFromURL($url);
        $item = $this->facebookClient->get($data['url'])->getDecodedBody();

        return (new FacebookMediaAdapterFactoryMethod())->make($data['type'], $item)->transform($this->mediaFactoryMethod);
    }

    private function getRequestDataFromURL($url){
        if(preg_match('#photo\\.php\\?fbid=([0-9]+)#', $url, $result)){
            return ['url' => $result[1].'?fields=name,source,id,images', 'type' => 'image'];
        } else if(preg_match('#videos\\/([0-9]+)#', $url, $result)){
            return ['url' => $result[1].'?fields=description,source,id,thumbnails,embed_html', 'type' => 'video'];
        }

        throw new ImportException();
    }
}