<?php

namespace CanalTP\MediaManagerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Yaml\Parser;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see symfony.com -> extension
 */
class CanalTPMediaManagerExtension extends Extension
{
    private function loadConfigurations(array $config, ContainerBuilder $container)
    {
        foreach ($config['configurations'] as $key => $params) {
            $container->setParameter(
                'canal_tp_media_manager.configurations.' . $key,
                $params
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $yaml = new Parser();
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader(
            $container, new FileLocator(__DIR__ . '/../Resources/config')
        );

        $this->loadConfigurations($config, $container);

        $loader->load('services.yml');
    }
}
