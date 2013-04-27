<?php

namespace UAM\Aws\EcsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * The DependencyInjection Extension
 *
 */
class UAMAwsEcsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->getDefinition('uam_aws_ecs')
            ->replaceArgument(0, $config['access_key'])
            ->replaceArgument(1, $config['secret_key'])
            ->replaceArgument(2, $config['country'])
            ->replaceArgument(3, $config['associate_tag']);
    }
}
