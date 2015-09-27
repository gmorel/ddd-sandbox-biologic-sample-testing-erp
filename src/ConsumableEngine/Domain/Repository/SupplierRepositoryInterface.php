<?php

namespace Api\ConsumableEngine\Domain\Repository;

use Api\ConsumableEngine\Domain\Entity\Supplier;

/**
 * Allow to save or find a Supplier Entity whatever the implementation (Doctrine, Propel, Redis, etc..)
 * @hint Domain needs to know a Supplier can be saved or found from a Repository
 *       But don't care about how it is implemented
 *       Hence only an interface is present in Domain
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
interface SupplierRepositoryInterface
{
    /**
     * Find one Supplier by id
     * @param string $supplierId
     *
     * @return Supplier|null
     */
    public function find($supplierId);

    /**
     * Find one Supplier by name
     * @param string $supplierName
     *
     * @return Supplier|null
     */
    public function findOneByName($supplierName);

    /**
     * Save one Supplier
     * @param Supplier $supplier
     */
    public function save(Supplier $supplier);
}
