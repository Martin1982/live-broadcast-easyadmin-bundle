<?php
declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-sonata-admin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\DependencyInjection\Loader\Configurator;

use Martin1982\LiveBroadcastEasyAdminBundle\Controller\Admin\AbstractChannelCrudController;
use Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin\DashboardController;
use Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin\LiveBroadcastCrudController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('livebroadcast.controller.dashboard', DashboardController::class)
        ->tag('controller.service_arguments')
        ->public()

        ->set('livebroadcast.controller.channel_crud', AbstractChannelCrudController::class)
        ->tag('controller.service_arguments')
        ->public()

        ->set('livebroadcast.controller.live_broadcast_crud', LiveBroadcastCrudController::class)
        ->tag('controller.service_arguments')
        ->public()
    ;
};