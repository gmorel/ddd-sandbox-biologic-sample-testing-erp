<?php

namespace Api\ConsumableEngine\Application;

use Api\ConsumableEngine\Application\Command\NotifyBiologicTestHasBeenLaunchedCommand;
use Api\ConsumableEngine\Application\Command\SetConsumableDeliveryThresholdCommand;

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
    public function notifyBiologicTestHasBeenLaunched(NotifyBiologicTestHasBeenLaunchedCommand $command)
    {
        // @todo implement
    }

    public function setConsumableDeliveryThreshold(SetConsumableDeliveryThresholdCommand $command)
    {
        // @todo implement
    }
}
