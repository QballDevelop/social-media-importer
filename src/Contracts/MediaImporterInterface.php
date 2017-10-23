<?php
namespace Codenetix\SocialMediaImporter\Contracts;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
interface MediaImporterInterface
{
    public function onStart($callback);
    public function onProgress($callback);
    public function onResult($callback);
    public function onError($callback);
    public function import();
}