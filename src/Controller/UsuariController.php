<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    /**
     * @Route("/afegir-usuari", name="afegirUsuari")
     */
    public function afegirUsuari(Request $request, UserPasswordEncoderInterface $encoder) {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $rols = $this->getParameter('security.role_hierarchy.roles');

        //si s'envia el formulari
        if($request->isMethod('post')) {

            $nom = $request->request->get('nom');
            $cognoms = $request->request->get('cognoms');
            $username = $request->request->get('username');
            $email = $request->request->get('email');
            $rol = $request->request->get('rol');
            $codi = $request->request->get('codi');

            $nouUsuari = new Usuari();

            $nouUsuari->setNom($nom);
            $nouUsuari->setCognoms($cognoms);
            $nouUsuari->setUsername($username);
            $nouUsuari->setUsernameCanonical($username);
            $nouUsuari->setEmail($email);
            $nouUsuari->setEmailCanonical($email);
            $nouUsuari->addRole($rol);
            if ($codi != '') {
                $nouUsuari->setCodiAlumne($codi);
            }

            //generem una contrassenya segura per a l'usuari, que s'enviarà per mail al correu indicat
            $length = 12;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $encodedPass = $encoder->encodePassword($nouUsuari, $randomString);
            $nouUsuari->setPassword($encodedPass);

            $em->persist($nouUsuari);
            $em->flush();

            $this->addFlash('success', 'Usuari creat correctament!');

        }

        return $this->render('usuari/afegirUsuari.html.twig', [
            'user' => $user,
            'rols' => $rols
        ]);
    }
}
