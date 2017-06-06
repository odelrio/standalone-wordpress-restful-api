<?php

namespace UnnamedProject\Domain\Model;

/**
 * Users
 */
class Users
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $userLogin = '';

    /**
     * @var string
     */
    private $userPass = '';

    /**
     * @var string
     */
    private $userNicename = '';

    /**
     * @var string
     */
    private $userEmail = '';

    /**
     * @var string
     */
    private $userUrl = '';

    /**
     * @var \DateTime
     */
    private $userRegistered = '0000-00-00 00:00:00';

    /**
     * @var string
     */
    private $userActivationKey = '';

    /**
     * @var integer
     */
    private $userStatus = '0';

    /**
     * @var string
     */
    private $displayName = '';


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userLogin
     *
     * @param string $userLogin
     *
     * @return Users
     */
    public function setUserLogin($userLogin)
    {
        $this->userLogin = $userLogin;

        return $this;
    }

    /**
     * Get userLogin
     *
     * @return string
     */
    public function getUserLogin()
    {
        return $this->userLogin;
    }

    /**
     * Set userPass
     *
     * @param string $userPass
     *
     * @return Users
     */
    public function setUserPass($userPass)
    {
        $this->userPass = $userPass;

        return $this;
    }

    /**
     * Get userPass
     *
     * @return string
     */
    public function getUserPass()
    {
        return $this->userPass;
    }

    /**
     * Set userNicename
     *
     * @param string $userNicename
     *
     * @return Users
     */
    public function setUserNicename($userNicename)
    {
        $this->userNicename = $userNicename;

        return $this;
    }

    /**
     * Get userNicename
     *
     * @return string
     */
    public function getUserNicename()
    {
        return $this->userNicename;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     *
     * @return Users
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userUrl
     *
     * @param string $userUrl
     *
     * @return Users
     */
    public function setUserUrl($userUrl)
    {
        $this->userUrl = $userUrl;

        return $this;
    }

    /**
     * Get userUrl
     *
     * @return string
     */
    public function getUserUrl()
    {
        return $this->userUrl;
    }

    /**
     * Set userRegistered
     *
     * @param \DateTime $userRegistered
     *
     * @return Users
     */
    public function setUserRegistered($userRegistered)
    {
        $this->userRegistered = $userRegistered;

        return $this;
    }

    /**
     * Get userRegistered
     *
     * @return \DateTime
     */
    public function getUserRegistered()
    {
        return $this->userRegistered;
    }

    /**
     * Set userActivationKey
     *
     * @param string $userActivationKey
     *
     * @return Users
     */
    public function setUserActivationKey($userActivationKey)
    {
        $this->userActivationKey = $userActivationKey;

        return $this;
    }

    /**
     * Get userActivationKey
     *
     * @return string
     */
    public function getUserActivationKey()
    {
        return $this->userActivationKey;
    }

    /**
     * Set userStatus
     *
     * @param integer $userStatus
     *
     * @return Users
     */
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;

        return $this;
    }

    /**
     * Get userStatus
     *
     * @return integer
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     *
     * @return Users
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }
}

