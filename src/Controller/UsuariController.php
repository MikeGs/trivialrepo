<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Usuari;

class UsuariController extends AbstractController
{
    /**
     * @Route("/usuaris", name="usuaris")
     */
    public function index()
    {
    	$user = $this->getUser();
    	$em = $this->getDoctrine()->getManager();
    	$usuaris = $em->getRepository(Usuari::class)->findAll();

        return $this->render('usuari/index.html.twig', [
        	'user' => $user,
            'usuaris' => $usuaris,
        ]);
    }
}
