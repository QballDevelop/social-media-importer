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

    public function testGetExternalVideoByLink()
    {
        $importer = new FacebookSingleMediaImporter($this->getAuthContext());
        $result = $importer->importByURL('https://www.facebook.com/rianru/videos/10156138991809271/');

        $this->assertNotEmpty($result);
    }

    private function getAuthContext(){
        return new AuthContext("1951790091754942", "2ff273ee11321b386a44e0e5d27cd42f", "EAAbvJIsYXb4BANFxRdah2N8eVxNnUYX4qBDhUVm4ioDEs35rxyLlKekwH9ISGzQ2fiLBZB3FRcIoxXEvHZBLc4mHxZAXw9ZBdxngHuBhBlZBC6ufU1d5CTkZAzVCLhTpnQhORHjSC3E5SGGbtPe0NdsyNNn7oYsqT29tTFWGerfkuVF6xUZCZAi7SakHZAfWejtvZABNVnycZBLRgZDZD");
    }
}
