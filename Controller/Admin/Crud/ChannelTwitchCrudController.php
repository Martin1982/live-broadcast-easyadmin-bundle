<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */

namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelTwitch;

/**
 * Class TwitchChannelCrudController
 */
class ChannelTwitchCrudController extends AbstractCrudController
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
        return $crud->setEntityLabelInSingular('Twitch channel')
            ->setEntityLabelInPlural('Twitch channels');
    }

    /**
     * @inheritDoc
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('channelName'),
            TextField::new('streamKey')->hideOnIndex(),
            TextField::new('streamServer')->hideOnIndex(),
            BooleanField::new('isHealthy')->renderAsSwitch(false)->hideOnForm(),
        ];
    }

    /**
     * Get the managed entity name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return ChannelTwitch::class;
    }
}
