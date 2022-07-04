<?php

/*
 * This file is part of the Idlab Composer Changelog Generator.
 *
 * (c) Idlab - Michael Vetterli (michael@idlab.ch)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Idlab\ComposerChangelogBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class IdlabComposerChangelogExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('idlab_composer_changelog.composer_changelog_command');
        $definition->setArgument(0, $config['format']);
        $definition->setArgument(1, $config['output_file']);
    }

    public function getAlias(): string
    {
        return 'idlab_composer_changelog';
    }
}
