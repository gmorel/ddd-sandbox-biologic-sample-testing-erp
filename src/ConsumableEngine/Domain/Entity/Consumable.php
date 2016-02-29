<?php

namespace Api\ConsumableEngine\Domain\Entity;

use Api\Common\Domain\Event\AggregateRootInterface;
use Api\Common\Domain\Event\DomainEventInterface;
use Api\Common\Domain\Quantity\BaseQuantity;
use Api\Common\Domain\Quantity\Unit;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class Consumable implements AggregateRootInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var Supplier */
    private $supplier;

    /** @var Stock */
    private $stock;

    /** @var DomainEventInterface[] */
    private $events = [];

    /** @var ArrayCollection|Consumption[] */
    private $consumptions;

    /**
     * @param string       $name
     * @param BaseQuantity $deliveryThreshold
     * @param Supplier     $supplier
     */
    public function __construct($name, BaseQuantity $deliveryThreshold, Supplier $supplier)
    {
        $this->name = $name;

        $this->deliveryThreshold = $deliveryThreshold->getBaseValue();
        $this->deliveryThresholdUnit = $deliveryThreshold->getBaseUnit()->getValue();

        $this->stock = new Stock(
            $this,
            new BaseQuantity(
                0,
                $deliveryThreshold->getBaseUnit()
            ),
            $deliveryThreshold
        );

        $this->supplier = $supplier;

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

    /**
     * @return Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * {@inheritdoc}
     */
    public function pullDomainEvents()
    {
        $events = $this->events;
        $this->events = array();

        return $events;
    }

    /**
     * Apply an event to the current Event stack
     * @param DomainEventInterface $event
     */
    public function applyEvent(DomainEventInterface $event)
    {
        $this->events[] = $event;
    }
}
