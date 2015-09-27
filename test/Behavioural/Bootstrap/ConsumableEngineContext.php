<?php

namespace Api\Test\Behavioural\Bootstrap;

use Api\Common\Domain\Identity\IdentifierFactoryInterface;
use Api\ConsumableEngine\Domain\Entity\TestingMachine;
use Api\ConsumableEngine\Domain\Repository\TestingMachineRepositoryInterface;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class ConsumableEngineContext implements Context
{
    /** @var IdentifierFactoryInterface */
    private $identifierFactory;

    /** @var TestingMachineRepositoryInterface */
    private $testingMachineRepository;

    /**
     * Initializes context
     */
    public function __construct(IdentifierFactoryInterface $identifierFactory, TestingMachineRepositoryInterface $testingMachineRepository)
    {
        $this->identifierFactory = $identifierFactory;
        $this->testingMachineRepository = $testingMachineRepository;
    }

    /**
     * @Given a Testing Machine named :testingMachineName
     */
    public function aTestingMachineNamed($testingMachineName)
    {
        $testingMachineId = $this->identifierFactory->create();
        $testingMachine = new TestingMachine(
            $testingMachineId,
            $testingMachineName

        );

        $this->testingMachineRepository->save($testingMachine);
    }

    /**
     * @Given the Testing Machine named :machineName consuming ([0-9]+)(µl|ml) of :consumableName per test tube
     */
    public function theTestingMachineNamedConsumingUlOfPerTestTube($machineName, $quantity, $unit, $consumableName)
    {
        throw new PendingException();
    }

    /**
     * @Given the laboratory already having ([0-9]+)(µl|ml) of :consumableName in stock
     */
    public function theLaboratoryAlreadyHavingUlOfInStock($quantity, $unit, $consumableName)
    {
        throw new PendingException();
    }

    /**
     * @Given the laboratory always needing at least ([0-9]+)(µl|ml) of :consumableName
     */
    public function theLaboratoryAlwaysNeedingAtLeastMlOf($quantity, $unit, $consumableName)
    {
        throw new PendingException();
    }

    /**
     * @Given a supplier :supplierName providing :consumableName
     */
    public function aSupplierProviding($supplierName, $consumableName)
    {
        throw new PendingException();
    }

    /**
     * @When a(n) :biologicTestName is launched with ([0-9]+) test tubes?
     */
    public function aIsLaunchedWithTestTubes($biologicTestName, $nbTestTube)
    {
        throw new PendingException();
    }

    /**
     * @Then the supplier :supplierName should be contacted to replenish :consumableName stocks
     */
    public function theSupplierShouldBeContactedToReplenishStocks($supplierName, $consumableName)
    {
        throw new PendingException();
    }

    /**
     * @When a biologist launches a(n) :biologicTestName with ([0-9]+) test tubes?
     */
    public function someoneLaunchesAWithTestTube($biologicTestName, $nbTestTube)
    {
        throw new PendingException();
    }

    /**
     * @Then the supplier :supplierName should not be contacted to replenish :consumableName stocks
     */
    public function theSupplierShouldNotBeContactedToReplenishStocks($supplierName, $consumableName)
    {
        throw new PendingException();
    }

    /**
     * @When a biologist sets :consumableName delivery threshold at ([0-9]+)(µl|ml)
     */
    public function iSetDeliveryThresholdAtMl($consumableName, $quantity, $unit)
    {
        throw new PendingException();
    }

    /**
     * @Then the supplier :supplierName is set to replenish laboratory :consumableName stocks when bellow ([0-9]+)(µl|ml)
     */
    public function theSupplierIsSetToReplenishLaboratoryStocksWhenBellowMl($supplierName, $consumableName, $quantity, $unit)
    {
        throw new PendingException();
    }
}
