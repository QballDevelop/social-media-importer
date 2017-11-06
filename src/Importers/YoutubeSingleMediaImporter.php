<?php

namespace Codenetix\SocialMediaImporter\Importers;

use Codenetix\SocialMediaImporter\Adapters\DraugiemMediaAdapter;
use Codenetix\SocialMediaImporter\Adapters\YoutubeMediaAdapter;
use Codenetix\SocialMediaImporter\Exceptions\ImportException;
use Codenetix\SocialMediaImporter\Exceptions\WrongInputURLException;
use Codenetix\SocialMediaImporter\FactoryMethods\MediaFactoryMethod;
use GuzzleHttp\Client;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class YoutubeSingleMediaImporter extends AMediaImporter
{

    private function checkURL($url)
    {
        if (preg_match('/^https:\/\/(?:www\.)?youtube\.com\/watch\?v=([^\?\&]+)/', $url, $result)) {
            return $result[1];
        }

        if (preg_match('/^https:\/\/(?:www\.)?youtube\.com\/embed\/([^\?\&]+)/', $url, $result)) {
            return $result[1];
        }

        if (preg_match('/^https:\/\/(?:www\.)?youtu\.be\/([^\?\&]+)/', $url, $result)) {
            return $result[1];
        }

        throw new WrongInputURLException("Wrong URL format");
    }

    public function importByURL($url)
    {
        $id = $this->checkURL($url);

        $client = new Client();
        $response = $client->get("https://www.googleapis.com/youtube/v3/videos?id=".$id."&key=AIzaSyAD5ZP54MuysK4fvzam1Iz4VRiX98V6kpY&fields=items(id,snippet(description), snippet(thumbnails(standard(url))))&part=snippet");
        $data = json_decode($response->getBody());

        if(!empty($data->error)){
            throw new ImportException($data->error->errors[0]->message);
        }

        return (new YoutubeMediaAdapter($data->items[0]))->transform($this->mediaFactoryMethod);
    }

}