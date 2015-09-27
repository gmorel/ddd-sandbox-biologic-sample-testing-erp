<?php

namespace Api\Test\Behavioural\Bootstrap;

use Api\Common\Domain\Identity\IdentifierFactoryInterface;
use Api\Common\Domain\Quantity\BaseQuantity;
use Api\Common\Domain\Quantity\Unit;
use Api\ConsumableEngine\Domain\Entity\Consumable;
use Api\ConsumableEngine\Domain\Entity\Supplier;
use Api\ConsumableEngine\Domain\Entity\TestingMachine;
use Api\ConsumableEngine\Domain\Repository\ConsumableRepositoryInterface;
use Api\ConsumableEngine\Domain\Repository\SupplierRepositoryInterface;
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

    /** @var ConsumableRepositoryInterface */
    private $consumableRepository;

    /** @var SupplierRepositoryInterface */
    private $supplierRepository;

    /**
     * Initializes Behat 3 context
     */
    public function __construct(IdentifierFactoryInterface $identifierFactory, TestingMachineRepositoryInterface $testingMachineRepository, ConsumableRepositoryInterface $consumableRepository, SupplierRepositoryInterface $supplierRepository)
    {
        $this->identifierFactory = $identifierFactory;
        $this->testingMachineRepository = $testingMachineRepository;
        $this->consumableRepository = $consumableRepository;
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @Given the Testing Machine named :testingMachineName consuming ([0-9]+)(µl|ml) of :consumableName per test tube
     */
    public function theTestingMachineNamedConsumingUlOfPerTestTube($testingMachineName, $quantity, $unit, $consumableName)
    {
        $testingMachine = $this->createTestingMachine($testingMachineName);
        if (null === $testingMachine) {
            $testingMachine = $this->testingMachineRepository->findOneByName($testingMachineName);
        }


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
     * @Given /the laboratory always needing at least ([0-9]+)(µl|ml) of \"([^\"]+)\" delivered by \"([^\"]+)\"/
     */
    public function theLaboratoryAlwaysNeedingAtLeastMlOfConsumable($quantity, $unit, $consumableName, $supplierName)
    {
        $supplier = $this->supplierRepository->findOneByName($supplierName);
        if (null === $supplier) {
            $supplier = $this->createSupplier($supplierName);
        }

        $consumable = $this->consumableRepository->findOneByName($consumableName);
        if (null === $consumable) {
            $consumable = $this->createConsumable($consumableName, $quantity, $unit, $supplier);
        }

        $this->consumableRepository->save($consumable);
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

    /**
     * @param string $supplierName
     *
     * @return Supplier
     */
    private function createSupplier($supplierName)
    {
        $supplierId = $this->identifierFactory->create();
        $supplier = new Supplier($supplierId, $supplierName);

        $this->supplierRepository->save($supplier);

        return $supplier;
    }

    /**
     * @param string   $consumableName
     * @param float    $deliveryThreshold
     * @param string   $deliveryThresholdUnit
     * @param Supplier $supplier
     *
     * @return Consumable
     */
    private function createConsumable($consumableName, $deliveryThreshold, $deliveryThresholdUnit, Supplier $supplier)
    {
        $consumableId = $this->identifierFactory->create();
        $consumable = new Consumable(
            $consumableId,
            $consumableName,
            new BaseQuantity(
                $deliveryThreshold,
                new Unit($deliveryThresholdUnit)
            ),
            $supplier
        );

        $this->consumableRepository->save($consumable);

        return $consumable;
    }

    /**
     * @param string $testingMachineName
     *
     * @return TestingMachine
     */
    private function createTestingMachine($testingMachineName)
    {
        $testingMachineId = $this->identifierFactory->create();
        $testingMachine = new TestingMachine(
            $testingMachineId,
            $testingMachineName
        );

        $this->testingMachineRepository->save($testingMachine);

        return $testingMachine;
    }
}
