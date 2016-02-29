<?php

namespace Api\Common\Infra\Repository;

use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Ease Doctrine ORM Repository declaration
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
abstract class AbstractDoctrineORMRepository
{
    /** @var ManagerRegistry */
    private $managerRegistry;

    /** @var string */
    private $entityFullClassName;

    /**
     * @param ManagerRegistry $managerRegistry     Get EntityManager from it
     * @param string          $entityFullClassName Class name with namespace
     */
    public function __construct(ManagerRegistry $managerRegistry, $entityFullClassName)
    {
        $this->managerRegistry = $managerRegistry;
        $this->entityFullClassName = $entityFullClassName;
    }

    /**
     * Prefer using this method instead of building internal repository in constructor
     * - Avoid Doctrine to load all mapping
     * - Avoid Doctrine to use a closed connection
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getInternalRepository()
    {
        return $this->getEntityManager()->getRepository($this->entityFullClassName);
    }

    /**
     * Get Doctrine EntityManager
     *
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->managerRegistry->getManager();
    }
}
