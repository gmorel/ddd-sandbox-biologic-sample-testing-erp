<?php

namespace Api\ConsumableEngine\Application\Exception;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class BiologicTestNotFoundException extends \Exception
{
    /** @var int */
    private $biologicTestId;

    /**
     * {@inheritDoc}
     * @param string $biologicTestId
     */
    public function __construct($message, $biologicTestId, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->biologicTestId = $biologicTestId;
    }

    /**
     * @param string $biologicTestId
     * @param int $code
     * @param Exception $previous
     * @return BiologicTestNotFoundException
     */
    public static function fromBiologicTestId($biologicTestId, $code = 0, \Exception $previous = null)
    {
        return new static(
            sprintf('Biologic Test #%s not found.', $biologicTestId),
            $biologicTestId,
            $code,
            $previous
        );
    }
}
