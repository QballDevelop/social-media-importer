<?php

namespace Codenetix\SocialMediaImporter\Contracts;


/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
interface MediaInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $id
     * @return Media
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getSourceType();

    /**
     * @param string $sourceType
     * @return Media
     */
    public function setSourceType($sourceType);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     * @return Media
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     * @return Media
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getSourceURL();

    /**
     * @param string $sourceURL
     * @return Media
     */
    public function setSourceURL($sourceURL);

    /**
     * @return string
     */
    public function getSourceHTML();

    /**
     * @param string $sourceHTML
     * @return Media
     */
    public function setSourceHTML($sourceHTML);

    /**
     * @return string
     */
    public function getThumbnailURL();
    /**
     * @param string $thumbnailURL
     * @return Media
     */
    public function setThumbnailURL($thumbnailURL);

    /**
     * @return array
     */
    public function getTags();

    /**
     * @param array $tags
     * @return Media
     */
    public function setTags($tags);
}