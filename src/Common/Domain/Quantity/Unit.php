<?php

namespace Api\Common\Domain\Quantity;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class Unit
{
    /** @var string */
    private $value;

    /**
     * @param string $value Unit value ex: mg, µl
     *
     * @throws \InvalidArgumentException When invalid value
     */
    public function __construct($value)
    {
        $this->guardAgainstInvalidValue($value);

        $this->value = $value;
    }

    /**
     * Value object value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     */
    private function guardAgainstInvalidValue($value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('Unable to create Unit from empty value.');
        }
    }
}
