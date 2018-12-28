<?php

namespace SiteDevel\VideoAuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('@SiteDevelVideoAuth/Default/index.html.twig');
    }
}
