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

    $html = "<div id='multiplayerLobby' class='row p-4 col-9'>

    <div class='container'>
        <h2>Sala d'espera | Partida multijugador</h2>
    </div>

    <div class='container row'>
    
        <div id='tipusPartidaSlider' class='col col-md-5 carousel slide' data-ride='carousel'>

            <div class='carousel-inner'>
                <div class='carousel-item active'>
                <img class='d-block w-100' src='#' alt='First slide'>
                </div>
                <div class='carousel-item'>
                <img class='d-block w-100' src='#' alt='Second slide'>
                </div>
                <div class='carousel-item'>
                <img class='d-block w-100' src='#' alt='Third slide'>
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
                <li><a href='#'>Player test 1</a></li>
                <li><a href='#'>Player test 2</a></li>
                <li><a href='#'>Player test 3</a></li>
                <li><a href='#'>Player test 4</a></li>
            </ul>
        </div>

    </div>

    <div class='container'>
        
        <div class='tableNormes'>
            <thead>
            <tr>
                <th>Normes</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Temps de resposta</td>
                <td><select id='tempsResposta'>
                        <option value='10'>10 segons</option>
                        <option value='15'>15 segons</option>
                        <option value='20'>20 segons</option>
                        <option value='25'>25 segons</option>
                </select></td>
            </tr>
            <tr>
                <td>Temps de resposta</td>
                <td>Damn</td>
            </tr>
            <tr>
                <td>Temps de resposta</td>
                <td>Damn2</td>
            </tr>
            </tbody>
        </table>

    </container>
        
    </div>";

    return new Response(
        $html
    );

    }
}
