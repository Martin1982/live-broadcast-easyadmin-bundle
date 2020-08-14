<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Martin1982\LiveBroadcastBundle\Entity\Channel\ChannelYouTube;
use Martin1982\LiveBroadcastEasyadminBundle\Field\YouTubeConnectField;

/**
 * Class YouTubeChannelCrudController
 */
class YouTubeChannelCrudController extends AbstractCrudController
{
    /**
     * Get class name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return ChannelYouTube::class;
    }

    /**
     * Index action
     *
     * @param AdminContext $context
     *
     * @return KeyValueStore|\Symfony\Component\HttpFoundation\Response|void
     */
    public function index(AdminContext $context)
    {
        /** @var CrudUrlGenerator $crudUrlGenerator */
        $crudUrlGenerator = $this->get(CrudUrlGenerator::class);
        $channelIndexUrl = $crudUrlGenerator->build()
            ->setController(AbstractChannelCrudController::class)
            ->setAction(Action::INDEX)
            ->generateUrl();

        return $this->redirect($channelIndexUrl);
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
                YouTubeConnectField::new('youTubeChannelName'),
                TextField::new('channelName'),
                HiddenField::new('refreshToken'),
            ];
        }

        return [];
    }

    /**
     * Configure CRUD
     *
     * @param Crud $crud
     *
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setFormThemes([
            '@LiveBroadcastEasyadmin/field/fields.html.twig',
            '@EasyAdmin/crud/form_theme.html.twig',
        ]);
    }
}
