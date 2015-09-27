<?php


namespace Api\Common\Infra\Identity;

use Api\Common\Domain\Identity\IdentifierFactoryInterface;
use Rhumsaa\Uuid\Uuid;


/**
 * Wrap ramsey/uuid lib to create UUID
 *
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class UniversallyUniqueIdentifierFactory implements IdentifierFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return Uuid::uuid1()->toString();
    }
}
