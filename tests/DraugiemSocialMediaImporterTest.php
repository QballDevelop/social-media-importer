<?php

namespace tests;

use Codenetix\SocialMediaImporter\Importers\DraugiemSingleMediaImporter;
use PHPUnit\Framework\TestCase;

class DraugiemSocialMediaImporterTest extends TestCase
{
    public function testImport()
    {
        $importer = new DraugiemSingleMediaImporter('andrewsparrow');
        $result = $importer->importByURL('https://www.draugiem.lv/gallery/?pid=442588627');

        $this->assertNotEmpty($result);
        $this->assertNotEmpty($result->getId());
        $this->assertNotEmpty($result->getSourceURL());
        $this->assertNotEmpty($result->getThumbnailURL());
        $this->assertEquals($result->getType(), 'video');
        $this->assertEquals($result->getSourceType(), 'youtube');
    }

    public function testImport2()
    {
        $importer = new DraugiemSingleMediaImporter('andrewsparrow');
        $result = $importer->importByURL('https://www.draugiem.lv/gallery/?pid=442938371');

        $this->assertNotEmpty($result);
        $this->assertNotEmpty($result->getId());
        $this->assertNotEmpty($result->getSourceURL());
        $this->assertNotEmpty($result->getThumbnailURL());
        $this->assertEquals($result->getType(), 'video');
        $this->assertEquals($result->getSourceType(), 'draugiem');
    }

    public function testImportPhoto()
    {
        $importer = new DraugiemSingleMediaImporter('andrewsparrow');
        $result = $importer->importByURL('https://www.draugiem.lv/gallery/?pid=442953373');

        $this->assertNotEmpty($result);
        $this->assertNotEmpty($result->getId());
        $this->assertNotEmpty($result->getSourceURL());
        $this->assertNotEmpty($result->getThumbnailURL());
        $this->assertEquals($result->getType(), 'image');
    }

    /**
     * @expectedException Codenetix\SocialMediaImporter\Exceptions\ImportException
     */
    public function testImportForeignPhoto()
    {
        $importer = new DraugiemSingleMediaImporter('andrewsparrow');
        $importer->importByURL('https://www.draugiem.lv/gallery/?pid=1111111');
    }

    /**
     * @expectedException Codenetix\SocialMediaImporter\Exceptions\ImportException
     */
    public function testImportForeignPhoto2()
    {
        $importer = new DraugiemSingleMediaImporter('lolkek');
        $importer->importByURL('https://www.draugiem.lv/gallery/?pid=1111111');
    }
}
