<?php

namespace Api\Test\Behavioural\Bootstrap;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Rezzza\RestApiBehatExtension\RestApiContext;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class DebugContext implements Context, SnippetAcceptingContext
{
    /** @var RestApiContext */
    private $restApiContext;

    /**
     * @BeforeScenario
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();

        $this->restApiContext = $environment->getContext('Rezzza\RestApiBehatExtension\RestApiContext');
    }

    /**
     * @Given /^I enable xDebug remote debugging$/
     */
    public function iSetXdebugRemoteCookie()
    {
        $this->restApiContext->iAddHeaderEqualTo(
            'COOKIE',
            'XDEBUG_SESSION=PHPSTORM'
        );
    }
}
