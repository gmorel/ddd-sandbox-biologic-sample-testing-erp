<?php

namespace Api\ConsumableEngine\Infra\Repository;

use Api\Common\Infra\Repository\AbstractDoctrineORMRepository;
use Api\ConsumableEngine\Domain\Entity\Consumable;
use Api\ConsumableEngine\Domain\Repository\ConsumableRepositoryInterface;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class ORMConsumableRepository extends AbstractDoctrineORMRepository implements ConsumableRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function find($consumableId)
    {
        return $this->getRepository()->find($consumableId);
    }

    /**
     * @inheritDoc
     */
    public function findOneByName($consumableName)
    {
        return $this->getRepository()->findOneBy(
            [
                'name' => $consumableName
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function save(Consumable $consumable)
    {
        $this->getEntityManager()->persist($consumable);
        $this->getEntityManager()->flush();
    }
}
