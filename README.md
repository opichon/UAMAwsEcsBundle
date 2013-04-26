UAM Amazon Product Advertising API Bundle
===================

## Installation

### Symfony 2.1.x

Add the UAMmazonPABundle in your composer.json:

```js
{
    "require": {
        "uam/amazon-pa-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update uam/amazon-pa-bundle
```

Dont forget to activate the bundle in your AppKernel:

``` php
<?php

// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new UAM\AmazonPABundle\UAMAmazonPABundle(),
    // ...
);

```

