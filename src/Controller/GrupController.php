<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Grup;
use App\Entity\Usuari;
use App\Entity\Nivell;

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
