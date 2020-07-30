<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class LiveBroadcastEasyadminExtension
 */
class LiveBroadcastEasyadminExtension extends Extension
{
    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('admin.php');
    }

}
