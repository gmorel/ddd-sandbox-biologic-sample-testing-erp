<?php

namespace Api\Common\Domain\Event;

/**
 * Set an Entity as Aggregate Root
 * Meaning it is responsible for the Aggregate integrity
 * And for storing Domain Events to be fetched at once
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
interface AggregateRootInterface
{
    /**
     * Pull currently set Domain Events
     * And reset current stack
     * @return DomainEventInterface[]
     */
    public function pullDomainEvents();
}
