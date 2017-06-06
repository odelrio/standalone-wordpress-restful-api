<?php

namespace UnnamedProject\Domain\Model;

/**
 * PostMeta
 */
class PostMeta
{
    /**
     * @var integer
     */
    private $metaId;

    /**
     * @var integer
     */
    private $postId = '0';

    /**
     * @var string
     */
    private $metaKey;

    /**
     * @var string
     */
    private $metaValue;


    /**
     * Get metaId
     *
     * @return integer
     */
    public function getMetaId()
    {
        return $this->metaId;
    }

    /**
     * Set postId
     *
     * @param integer $postId
     *
     * @return PostMeta
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get postId
     *
     * @return integer
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set metaKey
     *
     * @param string $metaKey
     *
     * @return PostMeta
     */
    public function setMetaKey($metaKey)
    {
        $this->metaKey = $metaKey;

        return $this;
    }

    /**
     * Get metaKey
     *
     * @return string
     */
    public function getMetaKey()
    {
        return $this->metaKey;
    }

    /**
     * Set metaValue
     *
     * @param string $metaValue
     *
     * @return PostMeta
     */
    public function setMetaValue($metaValue)
    {
        $this->metaValue = $metaValue;

        return $this;
    }

    /**
     * Get metaValue
     *
     * @return string
     */
    public function getMetaValue()
    {
        return $this->metaValue;
    }
}

