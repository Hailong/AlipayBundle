<?php

namespace Orinoco\AlipayBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader;
use Orinoco\AlipayBundle\Factory\AlipayPageTradeServiceFactory;
use Orinoco\AlipayBundle\Factory\AlipayWapTradeServiceFactory;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class OrinocoAlipayExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (isset($config['page_trade']) && $config['page_trade']['enabled']) {
            $arguments = $config['page_trade'];

            foreach (['rsa_private_key', 'rsa_public_key'] as $key) {
                $filename = $container->resolveEnvPlaceholders($arguments[$key], true);
                $arguments[$key] = file_get_contents($filename);
            }

            $definition = new Definition($arguments['class_name']);
            $definition->setFactory(array(AlipayPageTradeServiceFactory::class, 'createAlipayTradeService'));
            $definition->addArgument($arguments);
            $definition->setPublic(true);
            $container->setDefinition('orinoco_alipay.trade_service.page', $definition);
        }

        if (isset($config['wap_trade']) && $config['wap_trade']['enabled']) {
            $arguments = $config['wap_trade'];

            foreach (['rsa_private_key', 'rsa_public_key'] as $key) {
                $filename = $container->resolveEnvPlaceholders($arguments[$key], true);
                $arguments[$key] = file_get_contents($filename);
            }

            $definition = new Definition($arguments['class_name']);
            $definition->setFactory(array(AlipayWapTradeServiceFactory::class, 'createAlipayTradeService'));
            $definition->addArgument($arguments);
            $definition->setPublic(true);
            $container->setDefinition('orinoco_alipay.trade_service.wap', $definition);
        }
    }
}
