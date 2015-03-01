<?php

namespace Api\Common\Domain\Quantity;

/**
 * BaseQuantity Value Object
 * @hint BaseQuantity Value Object will be used across BoundedContext
 *       Consequently we put it in Common Bounded Context
 * @hint Try to model problem with as much Value Object as possible
 * @see http://martinfowler.com/bliki/ValueObject.html
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class BaseQuantity
{
    /** @var float Base value (in µg, µl) */
    private $baseValue;

    /** @var Unit Base unit */
    private $baseUnit;

    /**
     * @param float $baseValue Base value (in µg, µl)
     * @param Unit  $baseUnit  Unit Base unit
     *
     * @throws \InvalidArgumentException Whenever $baseValue is invalid
     */
    public function __construct($baseValue, Unit $baseUnit)
    {
        $this->guardAgainstNonNuBasmericeValue($baseValue);
        $this->guardAgainstNegativeBaseValue($baseValue);

        $this->baseValue = $baseValue;
        $this->baseUnit = $baseUnit;
    }

    /**
     * Get Base value (in µg, µl)
     *
     * @return float
     */
    public function getBaseValue()
    {
        return $this->baseValue;
    }

    /**
     * Get base unit
     *
     * @return Unit
     */
    public function getBaseUnit()
    {
        return $this->baseUnit;
    }

    /**
     * @param $baseValue
     */
    private function guardAgainstNonNuBasmericeValue($baseValue)
    {
        if (false === is_numeric($baseValue)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Unable to construct a BaseQuantity from non numeric value. Received %s.',
                    $baseValue
                )
            );
        }
    }

    /**
     * @param $baseValue
     */
    private function guardAgainstNegativeBaseValue($baseValue)
    {
        if ($baseValue < 0) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Unable to construct a BaseQuantity from negative value. Received %s.',
                    $baseValue
                )
            );
        }
    }
}
