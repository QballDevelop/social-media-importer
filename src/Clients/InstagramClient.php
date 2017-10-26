<?php namespace Codenetix\SocialMediaImporter\Clients;

use Codenetix\SocialMediaImporter\Contracts\InstagramClientInterface;
use MetzWeb\Instagram\Instagram;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class InstagramClient extends Instagram implements InstagramClientInterface
{
    /**
     * Get media by its id
     *
     * @param integer $id                   Instagram media ID
     * @return mixed
     */
    public function getMedia($id) {
        return $this->_makeCall('media/' . $id, true);
    }
}