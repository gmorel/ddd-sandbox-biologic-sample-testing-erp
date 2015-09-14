<?php

namespace Api\ConsumableEngine\Domain\Entity;

use Api\Common\Domain\Quantity\BaseQuantity;
use Api\Common\Domain\Quantity\Unit;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class Consumable
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var float */
    private $deliveryThreshold;

    /** @var string */
    private $deliveryThresholdUnit;

    /** @var Supplier */
    private $supplier;

    /**
     * @param string       $id
     * @param string       $name
     * @param BaseQuantity $deliveryThreshold
     * @param Supplier     $supplier
     */
    public function __construct($id, $name, BaseQuantity $deliveryThreshold, Supplier $supplier)
    {
        $this->id = $id;
        $this->name = $name;

        $this->deliveryThreshold = $deliveryThreshold->getBaseValue();
        $this->deliveryThresholdUnit = $deliveryThreshold->getBaseUnit()->getValue();

        $this->supplier = $supplier;
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
     * Get threshold triggering a new Consumable delivery
     *
     * @return BaseQuantity
     */
    public function getDeliveryThreshold()
    {
        return new BaseQuantity(
            $this->deliveryThreshold,
            new Unit($this->deliveryThresholdUnit)
        );
    }

    /**
     * Get Supplier able to deliver this Consumable
     *
     * @return Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }
}
