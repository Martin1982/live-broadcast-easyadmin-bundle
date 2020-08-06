<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelYouTube;

/**
 * Class YouTubeChannelCrudController
 */
class YouTubeChannelCrudController extends AbstractCrudController
{
    /**
     * Get class name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return ChannelYouTube::class;
    }
}