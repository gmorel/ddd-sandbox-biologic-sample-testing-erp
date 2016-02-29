<?php

namespace Api\ConsumableEngine\Infra\Repository;

use Api\Common\Domain\Event\EventBusInterface;
use Api\Common\Infra\Repository\AbstractDoctrineORMRepository;
use Api\ConsumableEngine\Domain\Entity\Consumable;
use Api\ConsumableEngine\Domain\Repository\ConsumableRepositoryInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class ORMConsumableRepository extends AbstractDoctrineORMRepository implements ConsumableRepositoryInterface
{
    /** @var  EventBusInterface */
    private $eventBus;

    /**
     * {@inheritDoc}
     * @param EventBusInterface $eventBus
     */
    public function __construct(ManagerRegistry $managerRegistry, $entityFullClassName, EventBusInterface $eventBus)
    {
        parent::__construct($managerRegistry, $entityFullClassName);
        $this->eventBus = $eventBus;
    }

    /**
     * {@inheritDoc}
     */
    public function find($consumableId)
    {
        return $this->getInternalRepository()->find($consumableId);
    }

    /**
     * {@inheritDoc}
     */
    public function findOneByName($consumableName)
    {
        return $this->getInternalRepository()->findOneBy(
            [
                'name' => $consumableName
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function save(Consumable $consumable)
    {
        $this->getEntityManager()->persist($consumable);
        $this->getEntityManager()->flush();

        foreach ($consumable->pullDomainEvents() as $event) {
            $this->eventBus->publish($event);
        }
    }
}
