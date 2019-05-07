<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Pregunta;
use App\Entity\Nivell;
use App\Entity\Tema;
use App\Entity\Dificultat;
use App\Entity\TipusPregunta;

class PreguntaController extends AbstractController
{
    /**
     * @Route("/preguntes", name="preguntes")
     */
    public function index()
    {
        $authChecker = $this->container->get('security.authorization_checker');

        if (!$authChecker->isGranted('ROLE_TEACHER') && !$authChecker->isGranted('ROLE_ADMIN') && !$authChecker->isGranted('ROLE_STUDENT')) {

            return $this->redirectToRoute('fos_user_security_login');

        } else if (!$authChecker->isGranted('ROLE_TEACHER')) {

            return $this->redirectToRoute('joc');

        } 

    	$em = $this->getDoctrine()->getManager();

    	$preguntes = $em->getRepository(Pregunta::class)->findAll();

        return $this->render('pregunta/index.html.twig', [
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
    public function afegirPregunta(Request $request) {

        $authChecker = $this->container->get('security.authorization_checker');
        
        if (!$authChecker->isGranted('ROLE_TEACHER') && !$authChecker->isGranted('ROLE_ADMIN') && !$authChecker->isGranted('ROLE_STUDENT')) {

            return $this->redirectToRoute('fos_user_security_login');

        } else if ($authChecker->isGranted('ROLE_STUDENT')) {

            return $this->redirectToRoute('joc');

        } 

        $em = $this->getDoctrine()->getManager();
    
        $nivells = $em->getRepository(Nivell::class)->findAll();
        $dificultats = $em->getRepository(Dificultat::class)->findAll();
        $tipus = $em->getRepository(TipusPregunta::class)->findAll();

        if($request->isMethod('post')) {

            $pregunta = new Pregunta();
            $pregunta->setIdTema($em->getRepository(Tema::class)->findOneById($request->request->get('tema')));
            $pregunta->setIdDificultat($em->getRepository(Dificultat::class)->findOneById($request->request->get('dificultat')));
            $pregunta->setTipus($em->getRepository(TipusPregunta::class)->findOneById($request->request->get('tipus')));
            $pregunta->setActiva($request->request->get('estat'));
            $pregunta->setPreguntaCat($request->request->get('preguntaCat'));
            $pregunta->setPreguntaEs($request->request->get('preguntaEs'));
            $pregunta->setPreguntaEN($request->request->get('preguntaEn'));
            $pregunta->setRespostaCorrectaCat($request->request->get('correctaCat'));
            $pregunta->setRespostaCorrectaEs($request->request->get('correctaEs'));
            $pregunta->setRespostaCorrectaEn($request->request->get('correctaEn'));
            $pregunta->setRespostaIncorrecta1Cat($request->request->get('incorrectaCat1'));
            $pregunta->setRespostaIncorrecta2Cat($request->request->get('incorrectaCat2'));
            $pregunta->setRespostaIncorrecta3Cat($request->request->get('incorrectaCat3'));
            $pregunta->setRespostaIncorrecta1Es($request->request->get('incorrectaEs1'));
            $pregunta->setRespostaIncorrecta2Es($request->request->get('incorrectaEs2'));
            $pregunta->setRespostaIncorrecta3Es($request->request->get('incorrectaEs3'));
            $pregunta->setRespostaIncorrecta1En($request->request->get('incorrectaEn1'));
            $pregunta->setRespostaIncorrecta2En($request->request->get('incorrectaEn2'));
            $pregunta->setRespostaIncorrecta3En($request->request->get('incorrectaEn3'));

            $em->persist($pregunta);
            $em->flush();

            $this->addFlash('success', 'La pregunta s\'ha creat correctament!');
        }

        return $this->render('pregunta/afegirPregunta.html.twig', [
            'nivells' => $nivells,
            'dificultats' => $dificultats,
            'tipus' => $tipus,
        ]);
    }

    /**
     * @Route("/llistar-temes", name="llistaTemes")
     */
    public function llistaTemes(Request $request) : JsonResponse 
    {
        $em = $this->getDoctrine()->getManager();

        $temes = $em->getRepository(Tema::class)->findByIdNivell($request->request->get('nivell'));

        $response = array();
 
        foreach ($temes as $tema) {
            $temaJson = array();
            $temaJson['id'] = $tema->getId();
            $temaJson['nom'] = $tema->getNom();
            array_push($response, $temaJson);
        }

        return new JsonResponse($response);
    }
}
