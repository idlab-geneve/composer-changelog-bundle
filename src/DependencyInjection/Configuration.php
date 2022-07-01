<?php

namespace Idlab\ComposerChangelogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('idlab_composer_changelog');
        $rootNode    = $treeBuilder->getRootNode();

        $rootNode
            ->children()
            ->scalarNode('format')
                ->info('formats the output, can be "text", "md", "json", "json-pretty"')
                ->validate()
                    ->ifNotInArray(['md', 'text', 'json', 'json-pretty'])
                    ->thenInvalid('Invalid database driver %s')
                ->end()
                ->defaultValue('md')
                ->end()
            ->scalarNode('output_file')->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}