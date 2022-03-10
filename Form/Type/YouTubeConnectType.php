<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Form\Type;

use Martin1982\LiveBroadcastBundle\Exception\LiveBroadcastException;
use Martin1982\LiveBroadcastBundle\Exception\LiveBroadcastOutputException;
use Martin1982\LiveBroadcastBundle\Service\ChannelApi\Client\GoogleClient;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class YouTubeConnectType
 */
class YouTubeConnectType extends TextType
{
    /**
     * @var GoogleClient
     */
    protected GoogleClient $googleClient;

    /**
     * @var RequestStack
     */
    protected RequestStack $requestStack;

    /**
     * YouTubeConnectType constructor.
     *
     * @param GoogleClient $googleClient
     * @param RequestStack $requestStack
     */
    public function __construct(GoogleClient $googleClient, RequestStack $requestStack)
    {
        $this->googleClient = $googleClient;
        $this->requestStack = $requestStack;
    }

    /**
     * Build form view
     *
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     *
     * @return void
     *
     * @throws LiveBroadcastException
     * @throws LiveBroadcastOutputException
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $client = $this->googleClient->getClient();

        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            $request = new Request();
        }

        $session = $request->getSession();
        $refreshToken = $session->get('youTubeRefreshToken');
        if ($refreshToken) {
            $client->fetchAccessTokenWithRefreshToken($refreshToken);
        }

        $accessToken = $client->getAccessToken();
        $isAuthenticated = (bool) $accessToken;
        $state = mt_rand();

        if (!$isAuthenticated) {
            $session->set('state', $state);
            $session->set('authreferer', $request->getRequestUri());
        }

        $client->setState($state);

        parent::buildView($view, $form, $options);
        $view->vars['isAuthenticated'] = $isAuthenticated;
        $view->vars['authUrl'] = $isAuthenticated ? '#' : $client->createAuthUrl();
        $view->vars['youTubeChannelName'] = $session->get('youTubeChannelName');
        $view->vars['youTubeRefreshToken'] = $session->get('youTubeRefreshToken');
    }

    /**
     * Get block prefix name
     *
     * @return string|null
     */
    public function getBlockPrefix(): string
    {
        return 'you_tube_connect';
    }
}
