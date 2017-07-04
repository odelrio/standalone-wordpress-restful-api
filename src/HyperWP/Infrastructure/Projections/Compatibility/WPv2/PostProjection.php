<?php

namespace HyperWP\Infrastructure\Projections\Compatibility\WPv2;

use DateTimeImmutable;
use HyperWP\Domain\Model\Author;
use HyperWP\Domain\Model\Post;
use HyperWP\Domain\Model\Term;

class PostProjection
{
    /** @var int */
    public $id;
    /** @var string */
    public $date;
    /** @var string */
    public $date_gmt;
    /** @var \stdClass */
    public $guid;
    /** @var string */
    public $modified;
    /** @var string */
    public $modified_gmt;
    /** @var string */
    public $slug;
    /** @var string */
    public $status;
    /** @var string */
    public $type;
    /** @var string */
    public $link;
    /** @var \stdClass */
    public $title;
    /** @var \stdClass */
    public $content;
    /** @var \stdClass */
    public $excerpt;
    /** @var int */
    public $author;
    /** @var int */
    public $featured_media;
    /** @var string */
    public $comment_status;
    /** @var string */
    public $ping_status;
    /** @var boolean */
    public $sticky;
    /** @var string */
    public $template;
    /** @var string */
    public $format;
    /** @var int */
    public $meta;
    /** @var array */
    public $categories;
    /** @var array */
    public $tags;

    /**
     * PostProjection constructor.
     *
     * @param Post $post
     * @param Term[] $categories
     * @param Term[] $tags
     */
    public function __construct(Post $post, array $categories, array $tags) {
        $this->id             = (int)$post->id;
        $this->date           = (new DateTimeImmutable($post->dateLocal))->format('Y-m-d\TH:i:s');
        $this->date_gmt       = (new DateTimeImmutable($post->dateGMT))->format('Y-m-d\TH:i:s');
        $this->guid           = new \stdClass();
        $this->guid->rendered = $post->guid;
        $this->modified       = (new DateTimeImmutable($post->modifiedDateLocal))->format('Y-m-d\TH:i:s');
        $this->modified_gmt   = (new DateTimeImmutable($post->modifiedDateGMT))->format('Y-m-d\TH:i:s');
        $this->slug           = $post->name;
        $this->status         = $post->status;
        $this->type           = $post->type;
        $this->link           = rtrim(WP_POST_URL, '/') . '/?p=' . $post->id;
        $this->title          = new \stdClass();
        $this->title->rendered = $post->title;
        $this->setContent($post);
        $this->excerpt        = new \stdClass();
        $this->excerpt->rendered = $post->excerpt;
        $this->excerpt->protected = (boolean)$post->isPasswordProtected;
        $this->author         = (int)$post->authorId;
        $this->featured_media = 0; // TODO: Get featured media
        $this->comment_status = $post->commentStatus;
        $this->ping_status = $post->pingStatus;
        $this->sticky         = false; // TODO: Get sticky
        $this->template       = ""; // TODO: Get template
        $this->format         = "standard"; // TODO: Get format
        $this->meta           = null; // TODO: Get meta

        foreach ($categories as $category) {
            $this->categories[] = (int)$category->id;
        }

        foreach ($tags as $tag) {
            $this->tags[] = (int)$tag->id;
        }
    }

    private function setContent($post)
    {
        $this->content = new \stdClass();
        $text = \HyperWP\Infrastructure\Wordpress\Functions::wpautop($post->content);

        $this->content->rendered = $text;
        $this->content->protected = (boolean)$post->isPasswordProtected;
    }
}