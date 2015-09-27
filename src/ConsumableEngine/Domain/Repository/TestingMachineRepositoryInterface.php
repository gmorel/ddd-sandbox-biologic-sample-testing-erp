<?php

namespace Api\ConsumableEngine\Domain\Repository;

use Api\ConsumableEngine\Domain\Entity\TestingMachine;

/**
 * Allow to save or find a TestingMachine Entity whatever the implementation (Doctrine, Propel, Redis, etc..)
 * @hint Domain needs to know a TestingMachine can be saved or found from a Repository
 *       But don't care about how it is implemented
 *       Hence only an interface is present in Domain
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
interface TestingMachineRepositoryInterface
{
    /**
     * Find one TestingMachine by id
     * @param string $testingMachineId
     *
     * @return TestingMachine|null
     */
    public function find($testingMachineId);

    /**
     * Find one TestingMachine by name
     * @param string $testingMachineName
     *
     * @return TestingMachine|null
     */
    public function findOneByName($testingMachineName);

    /**
     * Save one TestingMachine
     * @param TestingMachine $testingMachine
     */
    public function save(TestingMachine $testingMachine);
}
