<?php

namespace Codenetix\SocialMediaImporter\Importers;

use Codenetix\SocialMediaImporter\Contracts\MediaFactoryMethodInterface;
use Codenetix\SocialMediaImporter\Contracts\MediaImporterInterface;
use Codenetix\SocialMediaImporter\FactoryMethods\MediaFactoryMethod;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
abstract class AMediaImporter implements MediaImporterInterface
{
    private $callbacks;

    /**
     * @var MediaFactoryMethodInterface
     */
    protected $mediaFactoryMethod;

    public function __construct($mediaFactoryMethod = null)
    {
        if(!$mediaFactoryMethod){
            $this->mediaFactoryMethod = new MediaFactoryMethod();
        }
    }

    protected function invokeEvent($event, $params)
    {
        if(isset($this->callbacks[$event]) && is_callable($this->callbacks[$event])){
            $this->callbacks[$event]($params);
        }
    }

    public function onStart($callback)
    {
        $this->callbacks['start'] = $callback;
    }

    public function onProgress($callback)
    {
        $this->callbacks['progress'] = $callback;
    }

    public function onResult($callback)
    {
        $this->callbacks['result'] = $callback;
    }

    public function onError($callback)
    {
        $this->callbacks['error'] = $callback;
    }
}