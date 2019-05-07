<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Grup;
use App\Entity\Usuari;
use App\Entity\Nivell;

use App\Form\GrupType;

use Symfony\Component\HttpFoundation\Request;

class GrupController extends Controller
{
    /**
     * @Route("/grups", name="grups")
     */
    public function index()
    {
        if (!$authChecker->isGranted('ROLE_TEACHER') && !$authChecker->isGranted('ROLE_ADMIN') && !$authChecker->isGranted('ROLE_STUDENT')) {

            return $this->redirectToRoute('fos_user_security_login');

        } else if (!$authChecker->isGranted('ROLE_TEACHER')) {

            return $this->redirectToRoute('joc');

        } 

        $title = "Grups | Trivial UB";
        $grups = $this->getGrups();
        $nivells = $this->getNivells();
        $administradors = $this->getAdministradors();
        $alumnes = $this->getAlumnes();

        return $this->render('grup/index.html.twig',[
            'controller_name' => 'GrupController',
            'grups' =>  $grups,
            'nivells' => $nivells,
            'administradors' => $administradors,
            'alumnes' => $alumnes,
            'title' => $title
        ]);

    }

    /**
     * @Route("/grup/{id}", name="alumnesGrup")
     */
    public function grup($id)
    {

        $title = "Grups | Trivial UB";
        $grup = $this->getGrup($id);
        $administradors = $this->getAdministradors();
        $alumnes = $this->getAlumnesCurs($id);

        $totsalumnes = $this->getTotsAlumnes();

        return $this->render('grup/llistatalumnes.html.twig',[
            'user' => $user,
            'controller_name' => 'GrupController',
            'grup' =>  $grup,
            'administradors' => $administradors,
            'alumnes' => $alumnes,
            'totsalumnes' => $totsalumnes,
            'title' => $title
        ]);

    }

