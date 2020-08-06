<?php declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-easyadmin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
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
     * Configure CRUD screen
     *
     * @param Crud $crud
     *
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInSingular('Channel')
            ->setEntityLabelInPlural('Channels');
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
        /** @var CrudUrlGenerator $crudUrlGenerator */
        $crudUrlGenerator = $this->get(CrudUrlGenerator::class);

        $newYouTubeUrl = $crudUrlGenerator->build()
            ->setController(YouTubeChannelCrudController::class)
            ->setAction(Action::NEW)
            ->generateUrl();
        $newYouTubeAction = Action::new('newYouTubeChannel', 'New YouTube Channel', 'fab fa-youtube')
            ->createAsGlobalAction()
            ->addCssClass('btn btn-primary')
            ->linkToUrl($newYouTubeUrl);

        $newFacebookUrl = $crudUrlGenerator->build()
            ->setController(FacebookChannelCrudController::class)
            ->setAction(Action::NEW)
            ->generateUrl();
        $newFacebookAction = Action::new('newFacebookChannel', 'New Facebook Channel', 'fab fa-facebook')
            ->createAsGlobalAction()
            ->addCssClass('btn btn-primary')
            ->linkToUrl($newFacebookUrl);

        $newTwitchUrl = $crudUrlGenerator->build()
            ->setController(TwitchChannelCrudController::class)
            ->setAction(Action::NEW)
            ->generateUrl();
        $newTwitchAction = Action::new('newTwitchChannel', 'New Twitch Channel', 'fab fa-twitch')
            ->createAsGlobalAction()
            ->addCssClass('btn btn-primary')
            ->linkToUrl($newTwitchUrl);

        $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->add(Crud::PAGE_INDEX, $newYouTubeAction)
            ->add(Crud::PAGE_INDEX, $newFacebookAction)
            ->add(Crud::PAGE_INDEX, $newTwitchAction);

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
        $fields = null;

        if (Crud::PAGE_INDEX === $pageName) {
            $fields = [
                'name',
                'typeName',
                'isHealthy'
            ];
        }

        return $fields ?? parent::configureFields($pageName);
    }
}
