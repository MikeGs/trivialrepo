<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $rols = $this->getParameter('security.role_hierarchy.roles');


        return $this->render('usuari/index.html.twig', [
        	'user' => $user,
            'usuaris' => $usuaris,
            'rols' => $rols,
        ]);
    }

    /**
     * @Route("/assignarRol", name="assignarRol")
     */
    public function assignarRol(Request $request) {
        

    }
}
