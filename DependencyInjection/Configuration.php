<?php

namespace Glory\SettingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('glory_setting');

        $rootNode->children()
                ->scalarNode('driver')->defaultNull()->info('setting driver, default is %database_driver%.')->end()
                ->scalarNode('manager')->defaultNull()->end()
                ->scalarNode('model')->defaultNull()->end()
                ->end();

        return $treeBuilder;
    }

}
