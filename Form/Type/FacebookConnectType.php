<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FacebookConnectType
 */
class FacebookConnectType extends TextType
{
    /**
     * @var string
     */
    protected $facebookAppid = '';

    /**
     * FacebookConnectType constructor.
     *
     * @param string $facebookAppId
     */
    public function __construct($facebookAppId)
    {
        $this->facebookAppid = $facebookAppId;
    }

    /**
     * Build form view
     *
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     *
     * @return void
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);
        $view->vars['facebookAppId'] = $options['facebook_app_id'];
    }

    /**
     * Configure form options
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefault('facebook_app_id', $this->facebookAppid);
    }

    /**
     * Get block prefix name
     *
     * @return string|null
     */
    public function getBlockPrefix(): string
    {
        return 'facebook_connect';
    }
}
