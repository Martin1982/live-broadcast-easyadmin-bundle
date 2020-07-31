<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Martin1982\LiveBroadcastBundle\Entity\Channel\AbstractChannel;
use Martin1982\LiveBroadcastBundle\Entity\LiveBroadcast;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        parent::index();

        return $this->render('@LiveBroadcastEasyadmin/welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Live Broadcast Demo');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Broadcast planning', 'fa fa-calendar', LiveBroadcast::class);
        yield MenuItem::linkToCrud('Channel configuration', 'fa fa-cogs', AbstractChannel::class);
    }
}
