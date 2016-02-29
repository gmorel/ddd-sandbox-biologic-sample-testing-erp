<?php


namespace Api\ConsumableEngine\UI\Response\DataTransferObject;

use Api\Common\UI\DataTransferObject\JsonSerializableInterface;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class LaunchedBiologicTestPayload implements JsonSerializableInterface
{
    /** @var string */
    private $rootNodeName;

    /** @var string */
    private $biologicTestId;

    /** @var int */
    private $numberOfUsedTube;

    /** @var \DateTime */
    private $launchedAt;

    /**
     * @param string    $rootNodeName
     * @param string    $biologicTestId
     * @param int       $numberOfUsedTube
     * @param \DateTime $launchedAt
     */
    public function __construct($rootNodeName, $biologicTestId, $numberOfUsedTube, \DateTime $launchedAt)
    {
        $this->rootNodeName = $rootNodeName;
        $this->biologicTestId = $biologicTestId;
        $this->numberOfUsedTube = $numberOfUsedTube;
        $this->launchedAt = $launchedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return [
            $this->rootNodeName => [
                'biologic_test_id' => $this->biologicTestId,
                'number_of_used_tube' => (float) $this->numberOfUsedTube,
                'launched_at_utc' => $this->launchedAt->format(JsonSerializableInterface::FORMAT_DATE_TIME),
            ]
        ];
    }
}
