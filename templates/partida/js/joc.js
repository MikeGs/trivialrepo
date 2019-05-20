getJugadorNomUrl = '{{getJugadorNomUrl}}';
jugadors = [];
jugadornom = "";
tipuspartida = 1;
temas = []; 


$(document).ready(function() {
	$('.tirarDau').click(function() { dado() });
    var tema1 = '';
    var tema2 = '';
    var tema3 = '';
    var tema4 = '';
    var tema5 = '';

    loadJugadors();
    primerTorn();

    {% include 'partida/js/caselles.js' %}
    
    
    console.log(box_start.getCasellesAdjacents());
    //box_start.activarCaselles(1);
});

function Partida(data, nivell, tipuspartida, usuaris, temas) {

    //private $id ;private $data; private $idNivell; private $idTipusPartida; ARRAY private $usuaris; ARRAY private $idTemaPartida;

}

function loadJugadors() {
    
    jugadors = eval("[" + readCookie("jugadors") + "]");
    shuffle(jugadors);

    jugadors.forEach(jugador => {
        getJugador(jugador);
    });

}

function getJugador(jugador) {

    var url = getJugadorNomUrl
    var jnom = "";

    $.post(url, {'id': jugador[0] }) 
        .done(function(response) {
            jugadornom = response['nomcognoms'];
            trygetJugador(jugador, jugadornom);
        });
}

function primerTorn() {

    if ($("#mostrarJugadors > div").length != jugadors.length) {
        setTimeout(function(){primerTorn()}, 500);
    } else {
        $("#mostrarJugadors div:first-child").addClass("actual");
        // LLEGIR ARRAY JUGADORS PER BUSCAR TORNS
    }

}

function trygetJugador(jugador, jugadorsent) {

    while(jugadornom == "") {
        jugadornom = jugadorsent;
    }

    $("#mostrarJugadors").append("<div class='row m-0' id='" + jugador[0] + "'><div class='ranking'></div><div class='col jugador'>" + jugadornom + "</div></div>");
    jugador.push(jugadornom);

}

function shuffle(array) {
    array.sort(() => Math.random() - 0.5);
  }


function Casella(elementId, tipus, tema) {
    this.id = elementId;
    this.element = document.getElementById(elementId);
    this.tipus = tipus;
    this.tema = tema;
    var casellesAdjacents = [];

    this.afegirCasella = function(tirada, casella) {
        if (!casellesAdjacents[tirada]){
            casellesAdjacents[tirada] = [];
        }
        casellesAdjacents[tirada][casella.id] = casella; 
    }

    this.activarCaselles = function(tirada) {
        for (let casella in casellesAdjacents[tirada]) {
            casellesAdjacents[tirada][casella].element.classList.add('parpadeo');
        }
    }

    this.desactivarCaselles = function() {
        for (let casella in casellesAdjacents) {
            casella.element.classList.remove('parpadeo');
        }
    }

    this.getCasellesAdjacents = function() {
        return casellesAdjacents;
    }
}


function dado(){
  $('#platform').removeClass('stop').addClass('playing');
  $('#dice');
  setTimeout(function(){
    $('#platform').removeClass('playing').addClass('stop');
    var number = Math.floor(Math.random() * 6) + 1;
    var x = 0, y = 20, z = -20;
    switch(number){
        case 1:
          x = 0; y = 20; z = -20;
          break;
        case 2:
          x = -100; y = -150; z = 10;
          break;
        case 3:
          x = 0; y = -100; z = -10;
          break;
        case 4:
          x = 0; y = 100; z = -10;
          break;
        case 5:
          x = 80; y = 120; z = -10;
          break;
        case 6:
          x = 0; y = 200; x = 10;
          break;
    }
    
    $('#dice').css({
      'transform': 'rotateX(' + x + 'deg) rotateY(' + y + 'deg) rotateZ(' + z + 'deg)'
    });
    
    $('#platform').css({
      'transform': 'translate3d(0,0, 0px)'
    });
    
    $('#result').html(number);
    
  }, 1120);
};