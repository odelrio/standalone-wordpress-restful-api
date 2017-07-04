<?php

namespace HyperWP\Domain\Model\Compatible;

use HyperWP\Domain\Model\Post;

class PostCompatV1 extends Post implements \JsonSerializable
{
    

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'date' => $this->dateLocal, // TODO: Format
            'date_gmt' => $this->dateGMT, // TODO: Format
            'guid' => [
                'rendered' => $this->guid
            ],
            'modified' => $this->modifiedDateLocal, // TODO: Format
            'modified_gmt' => $this->modifiedDateGMT, // TODO: Format
            'slug' => $this->name,
            'status' => $this->status,
            'type' => $this->type,
            'link' => '', // TODO: Set
            'title' => [
                'rendered' => $this->title
            ],
            'content' => [
                'rendered' => $this->content,
                'protected' => false // TODO: Set
            ],
            'excerpt' => [
                'rendered' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed ex metus. Nunc nibh eros, posuere ut tellus sit amet, venenatis interdum quam. Aliquam in consequat metus. Mauris a egestas ipsum. Vestibulum viverra, erat non condimentum molestie, dolor neque ullamcorper ipsum, vitae ultrices velit metus eget lacus. Aenean lorem massa, dictum convallis pulvinar eu, tempus &hellip; </p>\n<p class=\'link-more\'><a href=\'http =>//localhost =>8001/?p=12\' class=\'more-link\'>Continuar leyendo<span class=\'screen-reader-text\'> &#8220;Post 5&#8221;</span></a></p>\n',
                'protected' => false
            ],
            'author' => 1,
            'featured_media' => 0,
            'comment_status' => 'open',
            'ping_status' => 'open',
            'sticky' => false,
            'template' => '',
            'format' => 'standard',
            'meta' => []
        ];

    }
}