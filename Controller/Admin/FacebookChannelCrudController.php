<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelFacebook;
use Martin1982\LiveBroadcastEasyadminBundle\Field\FacebookConnectField;

/**
 * Class FacebookChannelCrudController
 */
class FacebookChannelCrudController extends AbstractCrudController
{
    /**
     * Get class name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return ChannelFacebook::class;
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
        if (Action::NEW === $pageName || Action::EDIT === $pageName) {
            return [
                yield TextField::new('channelName'),
                yield FacebookConnectField::new('accessToken'),
                yield TextField::new('fbEntityId')
                    ->setFormTypeOption('disabled', true),
            ];
        }

        return [];
    }
}
