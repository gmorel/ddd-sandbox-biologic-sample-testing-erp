<?php

namespace Api\KernelBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension as BaseExtension;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class KernelBundleExtension extends BaseExtension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/services'));
        $loader->load('common.xml');
        $loader->load('consumable_engine.xml');
    }
}
