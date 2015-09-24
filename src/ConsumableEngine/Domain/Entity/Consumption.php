<?php

namespace Api\ConsumableEngine\Domain\Entity;

use Api\Common\Domain\Quantity\BaseQuantity;
use Api\Common\Domain\Quantity\Unit;

/**
 * Consumption of one Consumable during a BiologicTest
 * @hint Entity
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class Consumption
{
    /** @var BiologicTest */
    private $biologicTest;

    /** @var Consumable */
    private $consumable;

    /** @var float */
    private $quantityAmount;

    /** @var string */
    private $quantityUnit;

    /**
     * @param BiologicTest $biologicTest
     * @param Consumable   $consumable
     * @param float        $quantityAmount
     * @param string       $quantityUnit
     */
    private function __construct(BiologicTest $biologicTest, Consumable $consumable, $quantityAmount, $quantityUnit)
    {
        $this->biologicTest = $biologicTest;
        $this->consumable = $consumable;
        $this->quantityAmount = $quantityAmount;
        $this->quantityUnit = $quantityUnit;
    }

    /**
     * @param Consumable   $consumable
     * @param BiologicTest $biologicTest
     * @param BaseQuantity $quantity
     *
     * @return $this
     */
    public static function consume(Consumable $consumable, BiologicTest $biologicTest, BaseQuantity $quantity)
    {
        return new self(
            $biologicTest,
            $consumable,
            $quantity->getBaseValue(),
            $quantity->getBaseUnit()->getValue()
        );
    }

    /**
     * @return BiologicTest
     */
    public function getConsumer()
    {
        return $this->biologicTest;
    }

    /**
     * @return Consumable
     */
    public function getConsumed()
    {
        return $this->consumable;
    }

    /**
     * @hint Try to model problem with as much Value Object as possible
     * @hint We store scalar in Database but we deal with Value Object
     * @see http://martinfowler.com/bliki/ValueObject.html
     *
     * @return BaseQuantity
     */
    public function getQuantityConsumed()
    {
        return new BaseQuantity(
            $this->quantityAmount,
            new Unit($this->quantityUnit)
        );
    }
}
