<?php

namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use Martin1982\LiveBroadcastBundle\Entity\LiveBroadcast;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LiveBroadcastCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LiveBroadcast::class;
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