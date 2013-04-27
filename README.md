UAM Aws ECS Bundle
===================

## Installation

### Symfony 2.1.x

Add the UAMAwsEcsBundle to your composer.json file:

```js
{
    "require": {
        "uam/aws-ecs-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update uam/aws-ecs-bundle
```

Dont forget to activate the bundle in your AppKernel:

``` php
<?php

// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new UAM\Aws\EcsBundle\EcsBundle(),
    // ...
);

```

