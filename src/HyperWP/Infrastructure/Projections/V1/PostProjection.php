<?php

namespace HyperWP\Infrastructure\Projections\V1;

use DateTimeImmutable;
use HyperWP\Domain\Model\Author;
use HyperWP\Domain\Model\Post;
use HyperWP\Domain\Model\Term;

class PostProjection
{
    /** @var int */
    public $id;
    /** @var string */
    public $guid;
    /** @var array */
    public $author;
    /** @var string */
    public $slug;
    /** @var string */
    public $type;
    /** @var string */
    public $status;
    /** @var string */
    public $date;
    /** @var int */
    public $timestamp;
    /** @var string */
    public $modifiedDate;
    /** @var int */
    public $modifiedTimestamp;
    /** @var string */
    public $title;
    /** @var string */
    public $content;
    /** @var string */
    public $excerpt;
    /** @var string */
    public $commentStatus;
    /** @var int */
    public $commentCount;
    /** @var array */
    public $tags = [];
    /** @var array */
    public $categories = [];

    /**
     * PostProjection constructor.
     *
     * @param Post $post
     * @param Author $author
     * @param Term[] $categories
     * @param Term[] $tags
     */
    public function __construct(Post $post, Author $author, array $categories, array $tags) {
        $this->id                = (int)$post->id;
        $this->guid              = $post->guid;
        $this->setAuthor($author);
        $this->slug              = $post->name;
        $this->type              = $post->type;
        $this->status            = $post->status;
        $this->date              = (new DateTimeImmutable($post->dateLocal))->format('D M d Y H:i:s O');
        $this->timestamp         = (new DateTimeImmutable($post->dateGMT))->getTimestamp();
        $this->modifiedDate      = (new DateTimeImmutable($post->modifiedDateLocal))->format('D M d Y H:i:s O');
        $this->modifiedTimestamp = (new DateTimeImmutable($post->modifiedDateGMT))->getTimestamp();
        $this->title             = $post->title;
        $this->content           = $post->content;
        $this->excerpt           = $post->excerpt;
        $this->commentStatus     = $post->commentStatus;
        $this->commentCount      = $post->commentCount;
        $this->setTerms($this->categories, $categories);
        $this->setTerms($this->tags, $tags);
    }

    private function setAuthor($author)
    {
        $this->author = [
            'id'            => (int)$author->id,
            'userName'      => $author->userName,
            'displayName'   => $author->displayName,
        ];
    }

    /**
     * @param \stdClass[] $attribute
     * @param Term[] $terms
     */
    private function setTerms(&$attribute, array $terms)
    {
        $projections = [];

        foreach ($terms as $term) {
            $termProjection =  new \stdClass();
            $termProjection->id = (int)$term->id;
            $termProjection->slug = $term->slug;
            $termProjection->name = $term->name;

            $projections[$term->id] = $termProjection;
        }

        $this->resolveTermParents($terms, $projections);

        $attribute = $projections;
    }

    /**
     * @param array $terms
     * @param $array
     */
    private function resolveTermParents(array $terms, &$array): void
    {
        foreach ($terms as $term) {
            $hasChildren = false;

            foreach ($terms as $otherTerm) {
                if ($otherTerm->parentId && $term->id === $otherTerm->parentId) {
                    $array[$otherTerm->id]->parent = $array[$term->id];
                    $hasChildren = true;
                }
            }

            if ($hasChildren) {
                unset($array[$term->id]);
            }
        }
    }
}