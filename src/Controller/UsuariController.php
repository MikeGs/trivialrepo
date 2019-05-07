<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Exception\UniqueConstraintViolationException;

use App\Entity\Usuari;
use App\Entity\Grup;

class UsuariController extends Controller
{
    /**
     * @Route("/usuaris", name="usuaris")
     */
    public function index()
    {
        $authChecker = $this->container->get('security.authorization_checker');

        if (!$authChecker->isGranted('ROLE_TEACHER') && !$authChecker->isGranted('ROLE_ADMIN') && !$authChecker->isGranted('ROLE_STUDENT')) {

            return $this->redirectToRoute('fos_user_security_login');

        } else if (!$authChecker->isGranted('ROLE_TEACHER')) {

            return $this->redirectToRoute('joc');

        } else if (!$authChecker->isGranted('ROLE_ADMIN')) {

            return $this->redirectToRoute('inici');
        }

    	$em = $this->getDoctrine()->getManager();
    	$usuaris = $em->getRepository(Usuari::class)->findAll();
        $grups = $em->getRepository(Grup::class)->findAll();
        $rols = $this->getParameter('security.role_hierarchy.roles');


        return $this->render('usuari/index.html.twig', [
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

        $authChecker = $this->container->get('security.authorization_checker');

        if (!$authChecker->isGranted('ROLE_TEACHER') && !$authChecker->isGranted('ROLE_ADMIN') && !$authChecker->isGranted('ROLE_STUDENT')) {

            return $this->redirectToRoute('fos_user_security_login');

        } else if ($authChecker->isGranted('ROLE_STUDENT')) {

            return $this->redirectToRoute('joc');

        } else if (!$authChecker->isGranted('ROLE_ADMIN')) {

            return $this->redirectToRoute('inici');
        }

        $em = $this->getDoctrine()->getManager();

        $rols = $this->getParameter('security.role_hierarchy.roles');

        //si s'envia el formulari
        if($request->isMethod('post')) {

            $nom = $request->request->get('nom');
            $cognoms = $request->request->get('cognoms');
            $username = $request->request->get('username');
            $email = $request->request->get('email');
            $rol = $request->request->get('rol');
            if ($rol == 'ROLE_STUDENT') {
                $codi = $request->request->get('codi');
            }

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

            $nouUsuari->setEnabled(true);

            $em->persist($nouUsuari);
            $em->flush();

            $this->addFlash('success', 'Usuari creat correctament!' . $randomString);

        }

        return $this->render('usuari/afegirUsuari.html.twig', [
            'rols' => $rols
        ]);
    }


    /**
     * @Route("/comprovar-username", name="comprovarUsername")
     */
    public function comprovarUsername(Request $request) : JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $usuari = $em->getRepository(Usuari::class)->findOneByUsername($request->request->get('username'));

        if ($usuari != null) {
            $response = true;
        } else {
            $response = false;
        }

        return new JsonResponse($response);
    }


    /**
     * @Route("/comprovar-email", name="comprovarEmail")
     */
    public function comprovarEmail(Request $request) : JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $email = $em->getRepository(Usuari::class)->findOneByEmail($request->request->get('email'));

        if ($email != null) {
            $response = true;
        } else {
            $response = false;
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/comprovar-codi", name="comprovarCodi")
     */
    public function comprovarCodi(Request $request) : JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $codi = $em->getRepository(Usuari::class)->findOneByCodiAlumne($request->request->get('codi'));

        if ($codi != null) {
            $response = true;
        } else {
            $response = false;
        }

        return new JsonResponse($response);
    }
}
