<?php

namespace Api\ConsumableEngine\Domain\Repository;

use Api\ConsumableEngine\Domain\Entity\BiologicTest;

/**
 * Allow to save or find a BiologicTest Entity whatever the implementation (Doctrine, Propel, Redis, etc..)
 * @hint Domain needs to know a BiologicTest can be saved or found from a Repository
 *       But don't care about how it is implemented
 *       Hence only an interface is present in Domain
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
interface BiologicTestRepositoryInterface
{
    /**
     * Find one BiologicTest by id
     * @param string $biologicTestId
     *
     * @return BiologicTest|null
     */
    public function find($biologicTestId);

    /**
     * Find one BiologicTest by name
     * @param string $biologicTestName
     *
     * @return BiologicTest|null
     */
    public function findOneByName($biologicTestName);

    /**
     * Save one BiologicTest
     * @param BiologicTest $biologicTest
     */
    public function save(BiologicTest $biologicTest);
}
