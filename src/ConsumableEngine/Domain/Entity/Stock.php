<?php

namespace Api\ConsumableEngine\Domain\Entity;

use Api\Common\Domain\Quantity\BaseQuantity;
use Api\Common\Domain\Quantity\Unit;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class Stock
{
    /** @var string */
    private $id;

    /** @var float */
    private $quantityValue;

    /** @var string */
    private $quantityUnit;

    /** @var Consumable */
    private $consumable;

    /**
     * @param BaseQuantity $baseQuantity
     * @param Consumable   $consumable
     */
    public function __construct(BaseQuantity $baseQuantity, Consumable $consumable)
    {
        $this->quantityValue = $baseQuantity->getBaseValue();
        $this->quantityUnit = $baseQuantity->getBaseUnit()->getValue();
        $this->consumable = $consumable;
    }

    /**
     * @return string
     */
    public function getQuantityValue()
    {
        return $this->quantityValue;
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
     * @return Consumable
     */
    public function getConsumable()
    {
        return $this->consumable;
    }
}
