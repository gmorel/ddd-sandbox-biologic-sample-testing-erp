<?php

namespace Api\ConsumableEngine\Domain\Entity;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class Supplier
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var \Doctrine\Common\Collections\ArrayCollection|Consumable[] */
    private $consumables;

    /**
     * @param int    $id
     * @param string $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;

        $this->consumables = [];
    }

    /**
     * @return int
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

    public function proposeConsumable(Consumable $consumable)
    {
        $this->consumables[] = $consumable;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|Consumable[]
     */
    public function getInventory()
    {
        return $this->consumables;
    }
}
