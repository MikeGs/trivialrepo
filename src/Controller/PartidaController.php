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
            'user' => $user,
        ]);
    }

    /**
     * @Route("/getPartidaPortait", name="getPartidaPortait")
     */
    public function getPartidaPortait() {

        $html = "

        <div id='multiplayerContainer' class='row p-4 col-9'>

            <div class='container'>
                <h2>Partida multijugador</h2>
            </div>

            <div id='verticalCardsContainer' class='container row'>

                <div id='vertical1' class='verticalCard col col-md-3'>
                    <a href='#'>
                    
                        <p class='verticalCardDesc alltransition3'>Juga amb els teus companys!</p>
                    </a>
                </div>

                <div id='vertical2' class='verticalCard col col-md-3'>
                    <a href='#'>
                        
                        <p class='verticalCardDesc alltransition3'>Treu la màxima puntuació!</p>
                    </a>
                </div>

                <div id='vertical3' class='verticalCard col col-md-3'>
                    <a href='#'>
                        
                        <p class='verticalCardDesc alltransition3'>Compara els teus resultats!</p>
                    </a>
                </div>

                <div id='vertical4' class='verticalCard col col-md-3'>
                    <a href='#'>
                        
                        <p class='verticalCardDesc alltransition3'>Entrena't per millorar!</p>
                    </a>
                </div>

            </div>

            <div id='multiHighlight' class='container row'>

                <div id='playMultiplayerCard' class='col col-md-5'>

                    <a href='#' id='playButton'>
                        
                        <p>Jugar</p>
                    </a>
                    
                </div>

                <div id='cardRanking' class='col col-md-7 p-7'>

                    <h3>Rànquing:</h3>

                    <table id='rankingJugadors'>
                    <thead>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>Jugador</th>
                            <th scope='col'>Puntuació</th>
                        </tr>
                    </thead>
                    <tbody style='border-top: 1px solid white'>
                    </tbody>
                    </table>
                </div>

            </div>
        </div>
        <script>

        rankingMultiplayer = $('#rankingJugadors').dataTable( {
            'language': {
                'url': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Catalan.json'
            }
        });

        $('#playButton').click(function() {

            var url = '/partidaLobby'
            var codes;
    
            $.post(url) 
                .done(function(response) {
                    $('#contingutStart').html(response);
                });
            
            asActive('#partidaBtn');
    
        });

        </script>
        ";

        return new Response(
            $html
        );
    }

    /**
     * @Route("/partidaLobby", name="partidaLobby")
     */
    function partidaLobby() {

    $user = $this->get('grupcontroller')->checkUser($this->getUser());
    $currentPlayer = $user->getUsername();

    

    $html = "<div id='multiplayerLobby' class='row p-4 col-9'>

    <div class='container'>
        <h2>Sala d'espera | Partida multijugador</h2>
    </div>

    <div class='container row' id='topLobby'>
    
        <div id='tipusPartidaSlider' class='col col-md-6 carousel slide' data-ride='carousel'>

            <div class='carousel-inner'>
                <div class='carousel-item active'>
                    <p class='ontopCarousel'>Partida multijugador</p>
                </div>
                <div class='carousel-item'>
                    <p class='ontopCarousel'>Entrenament</p>
                </div>
            </div>

            <a class='carousel-control-prev' href='#tipusPartidaSlider' role='button' data-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                <span class='sr-only'>Previous</span>
            </a>

            <a class='carousel-control-next' href='#tipusPartidaSlider' role='button' data-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                <span class='sr-only'>Next</span>
            </a>

        </div>

        <div id='playerList' class='col col-md-4'>
            <ul>
                <li id='playerListHead'>Jugadors:</li>
                <li><a href='#' id='currentPlayer'><i class='fas fa-user mr-2'></i>" . $currentPlayer . "</a></li>
            </ul>
            <a href='#' class='btn btn-info' id='afegirJugador'>Afegir jugador</a>
        </div>

    </div>

    <div class='container' id='containerNormes'>
        
        <ul class='tableNormes col col-6'>
            <li class='row tableHead'>
                <p>Normes</p>
            </li>
            <li class='row'>
                <p class='col col-md-6'>Temps de resposta</p>
                <p class='col col-md-6'>10 segons</p>
            </li>
            <li class='row'>
                <p class='col col-md-6'>Nivell</p>
                <p class='col col-md-6'><select id='selectNivell'>
                    <option value='q3'>Q3</option>
                    <option value='q4'>Q4</option>
                    <option value='e5'>E5</option>
            </select></p>
            </li>
            <li class='row'>
                <p class='col col-md-6'>Duració aproximada</p>
                <p class='col col-md-6'>60 minuts</p>
            </li>
            <li class='row'>
                <p class='col col-md-6'>Formatgets</p>
                <p class='col col-md-6'>5</p>
            </li>
        </ul>

    </container>
        
    </div>";

    return new Response(
        $html
    );

    }
}
