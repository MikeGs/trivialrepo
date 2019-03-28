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
     * @Route("/", name="index")
     */
    public function index()
    {

        $title = "Grups | Trivial UB";
        $grups = $this->getGrups();
        $nivells = $this->getNivells();
        $administradors = $this->getAdministradors();

        return $this->render('grup/index.html.twig',[
            'controller_name' => 'GrupController',
            'grups' =>  $grups,
            'nivells' => $nivells,
            'administradors' => $administradors,
            'title' => $title
        ]);

    }

    /**
     * @Route("/afegirgrup", name="afegirgrup")
     */
    public function new(Request $request)
    {
        $grup = new Grup();
        $form = $this->createForm(GrupType::class, $grup);
        $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {

            //id	id_nivell_id	nom	codi	datainici	datafinal	//finalitzat	tempsresposta	//id_administrador

            $grup->setNom($form->get('nom')->getData());
            $grup->setCodi($form->get('codi')->getData());
            $grup->setDatainici($form->get('datainici')->getData());
            $grup->setDatafinal($form->get('datafinal')->getData());
            $grup->setFinalitzat(false);
            $grup->setTempsresposta($form->get('tempsresposta')->getData());
            $grup->setPuntuacioFacil($form->get('facil')->getData());
            $grup->setPuntuacioMitja($form->get('mitja')->getData());
            $grup->setPuntuacioDificil($form->get('dificil')->getData());

            /*$producte->setNom($form->get('nom')->getData());
            $producte->setDescripcio($form->get('descripcio')->getData());
            $producte->setCategoriaId($form->get('categoria_id')->getData());
            $producte->setPreu($form->get('preu')->getData());*/

            $em = $this->getDoctrine()->getManager();
            $em->persist($grup);
            $em->flush();

            return $this->redirect($this->generateUrl('index'));
        }

        $title = "Afegir grup | Trivial UB";

        return $this->render('grup/afegir.html.twig', [
            'controller_name' => 'GrupController',
            'title' => $title,
            
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

    public function getNivells() {

        $nivells = $this->getDoctrine()
            ->getRepository(Nivell::class)
            ->findAll();

        return $nivells;

    }

}
