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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('idlab_composer_changelog');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('format')
                    ->info('Formats the output, can be "text", "md", "json", "json-pretty"')
                    ->validate()
                        ->ifNotInArray(['md', 'text', 'json', 'json-pretty'])
                        ->thenInvalid('Invalid database driver %s')
                    ->end()
                    ->defaultValue('md')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
