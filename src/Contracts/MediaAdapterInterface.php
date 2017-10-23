<?php

namespace Codenetix\SocialMediaImporter\Contracts;


/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
interface MediaAdapterInterface
{
    /**
     * @param MediaFactoryMethodInterface $mediaFactoryMethod
     * @return mixed
     */
    public function transform(MediaFactoryMethodInterface $mediaFactoryMethod);
}