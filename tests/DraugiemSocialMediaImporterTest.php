<?php

namespace tests;

use Codenetix\SocialMediaImporter\Importers\DraugiemBulkMediaImporter;
use Codenetix\SocialMediaImporter\Importers\DraugiemSingleMediaImporter;
use Codenetix\SocialMediaImporter\Support\AuthContext;
use PHPUnit\Framework\TestCase;

class DraugiemSocialMediaImporterTest extends TestCase
{
    public function testImport()
    {
        $importer = new DraugiemSingleMediaImporter($this->getAuthContext());
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
        $importer = new DraugiemSingleMediaImporter($this->getAuthContext());
        $result = $importer->importByURL('https://www.draugiem.lv/mbcdntx/gallery/?pid=443100307');

        $this->assertNotEmpty($result);
        $this->assertNotEmpty($result->getId());
        $this->assertNotEmpty($result->getSourceURL());
        $this->assertNotEmpty($result->getThumbnailURL());
        $this->assertEquals($result->getType(), 'image');
        $this->assertEquals($result->getSourceType(), 'picture');
    }

    public function testImport3()
    {
        $importer = new DraugiemSingleMediaImporter($this->getAuthContext());
        $result = $importer->importByURL('https://www.draugiem.lv/gallery/?pid=442938371');

        $this->assertNotEmpty($result);
        $this->assertNotEmpty($result->getId());
        $this->assertNotEmpty($result->getSourceURL());
        $this->assertNotEmpty($result->getThumbnailURL());
        $this->assertEquals($result->getType(), 'video');
        $this->assertEquals($result->getSourceType(), 'video');
    }

    public function testImport4()
    {
        $importer = new DraugiemSingleMediaImporter($this->getAuthContext());
        $result = $importer->importByURL('https://www.draugiem.lv/gallery/?pid=442936894');

        $this->assertNotEmpty($result);
        $this->assertNotEmpty($result->getId());
        $this->assertNotEmpty($result->getSourceURL());
        $this->assertNotEmpty($result->getThumbnailURL());
        $this->assertEquals($result->getType(), 'video');
        $this->assertEquals($result->getSourceType(), 'vimeo');
    }

    public function testImport5()
    {
        $importer = new DraugiemBulkMediaImporter($this->getAuthContext());
        $result = $importer->importByKeyword('lol');

        $this->assertNotEmpty($result);
    }

    private function getAuthContext(){
        return new AuthContext("15020678", "eda2742022d576d6601a780ed2566ca4", "b3baf5543ba92ce661fbaa8ca08a3a03");
    }
}
