jugadors = [];
jugadornom = "";
tipuspartida = 1;
temas = [];

$(document).ready(function(){
    loadJugadors();
    primerTorn();
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

    var url = "/getJugadorNom"
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
        console.log(jugadors);
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