<?php

namespace NebulaFlow\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="main_home")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    /**
     * @Route("/about", name="main_about")
     * @Template()
     */
    public function aboutAction()
    {
        return array();
    }
}
