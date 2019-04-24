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
    	$user = $this->getUser();
    	
    	return $this->render('inici/inici.html.twig', [
        	'user' => $user,
        ]);
    }
}