<?php

namespace Api\ConsumableEngine\Application\Command;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * This Command is not a Symfony CLI Command but a Command Pattern
 *        It's a DTO (Data Transfer Object) explicitly representing actor intention
 *        It represents all mandatory data necessary to notify that a Biologic Test has been launched
 *        Without exposing the HttpRequest useless for the domain
 * Represents an entry point of the `ConsumableEngine` Bounded Context
 *        Whenever you want to know what the Bounded Context is responsible for
 *         1) Read the Bounded Context name, if well written it should be a good hint
 *         2) Look at all Commands on BoundedContextX/Application/Command/ directory
 * Your Bounded Context shall do nothing more than the listed Commands it contains
 * No logic here it is a simple POPO containing simple scalar variables
 *        We are not in the Domain yet
 *        No setter either, intention shall be immutable
 *        However we still have public fields here
 *        As Command will be validated/hydrated by a SF2 FormType as easier/clearer
 * For simplicity/readability we declare scalar validation (UI validation) directly in the Command
 * Try to avoid setting default data here as it would obfuscate original actor intention
 *
 * @see http://martinfowler.com/bliki/BoundedContext.html
 *
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class NotifyBiologicTestHasBeenLaunchedCommand
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $biologicTestId;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    public $numberOfUsedTube;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    public $launchedAtUTC;
}
