<?php

namespace tests;

use Codenetix\SocialMediaImporter\Filters\MediaFilterByTags;
use Codenetix\SocialMediaImporter\Importers\FacebookPhotosImporter;
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

    private function getAuthContext(){
        return new AuthContext("1951790091754942", "2ff273ee11321b386a44e0e5d27cd42f", "EAAbvJIsYXb4BAAQAx9Wyhjuxvdi6sLIVgptMLbqlPhG9wXMzsZAoNk74g2uZACquB2nwZC32nrEqRtf1aYkHB7Nwu1FqECrrntnuFZCDsC3cJiXjkdElXhZAnAH9rZAZAnUzdZCDUiGzFntBOLjIXzwvgYR0s4pW6qnZC1aeaAS1NziQ9uIFxh6JEwcBxFoZAkE3CRCOtGYM0rjwZDZD");
    }
}
