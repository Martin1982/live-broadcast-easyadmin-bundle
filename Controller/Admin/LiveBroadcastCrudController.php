<?php declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-easyadmin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Martin1982\LiveBroadcastBundle\Entity\LiveBroadcast;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

/**
 * Class LiveBroadcastCrudController
 */
class LiveBroadcastCrudController extends AbstractCrudController
{
    /**
     * Get class name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return LiveBroadcast::class;
    }

    /**
     * Configure fields
     *
     * @param string $pageName
     *
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('name', 'Title'),
        ];
    }
}
