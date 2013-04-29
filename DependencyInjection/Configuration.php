<?php

namespace UAM\Bundle\AwsEcsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 *
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('uam_aws_ecs')
            ->children()
                ->arrayNode('stores')
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('key')
                                ->isRequired()
                            ->end()
                            ->scalarNode('secret')
                                ->isRequired()
                            ->end()
                            ->scalarNode('region')
                                ->isRequired()
                            ->end()
                            ->scalarNode('associateTag')
                                ->isRequired()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
