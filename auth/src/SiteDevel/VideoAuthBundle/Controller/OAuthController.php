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
        $clientRegistry = $this->get('knpu.oauth2.client.video_oauth');

        return $clientRegistry->redirect(['video']);
    }

    /**
     * @param Request $request
     * @param ClientRegistry $clientRegistry
     */
    public function connectCheckAction(Request $request)
    {
        $clientRegistry = $this->get('knpu.oauth2.client.video_oauth');
        /** @var \KnpU\OAuth2ClientBundle\Client\Provider\FacebookClient $client */
        $client = $clientRegistry->getClient('video_oauth');

        try {
            /** @var \League\OAuth2\Client\Provider\FacebookUser $user */
            $user = $client->fetchUser();

            // e.g. $name = $user->getFirstName();
            var_dump($user); die;
            // ...
        } catch (IdentityProviderException $e) {
            var_dump($e->getMessage()); die;
        }
    }
}
