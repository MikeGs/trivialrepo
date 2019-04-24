<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Pregunta;

class PreguntaController extends AbstractController
{
    /**
     * @Route("/preguntes", name="preguntes")
     */
    public function index()
    {
    	$user = $this->getUser();

    	$em = $this->getDoctrine()->getManager();

    	$preguntes = $em->getRepository(Pregunta::class)->findAll();

        return $this->render('pregunta/index.html.twig', [
            'user' => $user,
            'preguntes' => $preguntes
        ]);
    }
}
