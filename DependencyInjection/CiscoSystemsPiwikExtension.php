<?php

namespace CiscoSystems\PiwikBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Description of CiscoSystemsPiwikBundleExtension
 *
 * @author tam
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

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__ . '/../Resources/config/schema';
    }

    public function getAlias()
    {
        return 'cisco_piwik';
    }
}