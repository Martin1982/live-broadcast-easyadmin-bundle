<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelTwitch;

/**
 * Class TwitchChannelCrudController
 */
class TwitchChannelCrudController extends AbstractCrudController
{
    /**
     * Get class name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return ChannelTwitch::class;
    }

    /**
     * Configure rediret actions for the index
     *
     * @param Actions $actions
     *
     * @return Actions
     */
    public function configureActions(Actions $actions): Actions
    {
        /** @var CrudUrlGenerator $crudUrlGenerator */
        $crudUrlGenerator = $this->get(CrudUrlGenerator::class);
        $channelIndexUrl = $crudUrlGenerator->build()
            ->setController(AbstractChannelCrudController::class)
            ->setAction(Action::INDEX)
            ->generateUrl();

        $channelIndexAction = Action::new('channel_index_action', 'Channel index')
            ->linkToUrl($channelIndexUrl);

        $actions->add(Crud::PAGE_INDEX, $channelIndexAction);

        return parent::configureActions($actions);
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
                yield TextField::new('streamKey'),
                yield TextField::new('streamServer'),
            ];
        }

        return [];
    }
}
