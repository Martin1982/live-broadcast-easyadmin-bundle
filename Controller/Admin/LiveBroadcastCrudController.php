<?php declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-easyadmin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Martin1982\LiveBroadcastBundle\Entity\LiveBroadcast;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

/**
 * Class LiveBroadcastCrudController
 */
class LiveBroadcastCrudController extends AbstractCrudController
{
    /**
     * Get class name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return LiveBroadcast::class;
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
        return $crud->setEntityLabelInSingular('Planned broadcast')
            ->setEntityLabelInPlural('Planned broadcasts');
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
        if (Action::INDEX === $pageName) {
            return [
                yield TextField::new('name'),
                yield AssociationField::new('outputChannels'),
                yield DateTimeField::new('startTimestamp'),
                yield DateTimeField::new('endTimestamp'),
            ];
        }

        if (Action::EDIT === $pageName || Action::NEW === $pageName) {
            return [
                yield TextField::new('name', 'Name'),
                yield TextEditorField::new('description', 'Desccription'),
                yield ImageField::new('thumbnail', 'Thumbnail (min. 1280x720px, 16:9 ratio)'),
                yield DateTimeField::new('startTimestamp', 'Broadcast start'),
                yield DateTimeField::new('endTimestamp', 'Broadcast end'),
                yield ChoiceField::new('privacyStatus', 'Privacy status (YouTube only)')->setChoices([
                    'Public and listed'     => LiveBroadcast::PRIVACY_STATUS_PUBLIC ,
                    'Private'               => LiveBroadcast::PRIVACY_STATUS_PRIVATE,
                    'Public and unlisted'   => LiveBroadcast::PRIVACY_STATUS_UNLISTED,
                ]),
                yield BooleanField::new('stopOnEndTimestamp', 'Force the stream to stop on the end time')->setHelp('When checked video will be looped and ended when the end time is reached. When unchecked video will play once and ignore the end time, when the end time is later than the video length video may be restarted'),
                yield AssociationField::new('input', 'Video input'),
                yield AssociationField::new('outputChannels', 'Channels')->setFormTypeOption('multiple', true),
            ];
        }

        return parent::configureFields($pageName);
    }
}
