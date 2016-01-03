<?php

namespace Api\ConsumableEngine\Domain\Entity;

use Api\Common\Domain\Quantity\BaseQuantity;
use Api\Common\Domain\Quantity\Unit;

/**
 * Consumption of one type of Consumable during a BiologicTest
 * @hint Entity
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class Consumption
{
    /** @var BiologicTest */
    private $biologicTest;

    /** @var TestingMachine */
    private $testingMachine;

    /** @var Consumable */
    private $consumable;

    /** @var float */
    private $quantityValue;

    /** @var string */
    private $quantityUnit;

    /**
     * @param BiologicTest $biologicTest
     * @param TestingMachine $testingMachine
     * @param Consumable $consumable
     * @param BaseQuantity $quantity
     */
    public function __construct(BiologicTest $biologicTest, TestingMachine $testingMachine, Consumable $consumable, BaseQuantity $quantity)
    {
        $this->biologicTest = $biologicTest;
        $this->testingMachine = $testingMachine;
        $this->consumable = $consumable;
        $this->quantityValue = $quantity->getBaseValue();
        $this->quantityUnit = $quantity->getBaseUnit()->getValue();
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
            $this->quantityValue,
            new Unit($this->quantityUnit)
        );
    }
}
