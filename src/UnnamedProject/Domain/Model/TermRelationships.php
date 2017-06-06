<?php

namespace UnnamedProject\Domain\Model;

/**
 * TermRelationships
 */
class TermRelationships
{
    /**
     * @var integer
     */
    private $objectId = '0';

    /**
     * @var integer
     */
    private $termTaxonomyId = '0';

    /**
     * @var integer
     */
    private $termOrder = '0';


    /**
     * Set objectId
     *
     * @param integer $objectId
     *
     * @return TermRelationships
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return integer
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set termTaxonomyId
     *
     * @param integer $termTaxonomyId
     *
     * @return TermRelationships
     */
    public function setTermTaxonomyId($termTaxonomyId)
    {
        $this->termTaxonomyId = $termTaxonomyId;

        return $this;
    }

    /**
     * Get termTaxonomyId
     *
     * @return integer
     */
    public function getTermTaxonomyId()
    {
        return $this->termTaxonomyId;
    }

    /**
     * Set termOrder
     *
     * @param integer $termOrder
     *
     * @return TermRelationships
     */
    public function setTermOrder($termOrder)
    {
        $this->termOrder = $termOrder;

        return $this;
    }

    /**
     * Get termOrder
     *
     * @return integer
     */
    public function getTermOrder()
    {
        return $this->termOrder;
    }
}

