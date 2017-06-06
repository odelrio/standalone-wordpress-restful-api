<?php

namespace UnnamedProject\Domain\Model;

/**
 * Terms
 */
class Terms
{
    /**
     * @var integer
     */
    private $termId;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $slug = '';

    /**
     * @var integer
     */
    private $termGroup = '0';


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
     * Set name
     *
     * @param string $name
     *
     * @return Terms
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Terms
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set termGroup
     *
     * @param integer $termGroup
     *
     * @return Terms
     */
    public function setTermGroup($termGroup)
    {
        $this->termGroup = $termGroup;

        return $this;
    }

    /**
     * Get termGroup
     *
     * @return integer
     */
    public function getTermGroup()
    {
        return $this->termGroup;
    }
}

