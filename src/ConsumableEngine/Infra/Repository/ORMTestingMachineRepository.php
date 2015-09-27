<?php

namespace Api\ConsumableEngine\Infra\Repository;

use Api\Common\Infra\Repository\AbstractDoctrineORMRepository;
use Api\ConsumableEngine\Domain\Entity\TestingMachine;
use Api\ConsumableEngine\Domain\Repository\TestingMachineRepositoryInterface;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class ORMTestingMachineRepository extends AbstractDoctrineORMRepository implements TestingMachineRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function find($testingMachineId)
    {
        return $this->getRepository()->find($testingMachineId);
    }

    /**
     * @inheritDoc
     */
    public function findOneByName($testingMachineName)
    {
        return $this->getRepository()->findOneBy(
            [
                'name' => $testingMachineName
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function save(TestingMachine $testingMachine)
    {
        $this->getEntityManager()->persist($testingMachine);
        $this->getEntityManager()->flush();
    }
}
