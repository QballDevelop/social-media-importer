<?php

namespace Codenetix\SocialMediaImporter\Contracts;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
interface MediaFactoryMethodInterface
{
    /**
     * @return MediaInterface
     */
    public function make();
}