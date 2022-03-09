<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */

namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelYouTube;
use Martin1982\LiveBroadcastEasyadminBundle\Field\YouTubeConnectField;

/**
 * Class YouTubeChannelCrudController
 */
class ChannelYouTubeCrudController extends AbstractCrudController
{
    /**
     * Configure CRUD
     *
     * @param Crud $crud
     *
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInSingular('YouTube channel')
            ->setEntityLabelInPlural('YouTube channels')
            ->setFormThemes([
                '@LiveBroadcastEasyadmin/field/fields.html.twig',
                '@EasyAdmin/crud/form_theme.html.twig',
            ]);
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
            TextField::new('channelName')
                ->setLabel('Internal Channel Name'),
            YouTubeConnectField::new('youTubeChannelName')
                ->hideOnIndex()
                ->setLabel('YouTube Channel Name'),
            HiddenField::new('refreshToken')
                ->hideOnIndex(),
            BooleanField::new('isHealthy')
                ->renderAsSwitch(false)
                ->hideOnForm(),
        ];
    }

    /**
     * Get entity class name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return ChannelYouTube::class;
    }
}
