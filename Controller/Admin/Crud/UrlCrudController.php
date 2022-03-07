<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Martin1982\LiveBroadcastBundle\Entity\Media\MediaUrl;

/**
 * Class UrlCrudController
 */
class UrlCrudController extends AbstractCrudController
{
    /**
     * Return an abstract media item
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return MediaUrl::class;
    }
}
