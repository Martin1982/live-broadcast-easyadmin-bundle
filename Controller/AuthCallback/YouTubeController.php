<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\AuthCallback;

use Martin1982\LiveBroadcastBundle\Exception\LiveBroadcastOutputException;
use Martin1982\LiveBroadcastBundle\Service\ChannelApi\Client\GoogleClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class YouTubeController
 */
class YouTubeController extends AbstractController
{
    /**
     * @var GoogleClient
     */
    protected GoogleClient $clientService;

    /**
     * YouTubeController constructor.
     *
     * @param GoogleClient $youTubeApi
     */
    public function __construct(GoogleClient $youTubeApi)
    {
        $this->clientService = $youTubeApi;
    }

    /**
     * Callback for authorization
     *
     * @Route("/martin1982/channel/youtube/oauthprovider", name="martin1982_livebroadcast_youtubeoauth")
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws LiveBroadcastOutputException
     */
    public function adminAuthAction(Request $request): Response
    {
        $session = $request->getSession();

        if ($request->get('cleartoken')) {
            $this->clearToken($session);
        }

        $requestCode = $request->get('code');
        if ($requestCode) {
            $this->checkRequestCode($request, $session);
        }

        return $this->redirect($session->get('authreferer', '/'));
    }

    /**
     * @param SessionInterface $session
     *
     * @throws ServiceNotFoundException
     * @throws ServiceCircularReferenceException
     * @throws LiveBroadcastOutputException
     */
    protected function clearToken(SessionInterface $session): void
    {
        $session->remove('youTubeRefreshToken');

        $googleClient = $this->getGoogleClient();
        $googleClient->revokeToken();
    }

    /**
     * @param Request          $request
     * @param SessionInterface $session
     *
     * @throws ServiceNotFoundException
     * @throws ServiceCircularReferenceException
     * @throws LiveBroadcastOutputException
     */
    protected function checkRequestCode(Request $request, SessionInterface $session): void
    {
        $requestCode = $request->get('code');
        $requestState = (string) $request->get('state', 'norequeststate');
        $sessionState = (string) $session->get('state', 'nosessionstate');

        $googleClient = $this->getGoogleClient();

        if ($sessionState !== $requestState || $googleClient->isAccessTokenExpired()) {
            $googleClient->fetchAccessTokenWithAuthCode($requestCode);
            $googleClient->getAccessToken();
        }
        $refreshToken = $googleClient->getRefreshToken();

        if ($refreshToken) {
            $youtubeClient = new \Google_Service_YouTube($googleClient);
            $channels = $youtubeClient->channels->listChannels('id,brandingSettings', [ 'mine' => true ]);

            $hasChannels = $channels->count() > 0;

            if ($hasChannels) {
                /** @var \Google_Service_YouTube_Channel $channel */
                $channel = $channels->current();

                $branding = $channel->getBrandingSettings();
                $title = $branding->getChannel()->title;

                $session->set('youTubeChannelName', $title);
                $session->set('youTubeRefreshToken', $refreshToken);
            }
        }
    }

    /**
     * @return \Google_Client
     *
     * @throws ServiceNotFoundException
     * @throws ServiceCircularReferenceException
     * @throws LiveBroadcastOutputException
     */
    private function getGoogleClient(): \Google_Client
    {
        return $this->clientService->getClient();
    }
}
