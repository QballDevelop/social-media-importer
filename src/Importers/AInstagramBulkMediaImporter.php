<?php

namespace Codenetix\SocialMediaImporter\Importers;
use Codenetix\SocialMediaImporter\FactoryMethods\InstagramMediaAdapterFactoryMethod;


/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
abstract class AInstagramBulkMediaImporter extends AInstagramMediaImporter
{
    protected abstract function getType();

    public function import(){
        $items = $this->instagramClient->getUserMedia('self');
        $result = [];
        do {
            foreach ($items->data as $item){
                if($item->type != $this->getType()){
                    continue;
                }
                array_push($result, (new InstagramMediaAdapterFactoryMethod())->make($this->getType(), $item)->transform($this->mediaFactoryMethod));
            }
        } while($items = $this->instagramClient->pagination($items));

        return $result;
    }
}