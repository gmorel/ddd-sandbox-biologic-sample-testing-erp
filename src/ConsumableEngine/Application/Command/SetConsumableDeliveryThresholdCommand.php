<?php

namespace Api\ConsumableEngine\Application\Command;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @hint This Command is not a Symfony CLI Command but a Command Pattern
 *        It's a DTO (Data Transfer Object) explicitly representing actor intention
 *        It represents all mandatory data necessary to notify that a Biologic Test has been launched
 *        Without exposing the HttpRequest useless for the domain
 * @hint Represents an entry point of the `ConsumableEngine` Bounded Context
 *        Whenever you want to know what the Bounded Context is responsible for
 *         1) Read the Bounded Context name, if well written it should be a good hint
 *         2) Look at all Commands on BoundedContextX/App/Command/ directory
 * @hint Your Bounded Context shall do nothing more than the listed Commands it contains
 * @hint Try to avoid setting default data here as it would obfuscate original actor intention
 * @hint No logic here it is a simple POPO containing simple scalar variables
 *        We are not in the Domain yet
 *        No setter either, intention shall be immutable
 *        However we still have public fields here
 *        As Command will be validated/hydrated by a SF2 FormType as easier/clearer
 * @hint For simplicity/readability we declare scalar validation (UI validation) directly in the Command
 * @hint Try to avoid setting default data here as it would obfuscate original actor intention
 * @see http://martinfowler.com/bliki/BoundedContext.html
 *
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class SetConsumableDeliveryThresholdCommand
{
    /**
     * Consumable id
     * @hint PHPDoc is detailed. But is that necessary ? Would only variable name suffice if well named ?
     * @var string
     * @Assert\NotBlank()
     */
    public $consumableId;

    /**
     * Threshold value
     * @var float
     * @Assert\NotBlank()
     * @Assert\Type("float")
     */
    public $thresholdValue;

    /**
     * @var string Threshold unit (µl|mg|..)
     * @Assert\NotBlank()
     */
    public $thresholdUnit;
}
