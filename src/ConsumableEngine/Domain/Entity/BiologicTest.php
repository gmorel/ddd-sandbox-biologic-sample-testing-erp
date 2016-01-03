<?php

namespace Api\ConsumableEngine\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class BiologicTest
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var ArrayCollection|Consumption[] */
    private $consumptions;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->consumptions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Consumption[]
     */
    public function getConsumptions()
    {
        return $this->consumptions;
    }
}
