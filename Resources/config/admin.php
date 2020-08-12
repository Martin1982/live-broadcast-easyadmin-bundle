<?php
declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-easyadmin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\DependencyInjection\Loader\Configurator;

use Martin1982\LiveBroadcastEasyadminBundle\Form\Type\FacebookConnectType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('Martin1982\\LiveBroadcastEasyadminBundle\\', '../../*')
        ->exclude('../../{DependencyInjection,Entity,Tests,Resources,LiveBroadcastEasyadminBundle.php}');

    $services->load('Martin1982\\LiveBroadcastEasyadminBundle\\Controller\\', '../../Controller')
        ->tag('controller.service_arguments');

    $services->set(FacebookConnectType::class)
        ->arg('$facebookAppId', '%env(FACEBOOK_APP_ID)%');
};