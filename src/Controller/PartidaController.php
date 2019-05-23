<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Usuari;
use App\Entity\Grup;
use App\Entity\Tema;
use App\Entity\Nivell;
use App\Entity\Pregunta;
use App\Entity\Dificultat;
use App\Entity\Partida;
use App\Entity\TipusPartida;
use App\Entity\TemaPartida;

use Symfony\Component\Validator\Constraints\DateTime;

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

        return $this->render('partida/inici.html.twig', [
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
     * @Route("/jugar", name="jugar")
     */
    public function jugar(Request $request) {


        return $this->render('partida/joc.html.twig', [
           
        ]);
    }

    /**
     * @Route("/get-temes", name="getTemes")
     */
    public function getTemes(Request $request) : JsonResponse {

        $em = $this->getDoctrine()->getManager();

        $grup = $em->getRepository(Grup::class)->findOneById($request->request->get('grup'));
        $nivell = $this->getNivellGrup($grup);

        $temes = $em->getRepository(Tema::class)->findByIdNivell($nivell);

        $maxRand = count($temes);

        $temesPartida = array();

        $temesSel = false;
        $count = 0;
        do {
            $num = rand(1, $maxRand);
            $tema = $temes[$num-1];
            if (!in_array($tema, $temesPartida)) {
                array_push($temesPartida, $tema);
                $count++;
            } 
            if ($count == 5) {
                $temesSel = true;
            }
        } while (!$temesSel);

        return new JsonResponse([
            'tema1' => $temesPartida[0]->getId(),
            'tema1nom' => $temesPartida[0]->getNom(),
            'tema2' => $temesPartida[1]->getId(),
            'tema2nom' => $temesPartida[1]->getNom(),
            'tema3' => $temesPartida[2]->getId(),
            'tema3nom' => $temesPartida[2]->getNom(),
            'tema4' => $temesPartida[3]->getId(),
            'tema4nom' => $temesPartida[3]->getNom(),
            'tema5' => $temesPartida[4]->getId(),
            'tema5nom' => $temesPartida[4]->getNom(),
        ]);
    }

    /**
     * @Route("/get-pregunta", name="getPregunta_ajax")
     */
    public function getPreguntaAJAX(Request $request) : JsonResponse {

        $em = $this->getDoctrine()->getManager();

        $tema = $em->getRepository(Tema::class)->findOneById($request->request->get('tema'));

        if ($request->request->get('quesito') == true) {
            $dificultat = $em->getRepository(Dificultat::class)->findOneById(2);
        } else {
            $dificultat = $em->getRepository(Dificultat::class)->findOneById(1);
        }

        $preguntes = $em->getRepository(Pregunta::class)->findBy(['idTema' => $tema, 'idDificultat' => $dificultat, 'activa' => true]);

        $maxRand = count($preguntes);

        $num = rand(1, $maxRand);
        $pregunta = $preguntes[$num-1];

        if ($request->request->get('idioma') == 'cat') {
            if ($pregunta->getPreguntaCat() !== '') {
                $preguntaText = $pregunta->getPreguntaCat();
                $respostaCorrecta = $pregunta->getRespostaCorrectaCat();
                $respostaIncorrecta1 = $pregunta->getRespostaIncorrecta1Cat();
                $respostaIncorrecta2 = $pregunta->getRespostaIncorrecta2Cat();
                $respostaIncorrecta3 = $pregunta->getRespostaIncorrecta3Cat();
            } elseif ($pregunta->getPreguntaEs() !== '') {
                $preguntaText = $pregunta->getPreguntaEs();
                $respostaCorrecta = $pregunta->getRespostaCorrectaEs();
                $respostaIncorrecta1 = $pregunta->getRespostaIncorrecta1Es();
                $respostaIncorrecta2 = $pregunta->getRespostaIncorrecta2Es();
                $respostaIncorrecta3 = $pregunta->getRespostaIncorrecta3Es();
            } elseif ($pregunta->getPreguntaEn() !== '') {
                $preguntaText = $pregunta->getPreguntaEn();
                $respostaCorrecta = $pregunta->getRespostaCorrectaEn();
                $respostaIncorrecta1 = $pregunta->getRespostaIncorrecta1En();
                $respostaIncorrecta2 = $pregunta->getRespostaIncorrecta2En();
                $respostaIncorrecta3 = $pregunta->getRespostaIncorrecta3En();
            }
            
        } elseif ($request->request->get('idioma') == 'es') {
            if ($pregunta->getPreguntaEs() !== '') {
                $preguntaText = $pregunta->getPreguntaEs();
                $respostaCorrecta = $pregunta->getRespostaCorrectaEs();
                $respostaIncorrecta1 = $pregunta->getRespostaIncorrecta1Es();
                $respostaIncorrecta2 = $pregunta->getRespostaIncorrecta2Es();
                $respostaIncorrecta3 = $pregunta->getRespostaIncorrecta3Es();
            } elseif ($pregunta->getPreguntaCat() !== '') {
                $preguntaText = $pregunta->getPreguntaCat();
                $respostaCorrecta = $pregunta->getRespostaCorrectaCat();
                $respostaIncorrecta1 = $pregunta->getRespostaIncorrecta1Cat();
                $respostaIncorrecta2 = $pregunta->getRespostaIncorrecta2Cat();
                $respostaIncorrecta3 = $pregunta->getRespostaIncorrecta3Cat();
            } elseif ($pregunta->getPreguntaEn() !== '') {
                $preguntaText = $pregunta->getPreguntaEn();
                $respostaCorrecta = $pregunta->getRespostaCorrectaEn();
                $respostaIncorrecta1 = $pregunta->getRespostaIncorrecta1En();
                $respostaIncorrecta2 = $pregunta->getRespostaIncorrecta2En();
                $respostaIncorrecta3 = $pregunta->getRespostaIncorrecta3En();
            }
            
        } elseif ($request->request->get('idioma') == 'en') {
            if ($pregunta->getPreguntaEn() !== '') {
                $preguntaText = $pregunta->getPreguntaEn();
                $respostaCorrecta = $pregunta->getRespostaCorrectaEn();
                $respostaIncorrecta1 = $pregunta->getRespostaIncorrecta1En();
                $respostaIncorrecta2 = $pregunta->getRespostaIncorrecta2En();
                $respostaIncorrecta3 = $pregunta->getRespostaIncorrecta3En();
            } elseif ($pregunta->getPreguntaEs() !== '') {
                $preguntaText = $pregunta->getPreguntaEs();
                $respostaCorrecta = $pregunta->getRespostaCorrectaEs();
                $respostaIncorrecta1 = $pregunta->getRespostaIncorrecta1Es();
                $respostaIncorrecta2 = $pregunta->getRespostaIncorrecta2Es();
                $respostaIncorrecta3 = $pregunta->getRespostaIncorrecta3Es();
            } elseif ($pregunta->getPreguntaCat() !== '') {
                $preguntaText = $pregunta->getPreguntaCat();
                $respostaCorrecta = $pregunta->getRespostaCorrectaCat();
                $respostaIncorrecta1 = $pregunta->getRespostaIncorrecta1Cat();
                $respostaIncorrecta2 = $pregunta->getRespostaIncorrecta2Cat();
                $respostaIncorrecta3 = $pregunta->getRespostaIncorrecta3Cat();
            }
        }

        return new JsonResponse([
            'pregunta' => $preguntaText,
            'respostaCorrecta' => $respostaCorrecta,
            'respostaIncorrecta1' => $respostaIncorrecta1,
            'respostaIncorrecta2' => $respostaIncorrecta2,
            'respostaIncorrecta3' => $respostaIncorrecta3
        ]);
    } 

    /**
     * @Route("/getPartidaPortait", name="getPartidaPortait")
     */
    public function getPartidaPortait(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $grup = $em->getRepository(Grup::class)->findOneById($request->request->get('grup'));

        $partidaLobbyUrl = $this->generateUrl('partidaLobby',array(
            'grupid' => $grup->getId(),
        ));

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

                <div id='playMultiplayerCard' class='col col-md-5 alltransition3'>

                    <a href='#' id='playButton' class='alltransition3'>
                        
                        <p class='alltransition3'>Jugar</p>
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

            var url = '" . $partidaLobbyUrl . "'
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

    public function getPregunta($id) {

        $pregunta = $this->getDoctrine()
            ->getRepository(Pregunta::class)
            ->find($id);

        return $pregunta;

    }

    public function getTema($id) {

        $tema = $this->getDoctrine()
            ->getRepository(Tema::class)
            ->find($id);

        return $tema;

    }

    public function getUsuari($id) {
        
        $usuari = $this->getDoctrine()
            ->getRepository(Usuari::class)
            ->find($id);

        return $usuari;

    }

    public function getUsuariByUsername($username) {
        
        $em = $this->getDoctrine()->getManager();

        $usuari = $em->getRepository(Usuari::class)->createQueryBuilder('u')
            ->where('u.username like :usuari')
            ->setParameter('usuari', $username)
            ->getQuery()
            ->getResult();

        $user = null;

        if ($usuari != null) {
            $user = $usuari = $this->getDoctrine()
            ->getRepository(Usuari::class)
            ->find($usuari[0]->getId());
        }

        return $user;

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

    function getNivellGrup($grup) {

        $nivell = $grup->getIdNivell();
        return $nivell;

    }

    /**
     * @Route("/partidaLobby/{grupid}", name="partidaLobby")
     */
    function partidaLobby($grupid) {

    $grup = $this->getGrup($grupid);
    $user = $this->getUser();
    $jugadorsGrup = $this->getAlumnesCurs($grupid);

    $password = $this->pw();

    $colors = "[['red', 'rgba(255,0,0,0.3)'], ['blue','rgba(0,0,255,0.3)'], ['green', 'rgba(0,255,0,0.3)'], ['purple', 'rgba( 128, 0, 128,0.8)'], ['orange', 'rgba(249,191,59,0.3)']]";

    $checkLoginUrl = $this->generateUrl('checklogin');
    $jugarUrl = $this->generateUrl('jugar');

    $nivellGrup = $this->getNivellGrup($grup);

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

                function onClickTornarLogin() {

                    $('#iniciarSessioModalClose').click();
                
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

    latestelementllista = '';

    match = '';
    matchid = '';
    matchnom = '';
    matchidsent = '';

    userid = '';

    colors = " . $colors . ";
    colorsn = [];

    function getRandomColor(colors) {
        
        var random = getRandomNumberColor();
        var colorvalid = false;

        while(colorvalid == false) {

            if (colorsn.includes(random)) {
                random = getRandomNumberColor();
                colorvalid = false;
            } else {
                colorvalid = true;
            }

        } 

        colorsn.push(random);

        return colors[random];
    }

    function enterKeyup() {
        if (event.keyCode === 13) {
            event.preventDefault();
            $('#usernameLogin, #passwordLogin').blur();
            $('#iniciarSessioModalBtn').click();
        }
    }

    function checkJugadors() {
        if (eval('[' + readCookie('jugadors') + ']').length <= 1) {
            $('.playPartidaCard a, .playPartidaCard').addClass('disabledBtn');
            $('#partidaWarning').css({
                'display': 'block',
            });
        } else {
            $('.playPartidaCard a, .playPartidaCard').removeClass('disabledBtn');
            $('#partidaWarning').css({
                'display': 'none',
            });
        }

        checkMinMaxJugadors(eval('[' + readCookie('jugadors') + ']').length);

        return eval('[' + readCookie('jugadors') + ']').length;
    }

    function checkMinMaxJugadors(arrayJugadorsLength) {

        if (arrayJugadorsLength >= 1 && arrayJugadorsLength <= 4) {
            $('#afegirJugador').removeClass('disabledBtn');
        } else {
            $('#afegirJugador').addClass('disabledBtn');
        }
    }

    function getRandomNumberColor() {
        var min=0; 
        var max=4;  
        var random = Math.random() * (+max - +min) + +min; 
        random = Math.round(random);
        return random;
    }

    //getPw();
    var pw = '" . $password . "';

    delete_cookie('jugadors');

    color = getRandomColor(colors);
    var jugadoractual = [" . $user->getId() . ", color[0]];

    writeCookie('jugadors', JSON.stringify(jugadoractual), 1);

    delete_cookie('grup');
    writeCookie('grup', '" . $grupid . "');

    delete_cookie('nomjugadors');
    delete_cookie('nomjugadorsString');

    var nomjugadoractual = `" . $user->getNom() . " " . $user->getCognoms() . "`;

    writeCookie('nomjugadors', nomjugadoractual.toString(), 1);
    writeCookie('nomjugadorsString', '`' + nomjugadoractual + '`', 1);

    $('#perfilFloat').css({
        'background-color': color[1],
    })

    delete_cookie('params');
    writeCookie('params', '[" . $grup->getTempsResposta() . ", " . $grup->getPuntuacioFacil() .", " . $grup->getPuntuacioDificil() . "]');
    </script>

    <div id='multiplayerLobby' class='row p-4 col-9'>

    <div class='container' id='titleMultijugador'>
        <h2>Sala d'espera | Partida multijugador</h2>
    </div>

    <div class='container' id='grupMultijugador'>
        <h3>Grup: " . $grup->getNom() . "</h3>
    </div>

    <div class='container row' id='topLobby'>
    
        <div id='tipusPartidaSlider' class='col col-md-6 carousel slide' data-ride='carousel'>

            <div class='carousel-inner'>
                <div class='carousel-item active' id='carouselMultijugador'>

                    <div class='carouselVertical'>
                        <p class='ontopCarousel'>Partida multijugador</p>
                    </div>

                </div>
                <div class='carousel-item' id='carouselEntrenament'>

                    <div class='carouselVertical'>
                        <p class='ontopCarousel'>Entrenament</p>
                    </div>

                </div>
            </div>

            <a class='carousel-control-prev' id='carouselMultiPrev' href='#tipusPartidaSlider' role='button' data-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                <span class='sr-only'>Previous</span>
            </a>

            <a class='carousel-control-next' id='carouselMultiNext' href='#tipusPartidaSlider' role='button' data-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                <span class='sr-only'>Next</span>
            </a>

        </div>

        <div id='playerList' class='col col-md-4'>
            <ul>
                <p id='playerListHead' style='margin-bottom: 0px!important'>Jugadors:</p>
                <li class='alltransition3'><a href='#' id='currentPlayer'><i class='alltransition3 fas fa-user mr-2'></i>" . $user->getUsername() . "</a></li>
                <script>
                    $('#currentPlayer').css('background-color',color[1]);
                </script>
            </ul>
            <a href='#' class='btn btn-info' id='afegirJugador'>Afegir jugador</a>
        </div>

    </div>

    <div class='container row' id='containerNormesStart'>

        <div class='container' id='containerNormes'>
            
            <ul class='tableNormes col col-6'>
                <li class='row tableHead'>
                    <p>Normes</p>
                </li>
                <li class='row'>
                    <p class='col col-md-6'>Temps de resposta</p>
                    <p class='col col-md-6'>" . $grup->getTempsresposta() . " segons</p>
                </li>
                <li class='row'>
                    <p class='col col-md-6'>Nivell</p>
                    <p class='col col-md-6'>" . $nivellGrup->getNom() . "</p>
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

        </div>

        <div class='container' id='containerComençarPartida'>

            <div class='playPartidaCard'>

                <a href='#' class='alltransition3 playPartidaButton' id='PlayPButton'>

                    <p class='alltransition3'>Començar partida</p>

                </a>

            </div>

            <label id='partidaWarning'>Es necessiten més jugadors</label>

        </div>    

    </div>

    <div id='afegirJugadorModal' class='modal fade' tabindex='-1' role='dialog'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h6 class='modal-title' id='afegirJugadorModal'>Llistat de jugadors</h6>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div id='afegirJugadorModalMsg'>
                        <div class='form-group'>
                            <table class='col-12'>

                                <tr>
                                    <th scope='col'>Grup: " . $grup->getNom() . "</th>
                                </tr>
                                " .

                                $llistat

                                . "
                            </table>
                        </div>
                    </div>
                </div>
                <div class='modal-footer' id='afegirJugadorModalBtns'>
                    <input type='submit' name='Submit' value='Tancar' class='btn btn-success' id='afegirJugadorsBtn' data-grupid='{{ grup.id }}'>
                </div>
            </div>
        </div>
    </div>

    <div id='iniciarSessioModal' class='modal fade' tabindex='-1' role='dialog'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h6 class='modal-title' id='iniciarSessioModal'>Iniciar sessió</h6>
                    <button id='iniciarSessioModalClose' type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div id='iniciarSessioModalMsg'>
                        <div class='form-group'>
                            
                            <h2 id='iniciarSessioTitle' style='color: black!important'>Comprovar identitat</h2>

                                <label id='jugadorSeleccionatLabel'>Jugador sel.leccionat: <jugador id='jugadorSeleccionatLabelFill'></jugador></label>

                                <label for='nom'>" . "Nom d'usuari" . "</label>
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

    <div id='canviModeModal' class='modal fade' tabindex='-1' role='dialog'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h6 class='modal-title' id='canviModeModal'>Canvi de mode</h6>
                    <button id='canviModeModalClose' type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div id='canviModeModalMsg'>

                        <h3 id='canviModeTitle'>S'està a punt de canviar el mode de joc, desitjes continuar?</h3>
                        <div id='acceptdenyModel' class='col col-md-12'>

                            <a href='#' class='btn btn-success' id='canviModeAccept'>Si</a>
                            <a href='#' class='btn btn-danger' id='canviModeDeny'>No</a>

                        </div>

                    </div>
                </div>
                <div class='modal-footer' id='CanviModeModalBtns'>
                </div>
            </div>
        </div>

    </div>

    <script>

    $('#tipusPartidaSlider').carousel({
        interval: false
    });

    checkJugadors();

    var inputUsername = document.getElementById('usernameLogin');
    var inputPassword = document.getElementById('passwordLogin');

    inputUsername.addEventListener('keyup', function(event) {
        enterKeyup();
    });

    inputPassword.addEventListener('keyup', function(event) {
        enterKeyup();
    });

    $('body').on( 'click', '#PlayPButton', function() {
        if (checkJugadors() > 1) {
            window.location.href = '" . $jugarUrl . "';
        }
    });

    $('body').on( 'click', '#carouselMultiPrev, #carouselMultiNext', function() {
        $('#canviModeModal').modal('show');
    });

    $('body').on( 'click', '#canviModeAccept', function() {
        $('#canviModeModal').modal('hide');
        clearHTML();
        writeCookie('ferEntreno','redirect',1);
        location.reload();
        //setTimeout(function(){ $('#entrenamentBtn').click(); }, 1000);
    });

    $('body').on( 'click', '#canviModeDeny', function() {

        swap();

        $('#canviModeModal').modal('hide');
    });

    $('body').on( 'click', '#canviModeModal', function() {
                
        swap();

    });

    function swap() {

        $('#carouselEntrenament').removeClass('active');
        $('#carouselMultijugador').addClass('active');

    }

    $('body').on( 'click', '#afegirJugador', function() {

        var arrJugadors = eval('[' + readCookie('jugadors') + ']');
        
        if (arrJugadors.length <= 4) {
            $('#afegirJugadorModal').modal('show');

            $('body').on('click', '#afegirJugador', function() {
                $.get()
            });
        } else {
            alert(`S'ha arribat al màxim de jugadors permès`);
        }

    });

    $('#iniciarSessioModalClose').click(function() {

        $('#afegirJugadorModal').modal('show');

    });

    $('.elementLlistaJugadors').click(function() {

        if (!$(this).hasClass('usuariSeleccionat')) {

            latestelementllista = this;

            latestalumneidenc = this.id;
            latestalumneid = this.getAttribute('secid');

            //console.log('Alumne id seleccionat: ' + latestalumneid);

            latestalumne = this.name;

            $('#jugadorSeleccionatLabelFill').html(latestalumne);
            $('#usernameLogin, #passwordLogin').val('');

            $('#iniciarSessioModalMsg .form-group').css('display','block');
            $('#iniciarSessioModalMsg #errorLogin').remove();
            $('#iniciarSessioModal').modal('show');

            $('#afegirJugadorModal').modal('hide');

        }

    })

    $('#iniciarSessioModalBtn').click(function() {

        var url = '" . $checkLoginUrl . "';
        var pass = pw;

        var username = $('#usernameLogin').val();
        var pwd = $('#passwordLogin').val();

        $.post(url, { 'username': username, 'password': pwd }) 
		    .done(function(response) {

                match = response['match'];
                matchidsent = response['id'];
                matchnom = response['nom'];

                //console.log('responseid' + response['id']);

                if (match == true) {
                    savemematch(match, matchnom, matchidsent, latestalumneid);
                } else {
                    errormatch();
                }
			});
    });

    function errormatch() {
        $('#iniciarSessioModalMsg .form-group').css('display','none');
        
        $('#iniciarSessioModalMsg').append(`<div id='errorLogin'>
                <h2>Les credencials introduïdes no són vàlides</h2>
                <a href='#' class='btn btn-danger' id='errorLoginTornar' onclick='onClickTornarLogin()'>Tornar</a>
            </div>`);
    }

    function savemematch(matchsent, matchnom, matchidsent, latestalumneid) {

        while(match == '') {
            match = matchsent;
        }

        //console.log('Matchid actual ' + latestalumneid + ' matchid enviat: ' + matchidsent);
        $('#iniciarSessioModalMsg .form-group').css('display','none');

        if (latestalumneid == matchidsent && matchidsent != '' && matchidsent != null) {

            $('#iniciarSessioModalMsg').append(`<div id='errorLogin'>
                <h2>Credencials vàlides</h2>
                <a href='#' class='btn btn-success' id='errorLoginTornar' onclick='onClickTornarLogin()'>Tornar</a>
            </div>`);

            if (!$(latestelementllista).hasClass('usuariSeleccionat')) {
                $(latestelementllista).addClass('usuariSeleccionat');
            } 

            $('#playerList ul').append(`<li class='alltransition3' id='jugli` + matchidsent + `'><a href='#' secid='` + matchidsent+ `' id='jug` + matchidsent + `'><i class='alltransition3 fas fa-user mr-2'></i>` + matchnom + `<a href='#' data='`+ matchidsent + `' class='removePlayerBtn'><i class='alltransition3 fas fa-times'></i></a></a></li>`);

            var color = getRandomColor(colors);
            var matchnomid = '#jug' + matchidsent;
            $(matchnomid).css('background-color',color[1]);
            
            var jugador = [matchidsent, color[0]];

            var arrayJugadors = [eval(readCookie('jugadors'))];

            if (readCookie('jugadors') == '') {
                writeCookie('jugadors', JSON.stringify(jugador) , 1);
                writeCookie('nomjugadors', matchnom.toString(), 1);
                writeCookie('nomjugadorsString', '`' + matchnom + '`', 1);
            } else {
                writeCookie('jugadors', readCookie('jugadors') + ',' + JSON.stringify(jugador), 1);
                writeCookie('nomjugadors', readCookie('nomjugadors') + ',' + matchnom.toString(), 1);
                writeCookie('nomjugadorsString', readCookie('nomjugadorsString') + ',`' + matchnom + '`', 1);
            }

            console.log(readCookie('nomjugadors'))
            
        } else {
            errormatch();
        }

        var arrJugadors = eval('[' + readCookie('jugadors') + ']');
        
        if (arrJugadors.length >= 5) {
            $('#afegirJugador').addClass('disabledBtn');
            $('#iniciarSessioModal').modal('hide');
            $('#afegirJugadorModal').modal('hide');
        } else {
            $('#afegirJugador').removeClass('disabledBtn');
        }

        checkJugadors();
    }

    $('body').on( 'click', '.removePlayerBtn', function() {

        var removeId = $(this).attr('data');
        var arrJugadors = eval('[' + readCookie('jugadors') + ']');

        var posicioRemove = '';

        arrJugadors.forEach(function(jugador) {
            if (jugador[0] == removeId) {
                posicioRemove = arrJugadors.indexOf(jugador);
            }
        });

        var colorRemove = '';

        colors.forEach(function(color) {
            if (color[0] == arrJugadors[posicioRemove][1]) {
                colorRemove = colors.indexOf(color);
            }
        });

        var colornRemove = '';

        colorsn.forEach(function(colorn) {
            if (colorn == colorRemove) {
                colornRemove = colorsn.indexOf(colorn);
            }
        });

        colorsn.splice(colornRemove,1);
        arrJugadors.splice(posicioRemove, 1);

        var arrJugadorsStr = '';

        arrJugadors.forEach(function(jugador, idx) {

            var jugadorAddStr = '[' + jugador[0] + ',' + '`' + jugador[1] + '`]';

            if (idx === arrJugadors.length - 1) {
                arrJugadorsStr += jugadorAddStr;
            } else {
                arrJugadorsStr += jugadorAddStr + ',';
            }
        });

        writeCookie('jugadors', arrJugadorsStr , 1);

        var NomJugadorsStrCookie = readCookie('nomjugadorsString')
        var arrNomJugadorsStr = '';

        var arrNomJugadors = eval('[' + NomJugadorsStrCookie + ']');
        arrNomJugadors.splice(posicioRemove, 1);
        
        /*writeCookie('nomjugadors', arrNomJugadorsStr , 1);*/
        writeCookie('nomjugadors', arrNomJugadors , 1);

        //console.log(readCookie('nomjugadors'));

        $('#jugli' + removeId).remove();

        $('.elementLlistaJugadors[secid=' + removeId + ']').removeClass('usuariSeleccionat');

        checkJugadors();

    });

    $('#afegirJugadorsBtn').click(function(e) {

        $('#afegirJugadorModal').modal('hide');

    });

    $(window).trigger('resize');

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

        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $user = $this->getUsuariByUsername($username);

        $encoderService = $this->container->get('security.password_encoder');
        
        $match;

        if ($user != null) {
            $match = $encoderService->isPasswordValid($user, $password);
            return new JsonResponse(['match' => $match, 'id' => $user->getId(), 'nom' => $user->getNom() . ' ' . $user->getCognoms()]);
        } else {
            $match = false;
            return new JsonResponse(['match' => $match]);
        }

        return new JsonResponse(['match' => $match, 'id' => $user->getId(), 'nom' => $user->getNom() . ' ' . $user->getCognoms()]);
        
    }

    /**
     * @Route("/getJugadorNom", name="getJugadorNom")
     */
    public function getJugadorNom(Request $request) : JsonResponse {

        $id = $request->request->get('id');

        $user = $this->getUsuari($id);

        return new JsonResponse(['nomcognoms' => $user->getNom() . " " . $user -> getCognoms()]);
        
    }

    /**
     * @Route("/llistatTemes", name="llistatTemes")
     */
    function llistatTemes(Request $request) {

        $grupid = $request->request->get('grupid');
        $grup = $this->getGrup($grupid);
        $temes = $grup->getIdNivell()->getTemas();

        $temesSeleccionats = $request->request->get('temesArray');
        if ($temesSeleccionats == null) {
            $temesSeleccionats = [""];
        }
        var_dump($temesSeleccionats);

        $html = '';

        foreach ($temes as $tema) {

            $html = $html . "

            <tr>

                <td class='elementLlistaTemesTd'>
                <a class='
            ";

                foreach ($temesSeleccionats as $temasel) {
                    if($tema->getId() == $temasel) {
                        var_dump('seleccionat');
                        $html = $html . "temaSeleccionat ";
                    }
                }

            
            $html = $html . "elementLlistaTemes nodeco'" . " name=" . $tema->getNom() . "' id='tema". $tema->getId() . "' secid='" . $tema->getId() . "' href='#'>

                        <span class='temaNom'>
                            " . $tema->getNom() . "
                        </span> 

                        <span class='temaNum'>
                           " . $tema->getId() . "
                        </span>

                    </a>

                </td>
                
            </tr>
            
            ";

        }

        return new Response(
            $html
        );

    }

    /**
     * @Route("/getEntrenamentPortait", name="getEntrenamentPortait")
     */
    function getEntrenamentPortait(Request $request) {

        $user = $this->getUser();
        $grups = $this->getUser()->getGrups();
        $nivellId = '';

        $llistatGrups = "";
        $grupArray = "";

        $jugarUrl = $this->generateUrl('jugarEntrenament');

        foreach($grups as $grup) {
            $llistatGrups = $llistatGrups . "
            <li class='entrenamentCurs row alltransition3' id='" . $grup->getId() . "' subid='gr" . $grup->getId() . "'>
                <p class='col col-md-6 alltransition3 grupNom'>" . $grup->getNom() . "</p>
                <p class='col col-md-6 alltransition3 grupTemes'></p>
            </li>
            ";

            $grupArray = $grupArray . "
                [" . $grup->getId() . ",[]],
            ";

            $nivellId = $grup->getIdNivell()->getId();

        }

        $html = "

        <script>

        lastgrupclicked = '';
        lastgrupid = '';
        temes = [];
        preguntesNumIndex = 0;

        opcionsNumPreguntes = {

            get opcions() {
                return [15,30,45];
            },

        }

        temesGrup = [" . 
        
        $grupArray

        . "];

        function checkTemes() {
            return temes.length;
        }

        $('.entrenamentCurs').removeClass('entrenamentCursSelected');

        delete_cookie('cursos');
        delete_cookie('temes');
        delete_cookie('preguntesNum');
        delete_cookie('nivell');

        cursosArray = [];

        </script>

        <div id='multiplayerLobby' class='row p-4 col-9'>

            <div class='container' id='titleEntrenament'>
                <h2>Sala d'espera | Entrenament</h2>
            </div>

            <div class='container row' id='topLobby'>
    
            <div id='tipusPartidaSlider' class='col col-md-6 carousel slide' data-ride='carousel'>

                <div class='carousel-inner'>
                    <div class='carousel-item' id='carouselMultijugador'>

                        <div class='carouselVertical'>
                            <p class='ontopCarousel'>Partida multijugador</p>
                        </div>

                    </div>
                    <div class='carousel-item active' id='carouselEntrenament'>

                        <div class='carouselVertical'>
                            <p class='ontopCarousel'>Entrenament</p>
                        </div>

                    </div>
                </div>

                <a class='carousel-control-prev' id='carouselMultiPrev' href='#tipusPartidaSlider' role='button' data-slide='prev'>
                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                    <span class='sr-only'>Previous</span>
                </a>

                <a class='carousel-control-next' id='carouselMultiNext' href='#tipusPartidaSlider' role='button' data-slide='next'>
                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                    <span class='sr-only'>Next</span>
                </a>

            </div>

            <div id='playerList' class='col col-md-4'>
                <ul>
                    <p id='playerListHead' style='margin-bottom: 0px!important'>Jugador:</p>
                    <li class='alltransition3'><a href='#' id='currentPlayer'><i class='alltransition3 fas fa-user mr-2'></i>" . $user->getUsername() . "</a></li>
                </ul>
            </div>

            <div class='container row' id='containerCursosEntrenament'>
        
                <div class='container' id='containerCursos'>
                    
                    <ul class='tableNormes col col-6'>
                        <li class='row tableHead' id='temesHead'>
                            <p>Cursos</p>
                            <p>Temes</p>
                        </li>
                        " . $llistatGrups . "
                    </ul>

                    <div id='selectPreguntesDiv'>

                        <label for='preguntesNum'>Quantes preguntes vols?</label>

                        <select id='preguntesNum' name='preguntesNum'>

                            <script>

                            opcionsNumPreguntes.opcions.forEach(function(opcio, idx) {
                                $('#preguntesNum').append('<option id=' + idx + '>' + opcio + ' preguntes</option>');
                            });

                            </script>

                        </select>

                    </div>

                </div>

                <div class='container' id='containerComençarPartida'>

                    <div class='playPartidaCard'>

                        <a href='#' class='alltransition3 playPartidaButton' id='PlayPButton'>

                            <p class='alltransition3'>Començar partida</p>

                        </a>

                    </div>

                </div>

            </div>

        </div>

        </div>

        <div id='canviModeModal' class='modal fade' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h6 class='modal-title' id='canviModeModal'>Canvi de mode</h6>
                        <button id='canviModeModalClose' type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <div id='canviModeModalMsg'>

                            <h3 id='canviModeTitle'>S'està a punt de canviar el mode de joc, desitjes continuar?</h3>
                            <div id='acceptdenyModel' class='col col-md-12'>

                                <a href='#' class='btn btn-success' id='canviModeAccept'>Si</a>
                                <a href='#' class='btn btn-danger' id='canviModeDeny'>No</a>

                            </div>

                        </div>
                    </div>
                    <div class='modal-footer' id='CanviModeModalBtns'>
                    </div>
                </div>
            </div>
    
        </div>

        <div id='seleccionarTemaModal' class='modal fade' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h6 class='modal-title' id='seleccionarTemaModal'>Sel.lecció de temes</h6>
                        <button id='seleccionarTemaModalClose' type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <div id='seleccionarTemaModalMsg'>

                            <div class='form-group'>
                            <table class='col-12' id='temesGrupTable'>

                                <tr>
                                    <th scope='col'>Grup: " . $grup->getNom() . "</th>
                                </tr>

                                <div id='temesReload'>
                                </div>

                            </table>
    
                        </div>
                    </div>
                    <div class='modal-footer' id='seleccionarTemaModalBtns'>
                        <input type='submit' name='Submit' value='Tancar' class='btn btn-success' id='tancarTemesBtn'>
                    </div>
                </div>
            </div>

        <script>

            $('#tipusPartidaSlider').carousel({
                interval: false
            });

            $('#preguntesNum').change(function(){
                preguntesNumIndex = $(this).children('option:selected').attr('id');
            });

            $('body').on( 'click', '#PlayPButton', function() {
                if (checkTemes() > 1) {

                    writeCookie('temes', temes, 1);
                    writeCookie('preguntesNum', opcionsNumPreguntes.opcions[preguntesNumIndex], 1);

                    writeCookie('nivell', '" . $nivellId . "');

                    window.location.href = '" . $jugarUrl . "';
                }
            });

            $('body').on( 'click', '.entrenamentCurs', function() {

                var id = $(this).attr('id');

                lastgrupid = id;

                var url = '" . $this->generateUrl('llistatTemes') . "';

                clearHTMLModalTemes();

                $.post(url, { 'grupid': lastgrupid, 'temesArray': temes }) 
                    .done(function(response) {
                        $('#temesGrupTable #temesReload').html('');
                        $('#temesGrupTable').html(response);
                    });

                var selected = $(this).hasClass('entrenamentCursSelected');

                $('#seleccionarTemaModal').modal('show');

            });

            $('body').on( 'click', '.elementLlistaTemes', function() {
                
                var id = $(this).attr('secid');
                var posicioGrupArray = '';

                temesGrup.forEach(function(grupA) {
                    if (grupA[0] == lastgrupid) {
                        posicioGrupArray = temesGrup.indexOf(grupA);
                    }
                });

                if(!$(this).hasClass('temaSeleccionat')) {
                    temes.push(id);
                    temesGrup[posicioGrupArray][1].push(id);
                    $(this).addClass('temaSeleccionat');
                } else {
                    var posiciotemes = temes.indexOf(id);
                    var posicio = temesGrup[posicioGrupArray][1].indexOf(id);
                    temes.splice(posiciotemes,1);
                    temesGrup[posicioGrupArray][1].splice(posicio, 1);
                    $(this).removeClass('temaSeleccionat');
                }

                var temestext = '';

                temesGrup[posicioGrupArray][1].forEach(function(tema, idx) {

                    if (idx === temesGrup[posicioGrupArray][1].length - 1) {
                        temestext += '<span>' + tema + '</span>';
                    } else {
                        temestext += '<span>' + tema + ',' + '</span>';
                    }
                });

                console.log(temes);
                $('.entrenamentCurs#' + lastgrupid + ' .grupTemes').html(temestext);

            });

            $('body').on( 'click', '#tancarTemesBtn', function() {
                $('#seleccionarTemaModal').modal('hide');
            });

            $('body').on( 'click', '#carouselMultiPrev, #carouselMultiNext', function() {
                $('#canviModeModal').modal('show');
            });
        
            $('body').on( 'click', '#canviModeAccept', function() {
                $('#canviModeModal').modal('hide');
                clearHTML();
                $('#entrenamentBtn').removeClass('active');
                setTimeout(function(){ $('#llistatGrupsJoc li:first-child a').click(); }, 1000);
            });
        
            $('body').on( 'click', '#canviModeDeny', function() {
                
                swap();
        
                $('#canviModeModal').modal('hide');
            });

            $('body').on( 'click', '#canviModeModal', function() {
                
                swap();

            });

            function swap() {

                $('#carouselMultijugador').removeClass('active');
                $('#carouselEntrenament').addClass('active');

            }

            $(window).trigger('resize');

        </script>

        </div>";

        return new Response(
            $html
        );

    }

    function getPartida($id) {

        $partida = $this->getDoctrine()
            ->getRepository(Partida::class)
            ->find($id);

        return $partida;

    }

    /**
     * @Route("/urlPujarTemes", name="urlPujarTemes")
     */
    public function urlPujarTemes(Request $request) {

        $Temes_partidaJSON = $request->request->get('temes_partidaJSON');
        $temes_partida = json_decode($Temes_partidaJSON);
        $usuari = $this->getUser();

        //var_dump($temes_partida);

        foreach($temes_partida as $tema_partida) {

            $partida = $this->getPartida($tema_partida->partida_id);
            $tema = $this->getTema($tema_partida->id_tema_id);

            $tp = new TemaPartida();
            $tp->setNom($tema_partida->nom);
            $tp->setPuntuacio((int)$tema_partida->puntuacio);
            $tp->setEncerts((int)$tema_partida->encerts);
            $tp->setErrors((int)$tema_partida->errors);
            $tp->setFormatges((int)$tema_partida->formatges);
            $tp->setUsuari($usuari);
            $tp->setPartida($partida);
            $tp->setIdTema($tema);

            $em = $this->getDoctrine()->getManager();

            $em->persist($tp);
            $em->flush();

            //var_dump($tp);

        }

        return new Response(
            "true"
        );

    }

    /**
     * @Route("/jugarEntrenament", name="jugarEntrenament")
     */
    function jugarEntrenament(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $getPreguntesUrl = $this->generateUrl('getPreguntesTemes');
        $getPreguntaUrl = $this->generateUrl('getPreguntaById');
        $urlGetResposta = $this->generateUrl('getRespostaPregunta');
        $urlPujarPartida = $this->generateUrl('pujarPartida');
        $urlPujarTemes = $this->generateUrl('urlPujarTemes');

        $title = "Partida d'entrenament | Trivial UB";

        return $this->render('partida/jocEntrenament.html.twig', [
            "title" => $title,
            'getPreguntesUrl' => $getPreguntesUrl,
            'getPreguntaUrl' => $getPreguntaUrl,
            'urlGetResposta' => $urlGetResposta,
            'urlPujarPartida' => $urlPujarPartida,
            'urlPujarTemes' => $urlPujarTemes,
        ]);


    }

    function getNivell($id) {

        $nivell = $this->getDoctrine()
            ->getRepository(Nivell::class)
            ->find($id);

        return $nivell;

    }

    function getTipusPartida($id) {

        $tipuspartida = $this->getDoctrine()
            ->getRepository(TipusPartida::class)
            ->find($id);

        return $tipuspartida;

    }

    /**
     * @Route("/pujarPartida", name="pujarPartida")
     */
    public function pujarPartida(Request $request) {
        $partidaArray = $request->request->get('partida');

        $usuari = $this->getUser();

        $data = new DateTime();
        //var_dump($data);

        $nivell = $this->getNivell((int)$partidaArray["idNivell"]);
        $tipusPartida = $this->getTipusPartida((int)$partidaArray["idTipusPartida"]);

        $partida = new Partida();
        $partida->setDataAuto();
        $partida->setIdNivell($nivell);
        $partida->setidTipusPartida($tipusPartida);
        $partida->addUsuari($usuari);

        $em = $this->getDoctrine()->getManager();

        $em->persist($partida);
        $em->persist($usuari);
        $em->flush();

        $dataFind = $partida->getData();
        $dataJSON = json_encode($dataFind);
        $dataObj = json_decode($dataJSON);

        $dataFinal = substr($dataObj->date, 0, strlen($dataObj->date)-7);

        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT p.id, p.data as data
        from partida p where p.data LIKE '" . $dataFinal . "' LIMIT 1");
        $statement->execute();

        $partidesTemp = $statement->fetchAll();
        $partidaId = $partidesTemp[0]["id"];

        return new Response(
            $partidaId . "," . "true"
        );
    }

    /**
     * @Route("/getRespostaPregunta", name="getRespostaPregunta")
     */
    public function getRespostaPregunta(Request $request) {

        $idPregunta = $request->request->get('preguntaId');
        $resposta = $request->request->get('resposta');

        $em = $this->getDoctrine()->getManager();

        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT id, resposta_correcta_cat as respostaCorrecta
        from pregunta where id = " . $idPregunta);
        $statement->execute();

        $preguntesTemp = $statement->fetchAll();
        $pregunta = $preguntesTemp[0];
        //var_dump($pregunta["respostaCorrecta"]);

        $bool = "false";

        if ($resposta == $pregunta["respostaCorrecta"]) {
            $bool = "true";
        }

        return new Response(
            $bool . ",`" . $pregunta["respostaCorrecta"] . "`"
        );
    }

    /**
     * @Route("/getPreguntaById", name="getPreguntaById")
     */
    public function getPreguntaById(Request $request) {

        $idPregunta = $request->request->get('preguntaId');

        $em = $this->getDoctrine()->getManager();

        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT id, Id_tema_id as tema, tipus_id as tipusid, id_dificultat_id as dificultatid, resposta_correcta_cat as resposta1, pregunta_cat, resposta_incorrecta1cat as resposta2, resposta_incorrecta2cat as resposta3, resposta_incorrecta3cat as resposta4
        from pregunta where id = " . $idPregunta);
        $statement->execute();

        $preguntesTemp = $statement->fetchAll();
        $pregunta = json_encode($preguntesTemp[0]);

        return new Response(
            $pregunta
        );

    }

    function getPreguntesByTemas($idsTemes, $preguntesNum) {

        $preguntes = [];
        $preguntesTemes = [];

        $temesRecollits = 0;

        while($temesRecollits != sizeof($idsTemes)) {

            $random = mt_rand(0, sizeof($idsTemes)-1);
            $randomTema = $idsTemes[$random];

            $em = $this->getDoctrine()->getManager();

            $connection = $em->getConnection();
            $statement = $connection->prepare("SELECT id, Id_tema_id as tema from pregunta where Id_tema_id = " . $randomTema);
            $statement->execute();

            $preguntesTemp = $statement->fetchAll();

            foreach($preguntesTemp as $pregunta) {

                array_push($preguntesTemes, $pregunta);

            }

            $temesRecollits = $temesRecollits + 1;

            /*if ($usuari != null) {
                $user = $usuari = $this->getDoctrine()
                ->getRepository(Usuari::class)
                ->find($usuari[0]->getId());
            }

            return $user;*/
        }

        //var_dump($preguntesTemes);

        $preguntesTemesFinal = [];
        $preguntesRecollides = 0;

        while($preguntesRecollides != $preguntesNum) {

            $random = mt_rand(0, sizeof($preguntesTemes)-1);

            // in_array("Irix", $os)

            array_push($preguntesTemesFinal, $preguntesTemes[$random]);
            $preguntesRecollides = $preguntesRecollides + 1;

        }

        //var_dump($preguntesTemesFinal);

        /*foreach($preguntesTemesFinal as $pregunta) {
            $preguntaObj = $this->getPregunta((int)$pregunta["id"]);
            array_push($preguntes, $preguntaObj);

            //var_dump((int)$pregunta["id"]);
        }

        var_dump($preguntes);*/

        $preguntesString = '';
        $i = 0;

        foreach($preguntesTemesFinal as $pregunta) {
            //var_dump((int)$pregunta["id"]);
            $preguntesString = $preguntesString . (int)$pregunta["id"];

            if ($i != sizeof($preguntesTemesFinal)-1) {
                $preguntesString = $preguntesString . ",";
            }

            $i = $i + 1;
        }

        return $preguntesString;

    }

    /**
     * @Route("/getPreguntesTemes", name="getPreguntesTemes")
     */
    function getPreguntesTemes(Request $request) {

        $idsTemes = $request->request->get('temes');
        $preguntesNum = (int) $request->request->get('preguntesNum');

        $preguntes = $this->getPreguntesByTemas($idsTemes, (int) $preguntesNum);

        /*while($preguntesRecollides != $preguntesNum) {

            $random = mt_rand(0, $preguntesNum);

            $preguntasLength = sizeof($temes[sizeof($idsTemes)]->preguntas);
            var_dump($preguntasLength . "<br>");

            $preguntesRecollides = $preguntesRecollides + 1;

        }

        foreach ($temes as $tema) {
        }*/

        return new Response(
            $preguntes
        );

    }

}

