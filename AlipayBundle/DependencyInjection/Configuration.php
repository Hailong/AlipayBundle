<?php

namespace Orinoco\AlipayBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('orinoco_alipay');

        $rootNode
            ->children()
                ->arrayNode('page_trade')
                    ->addDefaultsIfNotSet()
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('class_name')
                            ->defaultValue('AlipayTradeService')
                        ->end()
                        ->scalarNode('gateway_url')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('app_id')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('rsa_private_key')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('rsa_public_key')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('charset')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('sign_type')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('wap_trade')
                    ->addDefaultsIfNotSet()
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('class_name')
                            ->defaultValue('AlipayTradeService')
                        ->end()
                        ->scalarNode('gateway_url')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('app_id')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('rsa_private_key')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('rsa_public_key')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('charset')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('sign_type')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
