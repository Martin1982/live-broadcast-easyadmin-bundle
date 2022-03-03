<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */

namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\Admin\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Martin1982\LiveBroadcastBundle\Entity\LiveBroadcast;

/**
 * Class LiveBroadcastCrudController
 */
class LiveBroadcastCrudController extends AbstractCrudController
{
    /**
     * @var string
     */
    protected string $uploadPath;

    /**
     * LiveBroadcastCrudController constructor.
     *
     * @param string $uploadPath
     */
    public function __construct(string $uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    /**
     * Configure entity fields
     *
     * @param string $pageName
     *
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Name'),
            TextEditorField::new('description', 'Description')
                ->hideOnIndex(),
            ImageField::new('thumbnail', 'Thumbnail (min. 1280x720px, 16:9 ratio)')
                ->setBasePath('')
                ->setUploadDir($this->uploadPath)
                ->hideOnIndex(),
            DateTimeField::new('startTimestamp', 'Broadcast start'),
            DateTimeField::new('endTimestamp', 'Broadcast end'),
            BooleanField::new('stopOnEndTimestamp', 'Force the stream to stop on the end time')
                ->setHelp('When checked video will be looped and ended when the end time is reached. When unchecked video will play once and ignore the end time, when the end time is later than the video length video may be restarted')
                ->hideOnIndex(),
            ChoiceField::new('privacyStatus', 'Privacy status (YouTube only)')
                ->setChoices([
                    'Public and listed'     => LiveBroadcast::PRIVACY_STATUS_PUBLIC ,
                    'Private'               => LiveBroadcast::PRIVACY_STATUS_PRIVATE,
                    'Public and unlisted'   => LiveBroadcast::PRIVACY_STATUS_UNLISTED,
                ])
                ->hideOnIndex(),
            AssociationField::new('input', 'Video input')
                ->hideOnIndex(),
            AssociationField::new('outputChannels', 'Channels'),
        ];
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
        return $crud->setEntityLabelInSingular('Live broadcast')
            ->setEntityLabelInPlural('Live broadcasts');
    }

    /**
     * Get entity class name
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return LiveBroadcast::class;
    }
}
