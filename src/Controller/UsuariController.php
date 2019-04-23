<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Usuari;
use App\Entity\Grup;

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
        $grups = $em->getRepository(Grup::class)->findAll();
        $rols = $this->getParameter('security.role_hierarchy.roles');


        return $this->render('usuari/index.html.twig', [
        	'user' => $user,
            'usuaris' => $usuaris,
            'grups' => $grups,
            'rols' => $rols,
        ]);
    }

    /**
     * @Route("/assignar-rol", name="assignarRolAjax")
     */
    public function assignarRolAjax(Request $request) : JsonResponse {
        
        $em = $this->getDoctrine()->getManager();
        
        $usuari = $em->getRepository(Usuari::class)->findOneById($request->request->get('idUsuari'));
        
        $usuari->removeRole($usuari->getRoles()[0]);
        $usuari->setRoles(array($request->request->get('rol')));

        $em->persist($usuari);
        $em->flush();
        
        return new JsonResponse(['assignat' => true]);
    }

    /**
     * @Route("/assignar-grup", name="assignarGrupAjax")
     */
    public function assignarGrupAjax(Request $request) : JsonResponse {
        
        $em = $this->getDoctrine()->getManager();
        
        $usuari = $em->getRepository(Usuari::class)->findOneById($request->request->get('idUsuari'));
        
        $usuari->addGrup($em->getRepository(Grup::class)->findOneById($request->request->get('grup')));

        $em->persist($usuari);
        $em->flush();
        
        return new JsonResponse(['assignat' => true]);
    }

    /**
     * @Route("/llistar-grups-alumne", name="llistarGrupsAlumneAjax")
     */
    public function llistarGrupsAlumneAjax(Request $request) : JsonResponse {

        $em = $this->getDoctrine()->getManager();

        $usuari = $em->getRepository(Usuari::class)->findOneById($request->request->get('idUsuari'));
        $grups = $usuari->getGrups();

        $response = [];

        foreach ($grups as $grup) {
            $obj = [ 'id' => $grup->getId(),  'nom' => $grup->getNom() ];
            array_push($response, $obj);
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/eliminar-alumne", name="eliminarAlumneAjax")
     */
    public function eliminarUsuariAjax(Request $request) : JsonResponse {

        $em = $this->getDoctrine()->getManager();
        $usuari = $em->getRepository(Usuari::class)->findOneById($request->request->get('idUsuari'));

        $em->remove($usuari);
        $em->flush();

        return new JsonResponse(['eliminat' => true]);
    }
}
