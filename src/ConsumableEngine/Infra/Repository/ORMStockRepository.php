<?php

namespace Api\ConsumableEngine\Infra\Repository;

use Api\Common\Infra\Repository\AbstractDoctrineORMRepository;
use Api\ConsumableEngine\Domain\Entity\Stock;
use Api\ConsumableEngine\Domain\Repository\StockRepositoryInterface;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class ORMStockRepository extends AbstractDoctrineORMRepository implements StockRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findStock()
    {
        return reset($this->getRepository()->findAll());
    }

    /**
     * @inheritDoc
     */
    public function save(Stock $stock)
    {
        $this->getEntityManager()->persist($stock);
        $this->getEntityManager()->flush();
    }
}
