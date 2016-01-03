<?php

namespace Api\ConsumableEngine\Application;

use Api\ConsumableEngine\Application\Command\NotifyBiologicTestHasBeenLaunchedCommand;
use Api\ConsumableEngine\Application\Command\SetConsumableDeliveryThresholdCommand;
use Api\ConsumableEngine\Application\Exception\BiologicTestNotFoundException;
use Api\ConsumableEngine\Domain\Repository\BiologicTestRepositoryInterface;
use Api\ConsumableEngine\Domain\Repository\ConsumableRepositoryInterface;

/**
 * @hint Represents how each feature are orchestrated at a macro level
 *        Directly called by Controller / CLI / Event Listener / Command Bus
 *
 * @hint You should quickly know how BoundedContext features are orchestrated
 *        by looking at the BoundedContextX\App\Service class
 * @hint If this class becomes bigger and bigger this might be a metrics
 *        indicating that your Bounded Context could be slit into 2 (or more) Bounded Contexts
 * @hint Participate into trimming fat from controllers
 *        http://richardmiller.co.uk/2012/10/31/symfony2-trimming-fat-from-controllers
 *
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class Service
{
    /** @var BiologicTestRepositoryInterface */
    private $biologicTestRepository;

    /** @var ConsumableRepositoryInterface */
    private $consumableRepository;

    public function __construct(BiologicTestRepositoryInterface $biologicTestRepository, ConsumableRepositoryInterface $consumableRepository)
    {
        $this->biologicTestRepository = $biologicTestRepository;
        $this->consumableRepository = $consumableRepository;
    }

    /**
     * @hint A Service method shall return nothing
     *        See CQRS and QueryService Vs CommandService for ones that return something
     *        But since we address beginners here, it is out of this sandbox scope
     *        If you need to recover result prefer using a Repository for now
     * @param NotifyBiologicTestHasBeenLaunchedCommand $command
     *
     * @throws \Api\ConsumableEngine\Application\Exception\BiologicTestNotFoundException
     */
    public function notifyBiologicTestHasBeenLaunched(NotifyBiologicTestHasBeenLaunchedCommand $command)
    {
        $biologicTest = $this->biologicTestRepository->find($command->biologicTestId);

        $this->guardAgainstBiologicTestNotFound($command, $biologicTest);

        foreach ($biologicTest->getConsumptions() as $consumption) {
            $consumption->getConsumed()->getStock()->consume(
                $consumption->getQuantityConsumed()
            );

            // @hint Repository will call Event Bus with any Domain Event found
            //       Event Bus will then call Symfony Event Dispatcher
            //       These events will then be able to be intercepted by any Bounded Context
            $this->consumableRepository->save(
                $consumption->getConsumed()
            );
        }
    }

    public function setConsumableDeliveryThreshold(SetConsumableDeliveryThresholdCommand $command)
    {
        // @todo implement
    }

    /**
     * @param NotifyBiologicTestHasBeenLaunchedCommand $command
     * @param $biologicTest
     * @throws BiologicTestNotFoundException
     */
    private function guardAgainstBiologicTestNotFound(NotifyBiologicTestHasBeenLaunchedCommand $command, $biologicTest)
    {
        if (null === $biologicTest) {
            throw BiologicTestNotFoundException::fromBiologicTestId($command->biologicTestId);
        }
    }
}
