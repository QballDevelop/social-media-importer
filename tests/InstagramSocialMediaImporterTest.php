<?php

namespace tests;

use Codenetix\SocialMediaImporter\Filters\MediaFilterByTags;
use Codenetix\SocialMediaImporter\Importers\InstagramMediaByIdImporter;
use Codenetix\SocialMediaImporter\Importers\InstagramPhotosImporter;
use Codenetix\SocialMediaImporter\Importers\InstagramSingleMediaImporter;
use Codenetix\SocialMediaImporter\Importers\InstagramVideosImporter;
use Codenetix\SocialMediaImporter\Support\AuthContext;
use PHPUnit\Framework\TestCase;

class InstagramSocialMediaImporterTest extends TestCase
{
    public function testMediasByTagsBasic()
    {
        $tags = ['lol', 'kek', 'hi'];
        $importer = new InstagramVideosImporter($this->getAuthContext());
        $result = (new MediaFilterByTags())->filter($importer->import(), $tags);

        $this->assertNotEmpty($result);
    }

    public function testPhotosByTagsBasic()
    {
        $tags = ['lol', 'kek', 'hi'];
        $importer = new InstagramPhotosImporter($this->getAuthContext());
        $result = (new MediaFilterByTags())->filter($importer->import(), $tags);

        $this->assertNotEmpty($result);
    }

    public function testGetMediaByLink()
    {
        $importer = new InstagramSingleMediaImporter($this->getAuthContext());
        $result = $importer->importByURL('https://www.instagram.com/p/Ba30IBkDXZ7');
        $this->assertNotEmpty($result);
    }

    /**
     * @expectedException Codenetix\SocialMediaImporter\Exceptions\WrongInputURLException
     */
    public function testWrongParam()
    {
        $importer = new InstagramSingleMediaImporter($this->getAuthContext());
        $importer->importByURL('https://www.instagram.com/wrong');
    }

    /**
     * @expectedException Codenetix\SocialMediaImporter\Exceptions\WrongInputURLException
     */
    public function testWrongParam2()
    {
        $importer = new InstagramSingleMediaImporter($this->getAuthContext());
        $importer->importByURL('https://www.instagram.com/p/123/222');
    }

    private function getAuthContext(){
        return new AuthContext("d884891f66cf4474bae74d3ecfc6d2d8", "3cf1f3200eb047658cc74e7c86d906cf", "6243398502.d884891.aefeffe2b53a436f8bfed78653c35c82");
    }
}
