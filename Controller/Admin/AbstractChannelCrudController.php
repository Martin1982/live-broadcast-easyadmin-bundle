<?php declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-easyadmin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
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
        $actions->disable('new')
            ->add('admin', 'Add YouTube channel');

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
