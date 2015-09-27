<?php

namespace Api\ConsumableEngine\Infra\Repository;

use Api\Common\Infra\Repository\AbstractDoctrineORMRepository;
use Api\ConsumableEngine\Domain\Entity\Supplier;
use Api\ConsumableEngine\Domain\Repository\SupplierRepositoryInterface;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class ORMSupplierRepository extends AbstractDoctrineORMRepository implements SupplierRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function find($supplierId)
    {
        return $this->getRepository()->find($supplierId);
    }

    /**
     * @inheritDoc
     */
    public function findOneByName($supplierName)
    {
        return $this->getRepository()->findOneBy(
            [
                'name' => $supplierName
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function save(Supplier $supplier)
    {
        $this->getEntityManager()->persist($supplier);
        $this->getEntityManager()->flush();
    }
}
