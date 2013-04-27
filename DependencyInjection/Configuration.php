<?php

namespace UAM\Aws\EcsBundle\DependencyInjection;

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
                ->scalarNode('access_key')
                    ->isRequired()
                ->end()
                ->scalarNode('secret_key')
                    ->isRequired()
                ->end()
                ->scalarNode('country')
                    ->isRequired()
                ->end()
                ->scalarNode('associate_tag')
                    ->isRequired()
                ->end()
             ->end()
        ->end();

        return $treeBuilder;
    }
}
