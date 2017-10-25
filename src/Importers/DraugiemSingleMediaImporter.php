<?php

namespace Codenetix\SocialMediaImporter\Importers;

use Codenetix\SocialMediaImporter\Entities\Media;
use Codenetix\SocialMediaImporter\Exceptions\ImportException;
use Codenetix\SocialMediaImporter\Exceptions\UnsupportedSourceTypeException;
use Codenetix\SocialMediaImporter\Scrapers\DraugiemScraper;
use Codenetix\SocialMediaImporter\Support\TagsFromStringExtractor;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class DraugiemSingleMediaImporter
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    private function modifyUrlToPublic($url)
    {
        preg_match('/^(https:\\/\\/(?:www)\\.draugiem\\.lv\\/)(?:[\w]*)\\/?(gallery\\/\\?pid=(?:[0-9]+))$/', $url, $result);
        return $result[1].$this->userId.'/'.$result[2];
    }

    public function importByURL($url)
    {
        $url = $this->modifyUrlToPublic($url);
        $id = $this->getIdFromURL($url);
        $description = (new DraugiemScraper($url))->description();
        $image = (new DraugiemScraper($url))->image();

        $item = $this->buildMediaObject($id, $description, $image, $url);
        return $item;
    }

    private function extractDataFromPreviewImage($url)
    {
        if (preg_match('/^https:\\/\\/vp([0-9]+)\\.ifrype\\.com\\/video\\/([0-9]+)\\/([0-9]+)\\/v1\\/([0-9]+)_0\\.jpg$/', $url, $result)) {
            return [
                'type' => 'video',
                'sourceType' => 'draugiem',
                'videoURL' => 'https://vp'.$result[1].'.ifrype.com/video/'.$result[2].'/'.$result[3].'/v1/' . $result[4] . '.mp4',
                'thumbnailURL' => $url
            ];
        } else if (preg_match('/^https:\\/\\/img\\.youtube\\.com\\/vi\\/(.+)\\/0\\.jpg$/', $url, $result)) {
            return [
                'type' => 'video',
                'sourceType' => 'youtube',
                'videoURL' => 'https://www.youtube.com/embed/' . $result[1],
                'thumbnailURL' => $url
            ];
        } else if(preg_match('/^https:\\/\\/(?:[a-z][0-9])+\\.ifrype\\.com\\/gallery/', $url, $result)){
            return [
                'type' => 'image',
                'sourceType' => 'draugiem'
            ];
        }

        throw new ImportException();
    }

    private function buildMediaObject($id, $description, $image, $url)
    {
        $data = $this->extractDataFromPreviewImage($image);

        if($data['type'] == 'image'){
            $item = new Media();
            $item->setId($id);
            $item->setType($data['type']);
            $item->setSourceType($data['sourceType']);
            $item->setDescription($description);
            $item->setThumbnailURL((new DraugiemScraper($url))->thumbnailImage());
            $item->setTags(TagsFromStringExtractor::extract($description));
            $item->setSourceURL($image);
        } else {
            $item = new Media();
            $item->setId($id);
            $item->setType($data['type']);
            $item->setSourceType($data['sourceType']);
            $item->setDescription($description);
            $item->setThumbnailURL($image);
            $item->setTags(TagsFromStringExtractor::extract($description));
            $item->setSourceURL($data['videoURL']);
        }

        return $item;
    }

    private function getIdFromURL($url)
    {
        preg_match('/^https:\\/\\/(?:www)?\\.draugiem\\.lv\\/(?:[\w]+)\\/gallery\\/\\?pid=([0-9]+)$/', $url, $result);
        return $result[1];
    }
}