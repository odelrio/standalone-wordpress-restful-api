<?php

namespace UnnamedProject\Domain\Model;

/**
 * TermMeta
 */
class TermMeta
{
    /**
     * @var integer
     */
    private $metaId;

    /**
     * @var integer
     */
    private $termId = '0';

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
     * Set termId
     *
     * @param integer $termId
     *
     * @return TermMeta
     */
    public function setTermId($termId)
    {
        $this->termId = $termId;

        return $this;
    }

    /**
     * Get termId
     *
     * @return integer
     */
    public function getTermId()
    {
        return $this->termId;
    }

    /**
     * Set metaKey
     *
     * @param string $metaKey
     *
     * @return TermMeta
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
     * @return TermMeta
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

