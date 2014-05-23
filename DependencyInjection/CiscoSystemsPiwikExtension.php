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
        $loader->load( 'piwik.yml' );
        $loader->load( 'services.yml' );

        $config = $this->mergeConfigs( $configs );

        if( isset( $config['url'] ))
        {
            $container->setParameter( 'cisco.piwik.client.url', $config['url'] );
        }

        if( isset( $config['token'] ))
        {
            $container->setParameter( 'cisco.piwik.client.token', $config['token'] );
        }

        if( isset( $config['site_id'] ))
        {
            $container->setParameter( 'cisco.piwik.client.site_id', $config['site_id'] );
        }

        if( isset( $config['format'] ))
        {
            $container->setParameter( 'cisco.piwik.client.format', $config['format'] );
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