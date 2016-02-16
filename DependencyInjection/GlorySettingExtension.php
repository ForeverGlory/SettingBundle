<?php

namespace Glory\SettingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class GlorySettingExtension extends Extension
{

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
        if (empty($config['driver'])) {
            $config['driver'] = $container->getParameter('database_driver');
        }
        switch ($config['driver']) {
            case 'pdo_mysql':
                if (empty($config['manager'])) {
                    $config['manager'] = 'doctrine.orm.default_entity_manager';
                }
                if (empty($config['model'])) {
                    $config['model'] = 'Glory\\SettingBundle\\Entity\\Setting';
                }
                break;
            case 'mongodb':
                //todo
                if (empty($config['model'])) {
                    $config['model'] = 'Glory\\SettingBundle\\Document\\Setting';
                }
                break;
            default:
            //more driver, like monodb
        }
        $definition = $container->getDefinition('glory_setting.manager');
        $definition->setArguments(array(new Reference($config['manager']), $config['model']));
    }

}
