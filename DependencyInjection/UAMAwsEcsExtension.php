<?php

namespace UAM\Bundle\AwsEcsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Definition;
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

        $container->setParameter('uam_aws_ecs', $config);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        // Load each store as a service
        foreach ($config['stores'] as $id => $params) {
            $definition = new Definition();

            $definition->setClass('UAM\Aws\Ecs\EcsClient');
            $definition->setFactoryService('uam_aws_ecs.service_builder');
            $definition->setFactoryMethod('get');
            $definition->setArguments(array($id));

            $container->setDefinition($id, $definition);
        }
    }
}
