<?php

namespace Api\KernelBundle;

use Api\KernelBundle\DependencyInjection\KernelBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class KernelBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        // Allow to load extension
        return new KernelBundleExtension();
    }
}