    /**
     * @Route("/afegirgrup", name="afegirgrup")
     */
    public function new(Request $request)
    {
        if (!$authChecker->isGranted('ROLE_TEACHER') && !$authChecker->isGranted('ROLE_ADMIN') && !$authChecker->isGranted('ROLE_STUDENT')) {

            return $this->redirectToRoute('fos_user_security_login');

        } else if (!$authChecker->isGranted('ROLE_TEACHER')) {

            return $this->redirectToRoute('joc');

        } 
        
        $administradors = $this->getAdministradors();

        $grup = new Grup();
        $form = $this->createForm(GrupType::class, $grup);
        $form->handleRequest($request);

         if ($form->isSubmitted()) {
            echo "submitted";

            // id	id_nivell_id	nom	codi	datainici	datafinal	finalitzat	tempsresposta	id_administrador	puntuacio_facil	puntuacio_dificil

            $grup->setNom($form->get('nom')->getData());
            $grup->setCodi($form->get('codi')->getData());
            $grup->setDatainici($form->get('datainici')->getData());
            $grup->setDatafinal($form->get('datafinal')->getData());
            $grup->setFinalitzat(false);
            $grup->setTempsresposta($form->get('tempsresposta')->getData());
            $grup->setPuntuacioFacil($form->get('puntuacio_facil')->getData());
            $grup->setPuntuacioDificil($form->get('puntuacio_dificil')->getData());
            $grup->setIdAdministrador(1);
            $grup->setIdNivell($this->getNivell($form->get('idNivell')->getData()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($grup);
            $em->flush();

            return $this->redirect($this->generateUrl('grups'));
        }

        $title = "Afegir grup | Trivial UB";

        return $this->render('grup/afegir.html.twig', [
            'controller_name' => 'GrupController',
            'grup' => $grup,
            'form' => $form->CreateView(),
            'title' => $title,
            'administradors' => $administradors,
            
        ]);
    }


    public function getGrups() {

        $grups = $this->getDoctrine()
            ->getRepository(Grup::class)
            ->findAll();

        return $grups;

    }

    public function getGrup($id) {

        $grup = $this->getDoctrine()
            ->getRepository(Grup::class)
            ->find($id);

        return $grup;

    }

    public function getUsuaris() {
        
        $usuaris = $this->getDoctrine()
            ->getRepository(Usuari::class)
            ->findAll();

        return $usuaris;

    }

    public function getUsuari($id) {
        
        $usuaris = $this->getDoctrine()
            ->getRepository(Usuari::class)
            ->find($id);

        return $usuaris;

    }

    public function getAdministradors() {

        $em = $this->getDoctrine()->getManager();

        $administradors = $em->getRepository(Usuari::class)->createQueryBuilder('u')
            ->where('u.roles like :text')
            ->setParameter('text', '%'.'ROLE_TEACHER'.'%')
            ->getQuery()
            ->getResult();

        return $administradors;

    }

    public function getAlumnes() {

        $em = $this->getDoctrine()->getManager();

            $connection = $em->getConnection();
            $statement = $connection->prepare("SELECT * FROM grup_usuari");
            $statement->execute();
            $alumnes = $statement->fetchAll();

        return $alumnes;

    }

    public function getTotsAlumnes() {

        $em = $this->getDoctrine()->getManager();

        $alumnes = $em->getRepository(Usuari::class)->createQueryBuilder('u')
            ->where('u.roles like :text')
            ->setParameter('text', '%'.'ROLE_STUDENT'.'%')
            ->getQuery()
            ->getResult();

        return $alumnes;

    }

    public function getAlumnesCurs($idCurs) {
        
        $em = $this->getDoctrine()->getManager();

            $connection = $em->getConnection();
            $statement = $connection->prepare("SELECT gu.grup_id, gu.usuari_id, u.nom, u.cognoms, u.last_login 
            from grup_usuari gu inner join usuari u on gu.usuari_id = u.id 
            where gu.grup_id = " . $idCurs);
            $statement->execute();
            $alumnes = $statement->fetchAll();

            return $alumnes;
    }

    public function getAlumnesDetailed() {

        $em = $this->getDoctrine()->getManager();

        $alumnesDetailed = $em->getRepository(Usuari::class)->createQueryBuilder('u')
            ->where('u.roles like :text')
            ->setParameter('text', '%'.'ROLE_STUDENT'.'%')
            ->getQuery()
            ->getResult();

        return $alumnesDetailed;

    }

    public function getNivells() {

        $nivells = $this->getDoctrine()
            ->getRepository(Nivell::class)
            ->findAll();

        return $nivells;

    }

    public function getNivell($id) {

        $nivell = $this->getDoctrine()
            ->getRepository(Nivell::class)
            ->findOneBy(array('id' => $id));

        return $nivell;

    }

    /**
     * @Route("/afegirAlumnes", name="afegirAlumnes")
     */
    public function afegirAlumnes(Request $request) : JsonResponse {
        
        $em = $this->getDoctrine()->getManager();
        $alumnes = $request->request->get('Usuaris');
        $grup = $em->getRepository(Grup::class)->findOneById($request->request->get('Grup'));

        foreach($alumnes as $alumne) {
            $alumne = $em->getRepository(Usuari::class)->findOneById($alumne);
            $grup->addIdUsuari($alumne);
        }
        
        $em->persist($grup);
        $em->flush();
        
        return new JsonResponse(['afegits' => true]);
    }

    /**
     * @Route("/desvincular-alumne-grup", name="desvincularAlumneGrup")
     */
    public function eliminarAlumneDeGrupAjax(Request $request) : JsonResponse {

        $em = $this->getDoctrine()->getManager();

        $usuari = $em->getRepository(Usuari::class)->findOneById($request->request->get('idUsuari'));

        $grups = $usuari->getGrups();

        foreach ($grups as $grup) {
            if ($grup->getId() == $request->request->get('idGrup')) {
                $usuari->removeGrup($grup);
                $em->flush();
            }
        }

        return new JsonResponse(['desvinculat' => true]);
    }

}
