<?php

namespace Api\Common\Domain\Event;

/**
 * Domain Event which can be intercepted by any Domain Listener
 * @hint Can easily assist in doing asynchronous
 * @hint Can be used for Event Sourcing
 * @hint Assist in communicating between Bounded Context
 *
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
interface DomainEventInterface
{
    /**
     * Event name (ex: consumable.out_of_stock)
     *
     * @return string
     */
    public function getEventName();
}
