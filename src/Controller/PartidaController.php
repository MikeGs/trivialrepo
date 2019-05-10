<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Usuari;
use App\Entity\Grup;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PartidaController extends Controller
{
    /**
     * @Route("/joc", name="joc")
     */
    public function joc()
    {

        $title = "Trivial | UB";

        return $this->render('partida/index.html.twig', [
            'controller_name' => 'PartidaController',
            'title' => $title,
        ]);
    }

    public function getNivells($grup) {
        $nivells = $grup->getIdNivell();
        return $nivells;
    }

    /**
     * @Route("/pw", name="pw")
     */
    public function pw() {

        $pw = "UABTESTING";
        $pwenc = md5($pw);

        return $pwenc;
    }

    /**
     * @Route("/getPartidaPortait", name="getPartidaPortait")
     */
    public function getPartidaPortait(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $grup = $em->getRepository(Grup::class)->findOneById($request->request->get('grup'));

        $html = "

        <script>   

        </script>

        <div id='multiplayerContainer' class='row p-4 col-9'>

            <div class='container'>
                <h2>Partida multijugador</h2>
            </div>

            <div class='container'>
                <h3>Grup: " . $grup->getNom() . "</h3>
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

            var url = '/partidaLobby/" . $grup->getId() . "'
            var codes;
    
            $.post(url) 
                .done(function(response) {
                    $('#contingutStart').html(response);
                });
            
            
    
        });

        </script>
        ";

        return new Response(
            $html
        );
    }

    public function getGrup($id) {

        $grup = $this->getDoctrine()
            ->getRepository(Grup::class)
            ->find($id);

        return $grup;

    }

    public function getUsuari($id) {
        
        $usuaris = $this->getDoctrine()
            ->getRepository(Usuari::class)
            ->find($id);

        return $usuaris;

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

    /**
     * @Route("/partidaLobby/{grupid}", name="partidaLobby")
     */
    function partidaLobby($grupid) {

    $grup = $this->getGrup($grupid);
    $user = $this->getUser();
    $jugadorsGrup = $this->getAlumnesCurs($grupid);

    $password = $this->pw();

    $nomdusuarilabel = "Nom d'usuari";

    $llistat = "";

    foreach($jugadorsGrup as $jugador) {

        if ($jugador["usuari_id"] != $user->getId()) {

            $encrypt = "encrypt('" . $jugador["usuari_id"] . "' , '" . $password . "')";

            $llistat = $llistat . "<tr>

            <script>
            
                function idencriptat() {

                    var password = '" . $password . "';
                    var id = " . $encrypt . ";

                    var iddes = decrypt(id, password);
                    var desencriptat = iddes.toString().substring(1, iddes.length);
                    
                    return id;

                }

            </script>

            <td class='elementLlistaJugadorTd'  >
            
                <a class='elementLlistaJugadors nodeco' name='". $jugador["nom"] . " " . $jugador["cognoms"] ."' id='jug". $jugador["usuari_id"] . "' secid='" . $jugador["usuari_id"] . "' href='#'>

                    <span class='jugadorNom'>
                        " . $jugador["nom"] . " " . $jugador["cognoms"] . "
                    </span> 

                </a>

                <script>

                    var idencriptat = idencriptat();
                    document.getElementById('jug" . $jugador["usuari_id"] . "').id = idencriptat;

                </script>

            </td>
            
        </tr>";

        }

    }

    $html = "
    
    <script>

    latestalumne = '';
    latestalumneid = '';
    latestalumneidenc = '';

    match = '';
    matchid = '';

    userid = '';

    //getPw();
    var pw = '" . $password . "';

    /*var encrypted = encrypt('Im testing this', 'a1e6239b392ad6a409609a02ff16cb66');
    var decrypted = decrypt(encrypted, 'a1e6239b392ad6a409609a02ff16cb66');*/

    console.log('" . $password . "')

    </script>

    <div id='multiplayerLobby' class='row p-4 col-9'>

    <div class='container'>
        <h2>Sala d'espera | Partida multijugador</h2>
    </div>

    <div class='container'>
        <h3>Grup: " . $grup->getNom() . "</h3>
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
                <li><a href='#' id='currentPlayer'><i class='fas fa-user mr-2'></i>" . $user->getUsername() . "</a></li>
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
        
    <div id='afegirJugadorModal' class='modal fade' tabindex='-1' role='dialog'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h6 class='modal-title' id='afegirJugadorModal'></h6>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div id='afegirJugadorModalMsg'>
                        <div class='form-group'>
                            <table class='col-12'>

                                <tr>
                                    <th scope='col'>Llistat de jugadors</th>
                                </tr>
                                " .

                                $llistat

                                . "
                            </table>
                            <input type='submit' name='Submit' value='Afegir' class='btn btn-primary disabled' id='afegirJugadorsBtn' data-grupid='{{ grup.id }}'>
                        </div>
                    </div>
                </div>
                <div class='modal-footer' id='afegirJugadorModalBtns'>
                </div>
            </div>
        </div>
    </div>

    <div id='iniciarSessioModal' class='modal fade' tabindex='-1' role='dialog'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h6 class='modal-title' id='iniciarSessioModal'></h6>
                    <button id='iniciarSessioModalClose' type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div id='iniciarSessioModalMsg'>
                        <div class='form-group'>
                            
                            <h2 id='iniciarSessioTitle' style='color: black!important'>Comprovar identitat</h2>

                            <label id='jugadorSeleccionatLabel'>Jugador sel.leccionat: <jugador id='jugadorSeleccionatLabelFill'></jugador></label>

                            <label for='nom'>" . $nomdusuarilabel . "</label>
                            <input id='usernameLogin' type='text' name='nom' placeholder='Usuari'/>

                            <label for='contrasenya'>Contrasenya</label>
                            <input id='passwordLogin' type='password' name='contrasenya'/>

                            <input type='submit' name='Submit' value='Iniciar sessió' class='btn btn-primary disabled' id='iniciarSessioModalBtn'>
                            <!-- data-usuariid='{{ usuari.id }}' -->
                        </div>
                    </div>
                </div>
                <div class='modal-footer' id='iniciarSessioModalBtns'>
                </div>
            </div>
        </div>
    </div>

    <script>
        
    $('body').on( 'click', '#afegirJugador', function() {

        $('#afegirJugadorModal').modal('show');

        $('body').on('click', '#afegirJugador', function() {
            $.get()
        });
    });

    $('#iniciarSessioModalClose').click(function() {

        $('#afegirJugadorModal').modal('show');

    });

    $('.elementLlistaJugadors').click(function() {

        latestalumneidenc = this.id;
        alert(this.getAttribute('secid'));
        latestalumneid = this.getAttribute('secid');
        latestalumne = this.name;

        $('#jugadorSeleccionatLabelFill').html(latestalumne);
        $('#usernameLogin, #passwordLogin').val('');

        $('#iniciarSessioModal').modal('show');
        $('#afegirJugadorModal').modal('hide');

        /*if (!$(this).hasClass('usuariSeleccionat')) {
            $(this).addClass('usuariSeleccionat');
        } else {
            $(this).removeClass('usuariSeleccionat');
        }*/
    })

    $('#iniciarSessioModalBtn').click(function() {

        var url = '/checklogin';
        var pass = pw;

        userid = latestalumneid;
        var useridenc = latestalumneidenc;
        var username = $('#usernameLogin').val();
        var pwd = $('#passwordLogin').val();

        $.post(url, { 'userid': userid, 'user': username, 'password': pwd, 'useridenc': useridenc }) 
		    .done(function(response) {
                match = response['match'];
                matchid = response['id'];

                savemematch(match, matchid);
			});
    });

    function savemematch(matchsent, matchidsent) {

        while(match == '') {
            match = matchsent;
            matchid = matchidsent;
        }

        console.log('Matchid actual' + matchid + ' matchid enviat: ' + matchidsent);

        if (readCookie('jugadors') != '') {

            if (latestalumneid == matchid) {
                writeCookie('jugadors', readCookie('jugadors') + ',' + matchid, 1);
            } else {
                $('#iniciarSessioModalMsg').html('" . `<div id='errorLogin'>
                <h2>Les credencials introduïdes no són vàlides</h2>
                <a href='#' class='btn btn-danger' id='errorLoginTornar'>Tornar</a>
            </div>` . "')
            }

        } else {
            writeCookie('jugadors', matchid, 1);
        }

        

        console.log(readCookie('jugadors'));
    }

    $('#afegirJugadorsBtn').click(function(e) {

        var usuarisSeleccionats = $('.usuariSeleccionat');
        var ids = [];
        var jugadors = [];

        $.each( usuarisSeleccionats, function( key, value ) {
            ids.push(value.id);
            var jugador = [value.id, value.name];
            jugadors.push(jugador);
        });

        console.log(jugadors);

        $('#afegirJugadorModal').modal('hide');

    });

    </script>

    </div>";

    return new Response(
        $html
    );

    }

    /**
     * @Route("/checklogin", name="checklogin")
     */
    public function checkLogin(Request $request) : JsonResponse {

        $userid = $request->request->get('userid');
        $idencrypted = $request->request->get('useridenc');
        $password = $request->request->get('password');

        $user = $this->getUsuari($userid);

        $encoderService = $this->container->get('security.password_encoder');
        $match = $encoderService->isPasswordValid($user, $password);

        return new JsonResponse(['match' => $match, 'id' => $user->getId()]);
        
    }

}

