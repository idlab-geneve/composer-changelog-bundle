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

use Idlab\ComposerChangelogBundle\Command\ComposerChangelogCommand;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class IdlabComposerChangelogExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container
            ->register('idlab_composer_changelog.composer_changelog_command', ComposerChangelogCommand::class)
            ->setPublic(true)
            ->setAutoconfigured(true)
        ;
        $container->setAlias(ComposerChangelogCommand::class, 'idlab_composer_changelog.composer_changelog_command');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('idlab_composer_changelog.composer_changelog_command');
        $definition->setArgument(0, $config['format']);
    }

    public function getAlias(): string
    {
        return 'idlab_composer_changelog';
    }
}
