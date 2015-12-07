<?php

namespace Api\ConsumableEngine\Domain\Repository;

use Api\ConsumableEngine\Domain\Entity\Stock;

/**
 * Allow to save or find a Stock Entity whatever the implementation (Doctrine, Propel, Redis, etc..)
 * @hint Domain needs to know a Consumable can be saved or found from a Repository
 *       But don't care about how it is implemented
 *       Hence only an interface is present in Domain
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
interface StockRepositoryInterface
{
    /**
     * Find Stock
     * @return Stock|null
     */
    public function findStock();

    /**
     * Save Stock
     * @param Stock $stock
     */
    public function save(Stock $stock);
}
