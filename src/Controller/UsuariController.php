<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Usuari;

class UsuariController extends Controller
{
    /**
     * @Route("/usuaris", name="usuaris")
     */
    public function index()
    {
        //$user = $this->getUser();
        
        $user = $this->get('grupcontroller')->checkUser($this->getUser());

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
    public function assignarRol(Request $request) : JsonResponse {
        
        $em = $this->getDoctrine()->getManager();
        
        $usuari = $em->getRepository(Usuari::class)->findOneById($request->request->get('idUsuari'));

        $usuari->removeRole($usuari->getRoles()[0]);
        $usuari->setRoles(array($request->request->get('rol')));

        $em->persist($usuari);
        $em->flush();
        
        return new JsonResponse(['assignat' => true]);
    }

}
