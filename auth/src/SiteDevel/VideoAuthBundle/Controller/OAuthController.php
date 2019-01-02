<?php

namespace SiteDevel\VideoAuthBundle\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

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
    public function connectCheckAction(Request $request)
    {
        $clientRegistry = $this->get('knpu.oauth2.registry');
//        $clientRegistry = $this->get('knpu.oauth2.client.video_oauth');
        $client = $clientRegistry->getClient('video_oauth');

        try {
//            $user = $client->fetchUser();
            $accessToken = $client->getAccessToken();

            // e.g. $name = $user->getFirstName();
            var_dump($accessToken); die;
            // ...
        } catch (IdentityProviderException $e) {
            var_dump($e->getMessage()); die;
        }
    }
}
