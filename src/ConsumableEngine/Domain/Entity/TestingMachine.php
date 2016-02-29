<?php

namespace Api\ConsumableEngine\Domain\Entity;

use Api\Common\Domain\Quantity\BaseQuantity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class TestingMachine
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param BiologicTest $biologicTest
     * @param BaseQuantity $baseQuantity
     * @param Consumable $consumable
     * @return Consumption
     */
    public function isConsuming(BiologicTest $biologicTest, BaseQuantity $baseQuantity, Consumable $consumable)
    {
        $consumption = new Consumption(
            $biologicTest,
            $this,
            $consumable,
            $baseQuantity
        );

        $this->consumptions->add($consumption);

        return $consumption;
    }
}
