<?php

namespace Api\Common\UI\DataTransferObject;

/**
 * Allow any object to be serialized
 *
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
interface JsonSerializableInterface
{
    const FORMAT_DATE_TIME = 'Y-m-d H:i:s';

    /**
     * @return array
     */
    public function serialize();
}
