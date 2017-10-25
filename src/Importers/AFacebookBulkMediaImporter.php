<?php

namespace Codenetix\SocialMediaImporter\Importers;
use Codenetix\SocialMediaImporter\FactoryMethods\FacebookMediaAdapterFactoryMethod;


/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
abstract class AFacebookBulkMediaImporter extends AFacebookMediaImporter
{
    protected abstract function getURL();

    protected abstract function getType();

    /**
     * @return array
     */
    public function import(){
        $edge = $this->facebookClient->get($this->getURL())->getGraphEdge();
        $videos = [];
        do {
            foreach ($edge as $edgeItem){
                array_push($videos, (new FacebookMediaAdapterFactoryMethod())->make($this->getType(), $edgeItem->asArray())->transform($this->mediaFactoryMethod));
            }
        } while($edge = $this->facebookClient->next($edge));

        return $videos;
    }
}