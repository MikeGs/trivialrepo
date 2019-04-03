<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Grup;
use App\Entity\Usuari;
use App\Entity\Nivell;

use App\Form\GrupType;

use Symfony\Component\HttpFoundation\Request;

class GrupController extends AbstractController
{
    /**
     * @Route("/grups", name="grups")
     */
    public function index()
    {

        $user = $this->getUser();
        $title = "Grups | Trivial UB";
        $grups = $this->getGrups();
        $nivells = $this->getNivells();
        $administradors = $this->getAdministradors();
        $alumnes = $this->getAlumnes();

        return $this->render('grup/index.html.twig',[
            'user' => $user,
            'controller_name' => 'GrupController',
            'grups' =>  $grups,
            'nivells' => $nivells,
            'administradors' => $administradors,
            'alumnes' => $alumnes,
            'title' => $title
        ]);

    }

    /**
     * @Route("/afegirgrup", name="afegirgrup")
     */
    public function new(Request $request)
    {
        $administradors = $this->getAdministradors();
        $user = $this->getUser();
        $grup = new Grup();
        $form = $this->createForm(GrupType::class, $grup);
        $form->handleRequest($request);

         if ($form->isSubmitted()) {
            echo "submitted";

            // id	id_nivell_id	nom	codi	datainici	datafinal	finalitzat	tempsresposta	id_administrador	puntuacio_facil	puntuacio_mitja	puntuacio_dificil

            $grup->setNom($form->get('nom')->getData());
            $grup->setCodi($form->get('codi')->getData());
            $grup->setDatainici($form->get('datainici')->getData());
            $grup->setDatafinal($form->get('datafinal')->getData());
            $grup->setFinalitzat(false);
            $grup->setTempsresposta($form->get('tempsresposta')->getData());
            $grup->setPuntuacioFacil($form->get('puntuacio_facil')->getData());
            $grup->setPuntuacioMitja($form->get('puntuacio_mitja')->getData());
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
            'user' => $user,
            'administradors' => $administradors,
            
        ]);
    }


    public function getGrups() {

        $grups = $this->getDoctrine()
            ->getRepository(Grup::class)
            ->findAll();

        return $grups;

    }

    public function getUsuaris() {
        
        $usuaris = $this->getDoctrine()
            ->getRepository(Usuari::class)
            ->findAll();

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

        /*$alumnes = $em->getRepository(Usuari::class)->createQueryBuilder('u')
            ->where('u.roles like :text')
            ->setParameter('text', '%'.'ROLE_USER'.'%')
            ->getQuery()
            ->getResult();*/

            $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
            $connection = $em->getConnection();
            $statement = $connection->prepare("SELECT * FROM grup_usuari");
            $statement->execute();
            $alumnes = $statement->fetchAll();

        return $alumnes;

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

}
