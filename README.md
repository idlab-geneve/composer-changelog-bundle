# Composer Changelog Bundle

This bundle helps you generate a Changelog of the dependencies you have been installing, updating and uninstalling during the life of your project. 
This helps the developers keep track of important changes in a human readable way.
The generation always generathe the whole history, so it can be run manualy or in a CI whenever you feel the need.

The command is an intergration of the great [composer-lock-diff](https://github.com/davidrjonas/composer-lock-diff) by [davidrjonas](https://github.com/davidrjonas)

Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require idlab/composer-changelog-bundle --dev
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require idlab/composer-changelog-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Idlab\ComposerChangelogBundle\IdlabComposerChangelogBundle::class => ['dev' => true],
];
```

## Usage

```console
$ php bin/console idlab:composer-changelog
```

Will generate someting like this example :

[...]

| Dev Changes               | From | To      | Compare |
|---------------------------|------|---------|---------|
| composer/pcre             | NEW  | 3.0.0   |         |
| composer/semver           | NEW  | 3.3.2   |         |
| composer/xdebug-handler   | NEW  | 3.0.3   |         |
| doctrine/annotations      | NEW  | 1.13.3  |         |

[...]

You couls also redirect the output to a file you may then commit with your application.

```console
$ php bin/console idlab:composer-changelog > COMPOSER-CHANGELOG.md
```

## Configuration

@TODO implement the configuration in the Command :-)

## Contribute

Please always run CS fixer before sumbitting a merge request (PHP CS Fixer lives in the `./vendors` directory)

```console
$ php ./vendor/bin/php-cs-fixer fix
```

