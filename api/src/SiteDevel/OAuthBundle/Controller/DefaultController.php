<?php

namespace SiteDevel\OAuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiteDevelOAuthBundle:Default:index.html.twig');
    }
}
