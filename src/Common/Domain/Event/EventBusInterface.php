<?php

namespace Api\Common\Domain\Event;

/**
 * Dispatch Domain Events using the given Event Dispatcher
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
interface EventBusInterface
{
    /**
     * Publish stored Domain Event
     * @param DomainEventInterface $event
     */
    public function publish(DomainEventInterface $event);
}
