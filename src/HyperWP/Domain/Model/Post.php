<?php

namespace HyperWP\Domain\Model;

class Post
{
    public $id;
    public $guid;
    public $parentId;
    public $authorId;
    public $name;
    public $type;
    public $mimeType;
    public $status;
    public $dateLocal;
    public $dateGMT;
    public $modifiedDateLocal;
    public $modifiedDateGMT;
    public $title;
    public $content;
    public $excerpt;
    public $commentStatus;
    public $commentCount;
    public $pingStatus;
    public $toPing;
    public $pinged;
    public $contentFiltered;
    public $menuOrder;
    public $isPasswordProtected;
}