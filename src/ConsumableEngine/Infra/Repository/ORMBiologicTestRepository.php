<?php

namespace Api\ConsumableEngine\Infra\Repository;

use Api\Common\Infra\Repository\AbstractDoctrineORMRepository;
use Api\ConsumableEngine\Domain\Entity\BiologicTest;
use Api\ConsumableEngine\Domain\Repository\BiologicTestRepositoryInterface;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class ORMBiologicTestRepository extends AbstractDoctrineORMRepository implements BiologicTestRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function find($biologicTestId)
    {
        return $this->getInternalRepository()->find($biologicTestId);
    }

    /**
     * {@inheritDoc}
     */
    public function findOneByName($biologicTestName)
    {
        return $this->getInternalRepository()->findOneBy(
            [
                'name' => $biologicTestName
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function save(BiologicTest $biologicTest)
    {
        $this->getEntityManager()->persist($biologicTest);
        $this->getEntityManager()->flush();
    }
}
