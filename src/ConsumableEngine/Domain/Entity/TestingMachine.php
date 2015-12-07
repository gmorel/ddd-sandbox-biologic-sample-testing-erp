<?php

namespace Api\ConsumableEngine\Domain\Entity;

use Api\Common\Domain\Quantity\BaseQuantity;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class TestingMachine
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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
     * @param BaseQuantity $baseQuantity
     * @param Consumable   $consumable
     */
    public function isConsuming(BaseQuantity $baseQuantity, Consumable $consumable)
    {

    }
}
