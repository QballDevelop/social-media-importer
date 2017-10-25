<?php

namespace Codenetix\SocialMediaImporter\Entities;
use Codenetix\SocialMediaImporter\Contracts\MediaInterface;


/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class Media implements MediaInterface
{
    /**
     * @var string $id
     */
    private $id;

    /**
     * @var string $sourceType
     */
    private $sourceType;

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var string $sourceURL
     */
    private $sourceURL;

    /**
     * @var string $sourceHTML
     */
    private $sourceHTML;

    /**
     * @var string $thumbnailURL
     */
    private $thumbnailURL;

    /**
     * @var array $tags
     */
    private $tags;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Media
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSourceType()
    {
        return $this->sourceType;
    }

    /**
     * @param string $sourceType
     * @return Media
     */
    public function setSourceType($sourceType)
    {
        $this->sourceType = $sourceType;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Media
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Media
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getSourceURL()
    {
        return $this->sourceURL;
    }

    /**
     * @param string $sourceURL
     * @return Media
     */
    public function setSourceURL($sourceURL)
    {
        $this->sourceURL = $sourceURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getSourceHTML()
    {
        return $this->sourceHTML;
    }

    /**
     * @param string $sourceHTML
     * @return Media
     */
    public function setSourceHTML($sourceHTML)
    {
        $this->sourceHTML = $sourceHTML;
        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnailURL()
    {
        return $this->thumbnailURL;
    }

    /**
     * @param string $thumbnailURL
     * @return Media
     */
    public function setThumbnailURL($thumbnailURL)
    {
        $this->thumbnailURL = $thumbnailURL;
        return $this;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return Media
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }
}