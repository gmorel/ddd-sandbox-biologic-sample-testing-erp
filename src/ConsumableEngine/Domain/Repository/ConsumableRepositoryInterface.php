<?php

namespace Api\ConsumableEngine\Domain\Repository;

use Api\ConsumableEngine\Domain\Entity\Consumable;

/**
 * Allow to save or find a Consumable Entity whatever the implementation (Doctrine, Propel, Redis, etc..)
 * @hint Domain needs to know a Consumable can be saved or found from a Repository
 *       But don't care about how it is implemented
 *       Hence only an interface is present in Domain
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
interface ConsumableRepositoryInterface
{
    /**
     * Find one Consumable by id
     * @param string $consumableId
     *
     * @return Consumable|null
     */
    public function find($consumableId);

    /**
     * Find one Consumable by name
     * @param string $consumableName
     *
     * @return Consumable|null
     */
    public function findOneByName($consumableName);

    /**
     * Save one Consumable
     * @param Consumable $consumable
     */
    public function save(Consumable $consumable);
}
