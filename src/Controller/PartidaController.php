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
        <div id='multiplayerContainer' class='container row p-4'>

            <div class='container'>
                <h2>Partida multijugador</h2>
            </div>

            <div id='verticalCardsContainer' class='container row'>

                <div class='verticalCard col col-2'>
                    <a href='#'>
                        <img src='#'/>
                        <p class='verticalCardDesc'>Juga amb els teus companys!</p>
                    </a>
                </div>

                <div class='verticalCard col col-2'>
                    <a href='#'>
                        <img src='#'/>
                        <p class='verticalCardDesc'>Treu la màxima puntuació!</p>
                    </a>
                </div>

                <div class='verticalCard col col-2'>
                    <a href='#'>
                        <img src='#'/>
                        <p class='verticalCardDesc'>Compara els teus resultats!</p>
                    </a>
                </div>

                <div class='verticalCard col col-2'>
                    <a href='#'>
                        <img src='#'/>
                        <p class='verticalCardDesc'>Entrena't per millorar!</p>
                    </a>
                </div>

            </div>

            <div id='multiHighlight' class='container row'>

                <div class='col col-4' id='playMultiplayerCard'>

                    <a href='#'>
                        <img src='#'/>
                        <p>Jugar</p>
                    </a>
                    
                </div>

                <div id='cardRanking' class='col col-4 p-4'>

                    <h3>Rànquing:</h3>

                    <table id='rankingJugadors'>
                        <tr>
                            <th>Jugador</th>
                            <th>Puntuació</th>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
        ";

        return new Response(
            $html
        );
    }
}
