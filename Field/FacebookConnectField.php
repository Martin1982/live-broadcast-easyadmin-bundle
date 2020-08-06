<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Martin1982\LiveBroadcastEasyadminBundle\Form\Type\FacebookConnectType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class FacebookConnectField
 */
class FacebookConnectField implements FieldInterface
{
    use FieldTrait;

    /**
     * Make a new preconfigured field
     *
     * @param string      $propertyName
     * @param string|null $label
     *
     * @return FacebookConnectField
     */
    public static function new(string $propertyName, ?string $label = null)
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplatePath('@LiveBroadcastEasyadmin/crud/field/facebook_connect.html.twig')
            ->setFormType(FacebookConnectType::class)
            ->addCssClass('field-facebook-connect');
    }
}
