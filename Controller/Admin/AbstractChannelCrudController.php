<?php declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-easyadmin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Martin1982\LiveBroadcastBundle\Entity\Channel\AbstractChannel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelFacebook;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelTwitch;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelYouTube;

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
     * Redirect to the applicable CRUD controller
     *
     * @param AdminContext $context
     *
     * @return \EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function edit(AdminContext $context)
    {
        $entity = $context->getEntity()->getInstance();
        $class = null !== $entity ? get_class($entity): 'none';

        switch ($class) {
            case ChannelTwitch::class:
                $forward = $this->redirect('/admin?twitch');
                break;
            case ChannelYouTube::class:
                $forward = $this->redirect('/admin?youtube');
                break;
            case ChannelFacebook::class:
                $forward = $this->redirect('/admin?facebook');
                break;
            default:
                throw new \Exception('No context for class '.$class);
        }

        return $forward;
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
        $name = TextField::new('channelName');
        $typeName = TextField::new('typeName')
            ->formatValue(
                static function ($value) {
                    $value = (string) $value;

                    return '<i class="fab fa-'.strtolower($value).'"></i> '.$value;
                }
            )
            ->renderAsHtml()
            ->onlyOnIndex();
        $isHealthy = BooleanField::new('isHealthy')
            ->renderAsSwitch(false)
            ->onlyOnIndex();

        if (Crud::PAGE_INDEX === $pageName) {
            $fields = [
                $name,
                $typeName,
                $isHealthy,
            ];
        }

        return $fields ?? parent::configureFields($pageName);
    }
}
