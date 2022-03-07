<?php declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-easyadmin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelFacebook;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelTwitch;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelYouTube;
use Martin1982\LiveBroadcastBundle\Entity\LiveBroadcast;
use Martin1982\LiveBroadcastBundle\Entity\Media\MediaFile;
use Martin1982\LiveBroadcastBundle\Entity\Media\MediaRtmp;
use Martin1982\LiveBroadcastBundle\Entity\Media\MediaUrl;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     *
     * @return Response
     */
    public function index(): Response
    {
        parent::index();

        return $this->render('@LiveBroadcastEasyadmin/welcome.html.twig');
    }

    /**
     * Configure dashboard features
     *
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Live Broadcast Demo');
    }

    /**
     * Configure dashboard menu
     *
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Broadcasts'),
            MenuItem::linkToCrud('Broadcast planning', 'fa fa-calendar', LiveBroadcast::class),

            MenuItem::section('Channels'),
            MenuItem::linkToCrud('Twitch channels', 'fab fa-twitch', ChannelTwitch::class),
            MenuItem::linkToCrud('Facebook channels', 'fab fa-facebook', ChannelFacebook::class),
            MenuItem::linkToCrud('YouTube channels', 'fab fa-youtube', ChannelYouTube::class),

            MenuItem::section('Inputs'),
            MenuItem::linkToCrud('Files', 'fa fa-file', MediaFile::class),
            MenuItem::linkToCrud('URLs', 'fa fa-globe', MediaUrl::class),
            MenuItem::linkToCrud('Streams', 'fa fa-signal', MediaRtmp::class),
        ];
    }
}
