<?php

namespace tests;

use Codenetix\SocialMediaImporter\Importers\VimeoSingleMediaImporter;
use PHPUnit\Framework\TestCase;

class VimeoSocialMediaImporterTest extends TestCase
{
    public function testGetMediaByLink()
    {
        $importer = new VimeoSingleMediaImporter();
        $result = $importer->importByURL('https://vimeo.com/189919038');
        $this->assertNotEmpty($result);
    }

    /**
     * @expectedException Codenetix\SocialMediaImporter\Exceptions\RequestedDataNotFoundException
     */
    public function testGetMediaByLinkWrong()
    {
        $importer = new VimeoSingleMediaImporter();
        $importer->importByURL('https://vimeo.com/189333919038');
    }

    public function testGetMediaByLink2()
    {
        $importer = new VimeoSingleMediaImporter();
        $result = $importer->importByURL('https://vimeo.com/189919038');
        $this->assertNotEmpty($result);
    }

}
