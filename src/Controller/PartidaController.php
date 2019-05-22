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

        $em = $this->getDoctrine()->getManager();

        $getJugadorNomUrl = $this->generateUrl('getJugadorNom');

/*
        $nivell = $em->getRepository(Nivell::class)->findOneById();
        $temes = $em->getRepository(Tema::class)->findByNivell();
        $maxRand = count($temes);

        $temesPartida = array();

        $temesSel = false;
        $count = 0;
        do {
            $num = rand(1, $maxRand);
            $tema = $temes[$num];
            if (!in_array($tema, $temesPartida)) {
                array_push($temesPartida, $tema);
                $count++;
            } 
            if ($count == 5) {
                $temesSel = true;
            }
        } while (!$temesSel);

        $pteguntes = $em->getRepository(Pregunta::class)->find(['idTema' => $temesSel]);*/
        

        return $this->render('partida/joc.html.twig', [
            "getJugadorNomUrl" => $getJugadorNomUrl,
            /*'temes' => ,
            'preguntes' => ,*/
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

    $colors = "[['red', 'rgba(255,0,0,0.3)'], ['blue','rgba(0,0,255,0.3)'], ['green', 'rgba(0,255,0,0.3)'], ['pink', 'rgba(255,192,203,0.6)'], ['orange', 'rgba(249,191,59,0.3)']]";

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
    writeCookie('grup', '" . $grupid . ", 1');

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

                <a href='" . $jugarUrl . "' class='alltransition3 playPartidaButton'>

                    <p class='alltransition3'>Començar partida</p>

                </a>

            </div>

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
        
        if (arrJugadors.length < 5) {
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
            /*else {
                $(latestelementllista).removeClass('usuariSeleccionat');
            }*/

            $('#playerList ul').append(`<li class='alltransition3'><a href='#' secid='` + matchidsent+ `' id='jug` + matchidsent + `'><i class='alltransition3 fas fa-user mr-2'></i>` + matchnom + `</a></li>`);

            var color = getRandomColor(colors);
            var matchnomid = '#jug' + matchidsent;
            $(matchnomid).css('background-color',color[1]);
            
            var jugador = [matchidsent, color[0]];

            var arrayJugadors = [eval(readCookie('jugadors'))];

            console.log(arrayJugadors);

            if (readCookie('jugadors') == '') {
                writeCookie('jugadors', JSON.stringify(jugador) , 1);
            } else {
                writeCookie('jugadors', readCookie('jugadors') + ',' + JSON.stringify(jugador), 1);
            }
            
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
    }

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

        $llistatGrups = "";
        $grupArray = "";

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
        }

        $html = "

        <script>

        lastgrupclicked = '';
        lastgrupid = '';
        temes = [];
        temesGrup = [" . 
        
        $grupArray

        . "];

        $('.entrenamentCurs').removeClass('entrenamentCursSelected');

        delete_cookie('cursos');

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

            $('body').on( 'click', '.entrenamentCurs', function() {

                var id = $(this).attr('id');

                lastgrupid = id;

                var url = '" . $this->generateUrl('llistatTemes') . "';

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

                temesGrup[posicioGrupArray][1].forEach(function(tema) {
                    temestext += '<span>' + tema + ',' + '</span>';
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

}

