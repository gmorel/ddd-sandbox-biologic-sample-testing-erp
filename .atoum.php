<?php
use \mageekguy\atoum;

$runner->addTestsFromDirectory(__DIR__.'/tests/Units');

$cloverWriter = new atoum\writers\file(__DIR__.'/data/coverage.clover');
$cloverReport = new atoum\reports\asynchronous\clover();
$cloverReport->addWriter($cloverWriter);
$runner->addReport($cloverReport);

$script
    ->addDefaultReport()
    ->addField(new atoum\report\fields\runner\result\logo())
    ->addField(new atoum\report\fields\runner\coverage\html(
        'Code Coverage',
        __DIR__.'/web/code-coverage'
    ));

$script->noCodeCoverageForNamespaces('mageekguy');
$script->bootstrapFile(__DIR__ . DIRECTORY_SEPARATOR . '.atoum.bootstrap.php');
