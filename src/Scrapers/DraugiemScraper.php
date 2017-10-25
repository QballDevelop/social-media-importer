<?php
namespace Codenetix\SocialMediaImporter\Scrapers;
use Codenetix\SocialMediaImporter\Exceptions\AuthenticationException;
use GuzzleHttp\Client;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class DraugiemScraper
{
    protected $content;

    function __construct($url)
    {
        $client = new Client();
        $this->content = $client->get($url);

        if($this->hasLoginButton()){
            throw new AuthenticationException("Server returned login page");
        }
    }

    public function hasLoginButton(){
        preg_match('#id="loginSubmit"#', (string)$this->content->getBody(), $result);
        if(!empty($result))
        {
            return true;
        }
        return false;
    }

    public function description(){
        preg_match('#radius3bottom">(.*?)<div #', (string)$this->content->getBody(), $result);
        return $result[1];
    }

    public function image(){
        preg_match('#<meta +property=\\"og:image\\" +content=\\"(http.+?\.jpg)\\"#', (string)$this->content->getBody(), $result);
        return $result[1];
    }

    public function data(){
        preg_match('#var p = ({.+};)#', (string)$this->content->getBody(), $result);
        return $result[1];
    }

    public function thumbnailImage(){
        preg_match('/radius3" +src="(https:\/\/(?:[a-z][0-9])+\.ifrype\.com\/gallery\/(?:.*)\.jpg)" *?\/>/', (string)$this->content->getBody(), $result);
        return $result[1];
    }
}