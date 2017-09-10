<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need


        if ($this->getUser() != null) {
            var_dump($this->getUser()->getUsername());
            var_dump($this->getUser()->getRoles());
            if ($this->getUser()->hasRole('ROLE_SUPER_ADMIN')) {
                var_dump("Connected as SUPER ADMIN !");
            }
        } else {
            var_dump("pas connecté !");
        }
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }
}
