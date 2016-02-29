<?php

namespace Api\Test\Behavioural\Bootstrap;

use Api\Common\Domain\Quantity\BaseQuantity;
use Api\Common\Domain\Quantity\Unit;
use Api\ConsumableEngine\Domain\Entity\BiologicTest;
use Api\ConsumableEngine\Domain\Entity\Consumable;
use Api\ConsumableEngine\Domain\Entity\Supplier;
use Api\ConsumableEngine\Domain\Entity\TestingMachine;
use Api\ConsumableEngine\Domain\Repository\BiologicTestRepositoryInterface;
use Api\ConsumableEngine\Domain\Repository\ConsumableRepositoryInterface;
use Api\ConsumableEngine\Domain\Repository\SupplierRepositoryInterface;
use Api\ConsumableEngine\Domain\Repository\TestingMachineRepositoryInterface;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;

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

    /** @var BiologicTestRepositoryInterface */
    private $biologicTestRepository;

    /**
     * Initializes Behat 3 context
     */
    public function __construct(TestingMachineRepositoryInterface $testingMachineRepository, ConsumableRepositoryInterface $consumableRepository, SupplierRepositoryInterface $supplierRepository, BiologicTestRepositoryInterface $biologicTestRepository)
    {
        $this->testingMachineRepository = $testingMachineRepository;
        $this->consumableRepository = $consumableRepository;
        $this->supplierRepository = $supplierRepository;
        $this->biologicTestRepository = $biologicTestRepository;
    }

    /**
     * @BeforeSuite
     */
     public static function prepare(BeforeSuiteScope $scope)
     {
         // prepare system for test suite
         // before it runs
     }

    /**
     * @Given /the Testing Machine named \"(?P<testingMachineName>[^\"]+)\" consuming ([0-9]+)(µl|ml) of \"(?P<consumableName>[^\"]+)\" per Biologic Test \"(?P<biologicTestName>[^\"]+)\"/
     */
    public function theTestingMachineNamedConsumingUlOfPerBiologicTest($testingMachineName, $quantity, $unit, $consumableName, $biologicTestName)
    {
        $testingMachine = $this->createTestingMachine($testingMachineName);
        if (null === $testingMachine) {
            $testingMachine = $this->testingMachineRepository->findOneByName($testingMachineName);
        }

        $consumable = $this->consumableRepository->findOneByName($consumableName);
        if (null === $consumable) {
            throw new \LogicException('A consumable needs to be created before using this step.');
        }

        $biologicTest = $this->biologicTestRepository->findOneByName($biologicTestName);
        if (null === $biologicTest) {
            $biologicTest = $this->createBiologicTest($biologicTestName);
        }

        $quantity = new BaseQuantity(
            $quantity,
            new Unit($unit)
        );

        $testingMachine->isConsuming($biologicTest, $quantity, $consumable);
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

        $consumable->getStock()->replenish(
            new BaseQuantity(
                $quantity,
                new Unit($unit)
            )
        );

        $this->consumableRepository->save($consumable);
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

    /**
     * @param string $biologicTestName
     * @return BiologicTest
     */
    private function createBiologicTest($biologicTestName)
    {
        $biologicTest = new BiologicTest(
            $biologicTestName
        );

        $this->biologicTestRepository->save($biologicTest);

        return $biologicTest;
    }
}
