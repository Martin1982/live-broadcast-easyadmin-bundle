<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FacebookConnectType
 */
class FacebookConnectType extends AbstractType
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
     * Build form type
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('accessToken', TextType::class);

        $builder->get('accessToken')
            ->addModelTransformer(new CallbackTransformer(
                static function($accessToken) {
                    return $accessToken;
                },
                static function($accessToken) {
                    $accessTokenValue = null;

                    if (is_array($accessToken)) {
                        $accessTokenValue = $accessToken['accessToken'];
                    }

                    return $accessTokenValue;
                }
            ));
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
        $resolver->setDefault('facebook_app_id', $this->facebookAppid);
    }
}
