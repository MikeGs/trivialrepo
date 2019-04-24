<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class PartidaController extends Controller
{
    /**
     * @Route("/joc", name="joc")
     */
    public function joc()
    {

        $title = "Trivial | UB";
        $user = $this->get('grupcontroller')->checkUser($this->getUser());

        return $this->render('partida/index.html.twig', [
            'controller_name' => 'PartidaController',
            'title' => $title,
            'user' => $user
        ]);
    }

    /**
     * @Route("/getPartidaPortait", name="getPartidaPortait")
     */
    public function getPartidaPortait() {
        
        $html = "
        <div class='container row'>
            <div id='cardPartida' class='col col-3 p-3'>
                <h3>Rànquing:</h3>
                <table id='rankingJugadors'>
                    <tr>
                        <th>Jugador</th>
                        <th>Puntuació</th>
                    </tr>
                </table>
                <a href='#' id='prepararPartida' class='btn btn-success'>Preparar</a>
            </div>
        </div>
        ";

        return new Response(
            $html
        );
    }
}
