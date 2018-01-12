<?php

namespace DL\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DLFrontendBundle:Default:index.html.twig');
    }

    public function testAction()
    {
        // replace this example code with whatever you need

        $random = random_int(100, 10000);
        dump($random);
        return $this->render('DLFrontendBundle:Default:test.html.twig');
    }
}
