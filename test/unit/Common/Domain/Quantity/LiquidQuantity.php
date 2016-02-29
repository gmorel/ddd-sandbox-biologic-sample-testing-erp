<?php

namespace Api\Test\Unit\Common\Domain\Quantity;

use mageekguy\atoum;
use Api\Common\Domain\Quantity\LiquidQuantity as SUT;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class LiquidQuantity extends atoum
{
    /**
     * @dataProvider microLiterProvider
     */
    public function test_construct_from_micro_liter($value, $expected, $unit)
    {
        // Given
        $quantity = SUT::fromMicroLiter($value);

        // When
        $actual = $quantity->getValue($unit);

        // Then
        $this->float($actual)->isEqualTo($expected);
    }

    public function microLiterProvider()
    {
        return array(
            array(42.99, 42.99, 'µl'),
            array(42.99, 0.04299, 'ml')
        );
    }

    /**
     * @dataProvider milliLiterProvider
     */
    public function test_construct_from_milli_liter($value, $expected, $unit)
    {
        // Given
        $quantity = SUT::fromMilliLiter($value);

        // When
        $actual = $quantity->getValue($unit);

        // Then
        $this->float($actual)->isEqualTo($expected);
    }

    public function milliLiterProvider()
    {
        return array(
            array(42.99, 42.99, 'ml'),
            array(42.99, 42990, 'µl')
        );
    }
}
