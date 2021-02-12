<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */

namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelFacebook;
use Martin1982\LiveBroadcastEasyadminBundle\Field\FacebookConnectField;

/**
 * Class FacebookChannelCrudController
 */
class ChannelFacebookCrudController extends AbstractCrudController
{
    /**
     * Setup entity config
     *
     * @param Crud $crud
     *
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInSingular('Facebook channel')
            ->setEntityLabelInPlural('Facebook channels')
            ->setFormThemes([
                '@LiveBroadcastEasyadmin/field/fields.html.twig',
                '@EasyAdmin/crud/form_theme.html.twig',
            ]);
    }

    /**
     * @inheritDoc
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            FacebookConnectField::new('channelName'),
            BooleanField::new('isHealthy')->renderAsSwitch(false)->hideOnForm(),
            HiddenField::new('accessToken')->hideOnIndex(),
            HiddenField::new('fbEntityId')->hideOnIndex(),
        ];
    }

    /**
     * Get class name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return ChannelFacebook::class;
    }
}
