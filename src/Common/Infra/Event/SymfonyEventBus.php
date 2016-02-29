<?php

namespace Api\Common\Infra\Event;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Api\Common\Domain\Event\EventBusInterface;
use Api\Common\Domain\Event\DomainEventInterface;

/**
 * Dispatch Domain Events using Symfony Event Dispatcher
 * @author Timothée Barray <tim@verylastroom.com>
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class SymfonyEventBus implements EventBusInterface
{
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    public function __construct(EventDispatcherInterface $eventDispatcher, LoggerInterface $logger)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function publish(DomainEventInterface $event)
    {
        $this->logEvent($event);
        $eventName = $event->getEventName(); // We are not using SF2 Event::getName() as deprecated
        $this->eventDispatcher->dispatch($eventName, $event);
    }

    /**
     * @param DomainEventInterface $event
     */
    private function logEvent($event)
    {
        $refEvent = new \ReflectionClass($event);
        $refEventProperties = $refEvent->getProperties();
        $logContext = [];

        foreach ($refEventProperties as $property) {
            $propertyName = $property->getName();
            $getter = 'get'.ucfirst($propertyName);
            $propertyValue = $event->{$getter}();
            $logContext[$propertyName] = $this->convertPropertyValueAsString($propertyValue);
        }

        $this->logger->info($refEvent->getName(), $logContext);
    }

    /**
     * @param mixed $propertyValue
     * @return string
     */
    private function convertPropertyValueAsString($propertyValue)
    {
        if (true === is_array($propertyValue)) {
            return implode(', ', $propertyValue);
        }

        if ($propertyValue instanceof \DateTimeInterface) {
            return $propertyValue->format('Y-m-d H:i:s');
        }

        return (string) $propertyValue;
    }
}
