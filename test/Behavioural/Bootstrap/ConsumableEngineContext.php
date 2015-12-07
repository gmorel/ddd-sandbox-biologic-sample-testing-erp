<?php

namespace Api\Test\Behavioural\Bootstrap;

use Api\Common\Domain\Quantity\BaseQuantity;
use Api\Common\Domain\Quantity\Unit;
use Api\ConsumableEngine\Domain\Entity\Consumable;
use Api\ConsumableEngine\Domain\Entity\Stock;
use Api\ConsumableEngine\Domain\Entity\Supplier;
use Api\ConsumableEngine\Domain\Entity\TestingMachine;
use Api\ConsumableEngine\Domain\Repository\ConsumableRepositoryInterface;
use Api\ConsumableEngine\Domain\Repository\StockRepositoryInterface;
use Api\ConsumableEngine\Domain\Repository\SupplierRepositoryInterface;
use Api\ConsumableEngine\Domain\Repository\TestingMachineRepositoryInterface;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class ConsumableEngineContext implements Context, SnippetAcceptingContext
{
    /** @var TestingMachineRepositoryInterface */
    private $testingMachineRepository;

    /** @var ConsumableRepositoryInterface */
    private $consumableRepository;

    /** @var SupplierRepositoryInterface */
    private $supplierRepository;

    /** @var StockRepositoryInterface */
    private $stockRepository;

    /**
     * Initializes Behat 3 context
     */
    public function __construct(TestingMachineRepositoryInterface $testingMachineRepository, ConsumableRepositoryInterface $consumableRepository, SupplierRepositoryInterface $supplierRepository, StockRepositoryInterface $stockRepository)
    {
        $this->testingMachineRepository = $testingMachineRepository;
        $this->consumableRepository = $consumableRepository;
        $this->supplierRepository = $supplierRepository;
        $this->stockRepository = $stockRepository;
    }

    /**
     * @Given /the Testing Machine named \"(?P<testingMachineName>[^\"]+)\" consuming ([0-9]+)(µl|ml) of \"(?P<consumableName>[^\"]+)\" per test tube/
     */
    public function theTestingMachineNamedConsumingUlOfPerTestTube($testingMachineName, $quantity, $unit, $consumableName)
    {
        $testingMachine = $this->createTestingMachine($testingMachineName);
        if (null === $testingMachine) {
            $testingMachine = $this->testingMachineRepository->findOneByName($testingMachineName);
        }

        $consumable = $this->consumableRepository->findOneByName($consumableName);
        if (null === $consumable) {
            throw new \LogicException('A consumable needs to be created before using this step.');
        }

        $quantity = new BaseQuantity(
            $quantity,
            new Unit($unit)
        );

        $testingMachine->isConsuming($quantity, $consumable);

        $this->testingMachineRepository->save($testingMachine);
    }

    /**
     * @Given /the laboratory already having ([0-9]+)(µl|ml) of \"(?P<consumableName>[^\"]+)\" in stock/
     */
    public function theLaboratoryAlreadyHavingUlOfInStock($quantity, $unit, $consumableName)
    {
        $consumable = $this->consumableRepository->findOneByName($consumableName);
        if (null === $consumable) {
            throw new \LogicException('A consumable needs to be created before using this step.');
        }

        $quantity = new BaseQuantity(
            $quantity,
            new Unit($unit)
        );

        $stock = new Stock($quantity, $consumable);

        $this->stockRepository->save($stock);
    }

    /**
     * @Given /the laboratory always needing at least ([0-9]+)(µl|ml) of \"(?P<consumableName>[^\"]+)\" delivered by \"(?P<supplierName>[^\"]+)\"/
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
     * @Given the Biologic Test :biologicTestName being available
     */
    public function theBiologicTestBeingAvailable($biologicTestName)
    {
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
        $supplier = new Supplier($supplierName);

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
        $consumable = new Consumable(
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
        $testingMachine = new TestingMachine(
            $testingMachineName
        );

        $this->testingMachineRepository->save($testingMachine);

        return $testingMachine;
    }
}
