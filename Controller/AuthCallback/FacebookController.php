<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\AuthCallback;

use Facebook\Authentication\AccessToken;
use Martin1982\LiveBroadcastBundle\Exception\LiveBroadcastOutputException;
use Martin1982\LiveBroadcastBundle\Service\ChannelApi\FacebookApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FacebookController
 *
 * @Route("/auth")
 */
class FacebookController extends AbstractController
{
    /**
     * @var FacebookApiService
     */
    protected $facebookApi;

    /**
     * FacebookController constructor.
     *
     * @param FacebookApiService $facebookApi
     */
    public function __construct(FacebookApiService $facebookApi)
    {
        $this->facebookApi = $facebookApi;
    }

    /**
     * Request a long lived access token
     *
     * @Route("/fb-access-token", name="facebook_access_token")
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws LiveBroadcastOutputException
     */
    public function longLivedAccessTokenAction(Request $request): JsonResponse
    {
        $accessToken = $this->facebookApi->getLongLivedAccessToken($request->get('userAccessToken'));
        $response = new JsonResponse(null, 500);

        if ($accessToken instanceof AccessToken) {
            $response->setData(['accessToken' => $accessToken->getValue()]);
            $response->setStatusCode(200);
        }

        return $response;
    }
}
