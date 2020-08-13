<?php declare(strict_types=1);

/**
 * live-broadcast-easyadmin-bundle - All rights reserved
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Controller\AuthCallback;

use Facebook\Authentication\AccessToken;
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
     * Request a long lived access token
     *
     * @Route("/fb-access-token", name="facebook_access_token")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function longLivedAccessTokenAction(Request $request): JsonResponse
    {
        $facebookService = $this->get('live.broadcast.facebook_api.service');
        $accessToken = $facebookService->getLongLivedAccessToken($request->get('userAccessToken'));
        $response = new JsonResponse(null, 500);

        if ($accessToken instanceof AccessToken) {
            $response->setData(['accessToken' => $accessToken->getValue()]);
            $response->setStatusCode(200);
        }

        return $response;
    }
}
