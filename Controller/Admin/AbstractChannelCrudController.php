<?php declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-easyadmin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Martin1982\LiveBroadcastBundle\Entity\Channel\AbstractChannel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

/**
 * Class AbstractChannelCrudController
 */
class AbstractChannelCrudController extends AbstractCrudController
{
    /**
     * Get class name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return AbstractChannel::class;
    }

    /**
     * Configure actions
     *
     * @param Actions $actions
     *
     * @return Actions
     */
    public function configureActions(Actions $actions): Actions
    {
        $newYouTubeAction = Action::new('newYouTubeChannel', 'New YouTube Channel', 'fa fa-youtube')
            ->createAsGlobalAction()
            ->displayAsButton()
            ->linkToRoute('homepage');

        $newFacebookAction = Action::new('newFacebookChannel', 'New Facebook Channel', 'fa fa-facebook')
            ->createAsGlobalAction()
            ->displayAsButton()
            ->linkToRoute('homepage');

        $newTwitchAction = Action::new('newTwitchChannel', 'New Twitch Channel', 'fa fa-twitch')
            ->createAsGlobalAction()
            ->displayAsButton()
            ->linkToRoute('homepage');

        $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->add(Crud::PAGE_INDEX, $newYouTubeAction)
            ->add(Crud::PAGE_INDEX, $newFacebookAction)
            ->add(Crud::PAGE_INDEX, $newTwitchAction);

        return parent::configureActions($actions);
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
