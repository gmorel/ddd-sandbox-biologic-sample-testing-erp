<?php


namespace Api\ConsumableEngine\Domain\Event;

use Api\Common\Domain\Event\DomainEventInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event thrown whenever a Consumable runs out of stock.
 * @hint Can be catched in another Bounded Context responsible for the Delivery
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class ConsumableOutOfStockEvent extends Event implements DomainEventInterface
{
    /** @var string */
    private $consumableId;

    /**
     * @param string $consumableId
     */
    public function __construct($consumableId)
    {
        $this->consumableId = $consumableId;
    }

    /**
     * @return string
     */
    public function getConsumableId()
    {
        return $this->consumableId;
    }

    /**
     * {@inheritdoc}
     */
    public function getEventName()
    {
        return DomainEvents::CONSUMABLE_OUT_OF_STOCK;
    }
}
