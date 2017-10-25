<?php
namespace Codenetix\SocialMediaImporter\Scrapers;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class InstagramScraper
{
    protected $content;

    function __construct($url)
    {
        $this->content = @file_get_contents($url);
    }

    public function image(){
        preg_match('#<meta +property=\\"og:image\\" +content=\\"(http.+?\.jpg)\\"#', $this->content, $result);
        return $result[1];
    }

    public function id(){
        preg_match('#<meta +property=\\"al:ios:url\\" +content=\\"instagram\\:\\/\\/media\\?id=([0-9]+)\\"#', $this->content, $result);
        return $result[1];
    }
}