<?php

namespace Api\ConsumableEngine\Domain\Entity;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class TestingMachine
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /**
     * @param string $id
     * @param string $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
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
}
