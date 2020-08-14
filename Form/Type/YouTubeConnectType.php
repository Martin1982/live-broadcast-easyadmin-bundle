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
 * Class YouTubeConnectType
 */
class YouTubeConnectType extends TextType
{
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
        $view->vars['youTubeChannelName'] = $options['you_tube_channel_name'];
        $view->vars['authUrl'] = $options['auth_url'];
        $view->vars['youTubeRefreshToken'] = $options['you_tube_refresh_token'];
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
        $resolver->setDefault('you_tube_channel_name', '');
        $resolver->setDefault('auth_url', '');
        $resolver->setDefault('you_tube_refresh_token', '');
    }
}
