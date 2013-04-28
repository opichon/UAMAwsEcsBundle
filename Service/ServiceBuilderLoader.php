<?php

namespace UAM\Bundle\AwsEcsBundle\Service;

use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Service\Builder\ServiceBuilderLoader as BaseLoader;

class ServiceBuilderLoader extends BaseLoader
{
    public static function factory($config)
    {
        $loader = new static();

        return $loader->load($config);
    }

    public function build($config, array $options = array())
    {
        $services = array();

        foreach ($config['stores'] as $id => $params) {
            $service = array(
                'class' => 'UAM\Aws\Ecs\EcsClient',
                'params' => $params
            );

            $services[$id] = $service;
        }

        return new ServiceBuilder($services);
    }
}