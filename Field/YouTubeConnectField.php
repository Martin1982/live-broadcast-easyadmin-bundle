<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Martin1982\LiveBroadcastEasyadminBundle\Form\Type\YouTubeConnectType;

/**
 * Class YouTubeConnectField
 */
class YouTubeConnectField implements FieldInterface
{
    use FieldTrait;

    /**
     * Make a new preconfigured field instance
     *
     * @param string      $propertyName
     * @param string|null $label
     *
     * @return YouTubeConnectField
     */
    public static function new(string $propertyName, ?string $label = null): YouTubeConnectField
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplateName('crud/field/text')
            ->setFormType(YouTubeConnectType::class)
            ->addCssClass('field-youtube-connect');
    }
}
