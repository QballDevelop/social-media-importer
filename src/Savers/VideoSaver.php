<?php namespace SocialMediaImporter\Savers;

use Codenetix\SocialMediaImporter\Contracts\MediaInterface;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class VideoSaver
{
    private $media;

    private $allowedTerms;

    /**
     * VideoSaver constructor.
     * @param MediaInterface $media
     * @param $allowedTerms
     */
    public function __construct(MediaInterface $media, $allowedTerms)
    {
        $this->media = $media;
        $this->allowedTerms = $allowedTerms;
    }

    private function makeId(){
        return 'import_video_' . $this->media->getId();
    }

    public function save(){
        $post = array(
            'post_title' => $this->makeId(),
            'post_content' => $this->media->getDescription(),
            'post_type' => $this->media->getType(),
            'post_author' => get_current_user_id(),
            'post_status' => 'publish',
            'comment_status' => 'open'
        );

        if($post_id = post_exists($this->makeId())){
            return $post_id;
        }

        $post_id = wp_insert_post($post, true);
        update_post_meta($post_id, 'video_url', _social_media_importer_build_embed_html($this->media->getSourceType(), $this->media->getSourceURL()));

        update_post_meta($post_id, 'raskin_published', 0);

        $attach_id = _social_media_importer_insert_attachment_from_url($this->media->getThumbnailURL(), $post_id);
        update_post_meta($post_id, '_thumbnail_id', $attach_id);

        $category = array_intersect($this->media->getTags(), $this->allowedTerms)[0];
        $category = get_term_by('slug', $category, 'categories');
        //set terms
        wp_set_post_terms($post_id, $category->term_id.','.$category->parent,'categories',true);

        return $post_id;
    }
}