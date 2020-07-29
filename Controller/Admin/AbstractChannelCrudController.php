<?php

namespace Martin1982\LiveBroadcastEasyAdminBundle\Controller\Admin;

use Martin1982\LiveBroadcastBundle\Entity\Channel\AbstractChannel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AbstractChannelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AbstractChannel::class;
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
