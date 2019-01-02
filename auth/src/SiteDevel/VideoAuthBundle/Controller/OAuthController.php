<?php

namespace SiteDevel\VideoAuthBundle\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OAuthController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function connectAction()
    {
        $clientRegistry = $this->get('knpu.oauth2.registry');
        $client = $clientRegistry->getClient('video_oauth');

        return $client->redirect(['video']);
    }

    /**
     * @param Request $request
     * @param ClientRegistry $clientRegistry
     */
    public function connectCheckAction()
    {
        $clientRegistry = $this->get('knpu.oauth2.registry');
        $client = $clientRegistry->getClient('video_oauth');

        try {
            /** @var AccessToken $accessToken */
            $accessToken = $client->getAccessToken();

            return new Response(
                sprintf("Use header:\nAUTHORIZATION: Bearer %s", $accessToken->getToken()),
                Response::HTTP_OK,
                [
                    'Content-Type' => 'text/plain',
                ]
            );
        } catch (IdentityProviderException $e) {
            var_dump($e->getMessage()); die;
        }
    }
}
