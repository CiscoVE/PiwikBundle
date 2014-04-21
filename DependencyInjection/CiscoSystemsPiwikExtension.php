<?php

namespace CiscoSystems\PiwikBundle\DependencyInjection;

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
class CiscoSystemsPiwikExtension extends Extension
{

    /**
     * Loads the piwik configuration.
     *
     * @param array $config  An array of configuration settings
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container A ContainerBuilder instance
     */
    public function load( array $configs, ContainerBuilder $container )
    {
        $fileLocator = new FileLocator( __DIR__ . '/../Resources/config' );
        $loader = new Loader\YamlFileLoader( $container, $fileLocator );

        if( !$container->hasDefinition( 'piwik.client' ) )
        {
            $loader->load( 'services.yml' );
        }

        $config = $this->mergeConfigs( $configs );

        if( isset( $config['connection'] ))
        {
            $definition = $container->getDefinition( 'piwik.client' );
            $arguments = $definition->getArguments();
            $arguments[0] = new Reference( $config['connection'] );
            $definition->setArguments( $arguments );
        }

        if( isset( $config['url'] ))
        {
            $container->setParameter( 'piwik.connection.http.url', $config['url'] );
        }

        if( isset( $config['init'] ))
        {
            $container->setParameter( 'piwik.connection.piwik.init', ( bool ) $config['init'] );
        }

        if( isset( $config['token'] ))
        {
            $container->setParameter( 'piwik.client.token', $config['token'] );
        }
    }

    /**
     * Merges the given configurations array
     *
     * @param  array $config
     *
     * @return array
     */
    protected function mergeConfigs( array $configs )
    {
        $merged = array();
        foreach( $configs as $config )
        {
            $merged = array_merge( $merged, $config );
        }

        return $merged;
    }

    public function getAlias()
    {
        return 'cisco_systems_piwik';
    }
}