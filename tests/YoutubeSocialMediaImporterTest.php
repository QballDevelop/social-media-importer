<?php

namespace tests;

use Codenetix\SocialMediaImporter\Filters\MediaFilterByTags;
use Codenetix\SocialMediaImporter\Importers\InstagramMediaByIdImporter;
use Codenetix\SocialMediaImporter\Importers\InstagramPhotosImporter;
use Codenetix\SocialMediaImporter\Importers\InstagramSingleMediaImporter;
use Codenetix\SocialMediaImporter\Importers\InstagramVideosImporter;
use Codenetix\SocialMediaImporter\Importers\YoutubeSingleMediaImporter;
use Codenetix\SocialMediaImporter\Support\AuthContext;
use PHPUnit\Framework\TestCase;

class YoutubeSocialMediaImporterTest extends TestCase
{
    public function testGetMediaByLink()
    {
        $importer = new YoutubeSingleMediaImporter();
        $result = $importer->importByURL('https://www.youtube.com/watch?v=TbLXpaTHbig');
        $this->assertNotEmpty($result);
    }

    public function testGetMediaByLink2()
    {
        $importer = new YoutubeSingleMediaImporter();
        $result = $importer->importByURL('https://www.youtube.com/embed/RVCTV8D_UaE');
        $this->assertNotEmpty($result);
    }
}
