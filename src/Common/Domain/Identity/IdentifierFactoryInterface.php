<?php

namespace Api\Common\Domain\Identity;

/**
 * Allow creating UUID
 * @hint Having an Interface will ease unit test process
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
interface IdentifierFactoryInterface
{
    /**
     * Create Identifier
     *
     * @return string
     */
    public function create();
}
