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

        $actions->remove(Crud::PAGE_INDEX, Action::INDEX)
            ->add(Crud::PAGE_INDEX, $channelIndexUrl);

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
                yield FacebookConnectField::new('accessToken')
                    ->setFormTypeOption('attr', [ 'readonly' => true ]),
                yield TextField::new('channelName'),
                yield TextField::new('fbEntityId')
                    ->setFormTypeOption('attr', [ 'readonly' => true ]),
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
