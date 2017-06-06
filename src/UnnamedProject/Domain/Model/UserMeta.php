<?php

namespace UnnamedProject\Domain\Model;

/**
 * UserMeta
 */
class UserMeta
{
    /**
     * @var integer
     */
    private $umetaId;

    /**
     * @var integer
     */
    private $userId = '0';

    /**
     * @var string
     */
    private $metaKey;

    /**
     * @var string
     */
    private $metaValue;


    /**
     * Get umetaId
     *
     * @return integer
     */
    public function getUmetaId()
    {
        return $this->umetaId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserMeta
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set metaKey
     *
     * @param string $metaKey
     *
     * @return UserMeta
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
     * @return UserMeta
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

