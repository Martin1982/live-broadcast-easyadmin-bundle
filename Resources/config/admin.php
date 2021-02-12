<?php
declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-easyadmin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\DependencyInjection\Loader\Configurator;

use Martin1982\LiveBroadcastEasyadminBundle\Controller\AuthCallback\FacebookController;
use Martin1982\LiveBroadcastEasyadminBundle\Controller\AuthCallback\YouTubeController;
use Martin1982\LiveBroadcastEasyadminBundle\Form\Type\FacebookConnectType;
use Martin1982\LiveBroadcastEasyadminBundle\Form\Type\YouTubeConnectType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('Martin1982\\LiveBroadcastEasyadminBundle\\', '../../*')
        ->exclude('../../{vendor,DependencyInjection,Deprecated,Entity,Tests,Resources,LiveBroadcastEasyadminBundle.php}');

    $services->load('Martin1982\\LiveBroadcastEasyadminBundle\\Controller\\', '../../Controller')
        ->tag('controller.service_arguments');

    $services->set(FacebookConnectType::class)
        ->arg('$facebookAppId', '%env(FACEBOOK_APP_ID)%');

    $services->set(YouTubeConnectType::class)
        ->arg('$googleClient', new Reference('live.broadcast.channel_api.client.google'));

    $services->set(FacebookController::class)
        ->arg('$facebookApi', new Reference('live.broadcast.facebook_api.service'));

    $services->set(YouTubeController::class)
        ->arg('$youTubeApi', new Reference('live.broadcast.channel_api.client.google'));
};