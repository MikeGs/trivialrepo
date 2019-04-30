<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    /**
     * @Route("/canviar-estat-pregunta", name="canviarEstatPregunta")
     */
    public function canviarEstatPreguntaAjax(Request $request) : JsonResponse
    {
        
        $em = $this->getDoctrine()->getManager();

        $pregunta = $em->getRepository(Pregunta::class)->findOneById($request->request->get('idPregunta'));

        if ($pregunta->getActiva()) {
            $pregunta->setActiva(false);
            $estat = 0;
        } else {
            $pregunta->setActiva(true);
            $estat = 1;
        }

        $em->persist($pregunta);
        $em->flush();

        return new JsonResponse(['estat' => $estat]);
    }

    /**
     * @Route("/eliminar-pregunta", name="eliminarPreguntaAjax")
     */
    public function eliminarPreguntaAjax(Request $request) : JsonResponse {

        $em = $this->getDoctrine()->getManager();
        $pregunta = $em->getRepository(Pregunta::class)->findOneById($request->request->get('idPregunta'));

        $em->remove($pregunta);
        $em->flush();

        return new JsonResponse(['eliminada' => true]);
    }

    /**
     * @Route("/afegir-pregunta", name="afegirPregunta")
     */
    public function afegirUsuari(Request $request) {

        $user = $this->getUser();

        return $this->render('pregunta/afegirPregunta.html.twig', [
            'user' => $user,
          
        ]);
    }
}
