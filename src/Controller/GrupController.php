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

        return $this->render('grup/index.html.twig',[
            'controller_name' => 'GrupController',
            'grups' =>  $grups,
            'nivells' => $nivells,
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

    public function getNivells() {

        $nivells = $this->getDoctrine()
            ->getRepository(Nivell::class)
            ->findAll();

        return $nivells;

    }

}
