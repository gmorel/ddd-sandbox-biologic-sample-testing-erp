<?php

namespace Api\Test\Unit\Common\Domain\Quantity;

use mageekguy\atoum;
use Api\Common\Domain\Quantity\SolidQuantity as SUT;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class SolidQuantity extends atoum
{
    /**
     * @dataProvider microGrammeProvider
     */
    public function test_construct_from_micro_gramme($value, $expected, $unit)
    {
        // Given
        $quantity = SUT::fromMicroGramme($value);

        // When
        $actual = $quantity->getValue($unit);

        // Then
        $this->float($actual)->isEqualTo($expected);
    }

    public function microGrammeProvider()
    {
        return array(
            array(42.99, 42.99, 'µg'),
            array(42.99, 0.04299, 'mg')
        );
    }

    /**
     * @dataProvider milliGrammeProvider
     */
    public function test_construct_from_milli_liter($value, $expected, $unit)
    {
        // Given
        $quantity = SUT::fromMilliGramme($value);

        // When
        $actual = $quantity->getValue($unit);

        // Then
        $this->float($actual)->isEqualTo($expected);
    }

    public function milliGrammeProvider()
    {
        return array(
            array(42.99, 42.99, 'mg'),
            array(42.99, 42990, 'µg')
        );
    }
}
