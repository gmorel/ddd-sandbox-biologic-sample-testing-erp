<?php

namespace Api\ConsumableEngine\Domain\Entity;

use Api\Common\Domain\Quantity\BaseQuantity;
use Api\Common\Domain\Quantity\Unit;
use Api\ConsumableEngine\Domain\Event\ConsumableOutOfStockEvent;

/**
 * Value Object embedded directly by Doctrine
 * @see http://doctrine-orm.readthedocs.org/projects/doctrine-orm/en/latest/tutorials/embeddables.html
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class Stock
{
    /** @var float */
    private $quantityValue;

    /** @var string */
    private $quantityUnit;

    /** @var \DateTime|null */
    private $lastTimeReplenished;

    /** @var float */
    private $deliveryThresholdValue;

    /** @var string */
    private $deliveryThresholdUnit;

    /** @var bool */
    private $waitingToBeReplenished;

    /** @var Consumable */
    private $consumable;

    /**
     * @param Consumable $consumable
     * @param BaseQuantity $quantity
     * @param BaseQuantity $deliveryThreshold
     * @param \DateTime|null $lastTimeReplenished
     */
    public function __construct(Consumable $consumable, BaseQuantity $quantity, BaseQuantity $deliveryThreshold, \DateTime $lastTimeReplenished = null)
    {
        $this->consumable = $consumable;
        $this->quantityValue = $quantity->getBaseValue();
        $this->quantityUnit = $quantity->getBaseUnit()->getValue();

        $this->deliveryThresholdValue = $deliveryThreshold->getBaseValue();
        $this->deliveryThresholdUnit = $deliveryThreshold->getBaseUnit()->getValue();

        $this->lastTimeReplenished = $lastTimeReplenished;

        $this->guardAgainstInvalidBaseUnitDeliveryThreshold($quantity, $deliveryThreshold);
        $this->checkIfStockNeedsToBeReplenished();
    }

    /**
     * @param BaseQuantity $baseQuantityToConsume
     */
    public function consume(BaseQuantity $baseQuantityToConsume)
    {
        $this->guardAgainstInvalidBaseUnitAddition($baseQuantityToConsume);

        $this->guardAgainstConsumingNotExistingStock($baseQuantityToConsume);

        $this->quantityValue -= $baseQuantityToConsume->getBaseValue();

        $this->checkIfStockNeedsToBeReplenished();
    }

    /**
     * @param BaseQuantity $baseQuantityToReplenish
     */
    public function replenish(BaseQuantity $baseQuantityToReplenish)
    {
        $this->guardAgainstInvalidBaseUnitAddition($baseQuantityToReplenish);

        $this->quantityValue += $baseQuantityToReplenish->getBaseValue();

        $this->lastTimeReplenished = new \DateTime();

        $this->checkIfStockNeedsToBeReplenished();
    }

    /**
     * @return BaseQuantity
     */
    public function getBaseQuantity()
    {
        return new BaseQuantity(
            $this->quantityValue,
            new Unit($this->quantityUnit)
        );
    }

    /**
     * @return \DateTime|null
     */
    public function getLastTimeReplenished()
    {
        return $this->lastTimeReplenished;
    }

    /**
     * @param BaseQuantity $baseQuantity
     */
    private function guardAgainstInvalidBaseUnitAddition(BaseQuantity $baseQuantity)
    {
        if ($baseQuantity->getBaseUnit()->getValue() != $this->quantityUnit) {
            throw new \LogicException(
                sprintf(
                    'Unable to replenish stock of "%s" with a base quantity of "%s".',
                    (string) $this->getBaseQuantity(),
                    (string) $baseQuantity
                )
            );
        }
    }

    /**
     * @param BaseQuantity $quantity
     * @param BaseQuantity $deliveryThreshold
     */
    private function guardAgainstInvalidBaseUnitDeliveryThreshold(BaseQuantity $quantity, BaseQuantity $deliveryThreshold)
    {
        if ($quantity->getBaseUnit() != $deliveryThreshold->getBaseUnit()) {
            throw new \LogicException(
                sprintf(
                    'Unable to set a delivery threshold of "%s" for a stock of "%s".',
                    (string) $deliveryThreshold,
                    (string) $quantity
                )
            );
        }
    }

    /**
     * @param BaseQuantity $baseQuantityToConsume
     */
    private function guardAgainstConsumingNotExistingStock(BaseQuantity $baseQuantityToConsume)
    {
        if ($this->quantityValue - $baseQuantityToConsume->getBaseValue() < 0) {
            throw new \LogicException(
                sprintf(
                    'Unable to consume not existing stock of "%s" since only "%s" left.',
                    (string) $baseQuantityToConsume,
                    (string) $this->getBaseQuantity()
                )
            );
        }
    }

    private function checkIfStockNeedsToBeReplenished()
    {
        if ($this->quantityValue <= $this->deliveryThresholdValue) {
            $this->waitingToBeReplenished = true;

            $this->consumable->applyEvent(
                new ConsumableOutOfStockEvent($this->consumable->getId())
            );
        }
    }
}
