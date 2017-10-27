<?php

namespace tests;

use Codenetix\SocialMediaImporter\Filters\MediaFilterByTags;
use Codenetix\SocialMediaImporter\Importers\FacebookPhotosImporter;
use Codenetix\SocialMediaImporter\Importers\FacebookSingleMediaImporter;
use Codenetix\SocialMediaImporter\Importers\FacebookVideosImporter;
use Codenetix\SocialMediaImporter\Support\AuthContext;
use PHPUnit\Framework\TestCase;

class FacebookSocialMediaImporterTest extends TestCase
{
    public function testMediasByTagsBasic()
    {
        $tags = ['lol', 'kek', 'hi'];
        $importer = new FacebookVideosImporter($this->getAuthContext());
        $result = (new MediaFilterByTags())->filter($importer->import(), $tags);

        $this->assertNotEmpty($result);
    }

    public function testPhotosByTagsBasic()
    {
        $tags = ['lol', 'kek', 'hi'];

        $importer = new FacebookPhotosImporter($this->getAuthContext());
        $result = (new MediaFilterByTags())->filter($importer->import(), $tags);

        $this->assertNotEmpty($result);
    }

    public function testGetPhotoByLink()
    {
        $importer = new FacebookSingleMediaImporter($this->getAuthContext());
        $result = $importer->importByURL('https://www.facebook.com/photo.php?fbid=115169831950942');

        $this->assertNotEmpty($result);
    }

    public function testGetVideoByLink()
    {
        $importer = new FacebookSingleMediaImporter($this->getAuthContext());
        $result = $importer->importByURL('https://www.facebook.com/vorobivka/videos/1179647665503148');

        $this->assertNotEmpty($result);
    }

    /**
     * @expectedException Codenetix\SocialMediaImporter\Exceptions\ImportException
     */
    public function testWrongAuthToken()
    {
        $importer = new FacebookSingleMediaImporter($this->getWrongAuthContext());
        $importer->importByURL('https://www.facebook.com/rianru/videos/20156138991809271');
    }

    public function testGetExternalVideoByLink()
    {
        $importer = new FacebookSingleMediaImporter($this->getAuthContext());
        $result = $importer->importByURL('https://www.facebook.com/rianru/videos/10156138991809271/');

        $this->assertNotEmpty($result);
    }

    /**
     * @expectedException Codenetix\SocialMediaImporter\Exceptions\WrongInputURLException
     */
    public function testWrongParam()
    {
        $importer = new FacebookSingleMediaImporter($this->getAuthContext());
        $importer->importByURL('https://www.facebook.com/videos/10156138991809271');
    }

    /**
     * @expectedException Codenetix\SocialMediaImporter\Exceptions\WrongInputURLException
     */
    public function testWrongParam2()
    {
        $importer = new FacebookSingleMediaImporter($this->getAuthContext());
        $importer->importByURL('https://www.facebook.com/rianru/images/videos/10156138991809271/');
    }

    /**
     * @expectedException Codenetix\SocialMediaImporter\Exceptions\WrongInputURLException
     */
    public function testWrongParam3()
    {
        $importer = new FacebookSingleMediaImporter($this->getAuthContext());
        $importer->importByURL('https://www.facebook.com/rianru/videos');
    }

    /**
     * @expectedException Codenetix\SocialMediaImporter\Exceptions\ImportException
     */
    public function testWrongID()
    {
        $importer = new FacebookSingleMediaImporter($this->getAuthContext());
        $importer->importByURL('https://www.facebook.com/rianru/videos/1111ab');
    }

    private function getWrongAuthContext(){
        return new AuthContext("1951790091754942", "2ff273ee11321b386a44e0e5d27cd42f", "AEAAbvJIsYXb4BAMnLh5va9MSAVgTAPWvXmcaJkVk38PZC31FEHCOZCyIdoS7wzL5j30rvEW4NIsowX1klsQcMf97ILl6F8vZB0WuZA07ZBN6pXnfrZBC49navJyaOrxDpKgCjjusytWXLJI9elxHRvrZCGBxfQ2wjisQRs0ZA0GQrZC5zfGxceFQDhqsUyf8PQxJvrwmPKgQAGRAZDZD");
    }

    private function getAuthContext(){
        return new AuthContext("1951790091754942", "2ff273ee11321b386a44e0e5d27cd42f", "EAAbvJIsYXb4BAMnLh5va9MSAVgTAPWvXmcaJkVk38PZC31FEHCOZCyIdoS7wzL5j30rvEW4NIsowX1klsQcMf97ILl6F8vZB0WuZA07ZBN6pXnfrZBC49navJyaOrxDpKgCjjusytWXLJI9elxHRvrZCGBxfQ2wjisQRs0ZA0GQrZC5zfGxceFQDhqsUyf8PQxJvrwmPKgQAGRAZDZD");
    }
}
