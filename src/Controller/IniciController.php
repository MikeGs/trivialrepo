<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IniciController extends AbstractController
{

	/**
     * @Route("/", name="inici")
     */
	public function index()
    {
    	$authChecker = $this->container->get('security.authorization_checker');

    	if (!$authChecker->isGranted('ROLE_TEACHER') && !$authChecker->isGranted('ROLE_ADMIN') && !$authChecker->isGranted('ROLE_STUDENT')) {

    		return $this->redirectToRoute('fos_user_security_login');

    	} else if ($authChecker->isGranted('ROLE_STUDENT')) {

    		return $this->redirectToRoute('joc');

    	}

    	return $this->render('inici/inici.html.twig', [

        ]);
    }
}