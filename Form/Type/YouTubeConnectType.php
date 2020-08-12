<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class YouTubeConnectType
 */
class YouTubeConnectType extends AbstractType
{
    /**
     * Build form type
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('refreshToken', TextType::class)
            ->add('youTubeChannelName', TextType::class);
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
        $resolver->setDefault('you_tube_channel_name', '');
        $resolver->setDefault('auth_url', '');
        $resolver->setDefault('you_tube_refresh_token', '');
    }
}
