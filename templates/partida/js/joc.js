
jugadors = [];
jugadornom = "";
jugadorsArray = [];
jugadorActual = 0;
tema1 = '';
tema2 = '';
tema3 = ''
tema4 = '';
tema5 = '';
team1nom = '';
team2nom = '';
team3nom = '';
team4nom = '';
team5nom = '';

$(document).ready(function() {
    carregant();
	$('.tirarDau').click(function() { dado() });
    $('body').on('click','.parpadeo',function() { mostrarPregunta($(this).attr('id'),$(this).data('tema'), $(this).data('tipus')) });
    
    //preparacio partida
    prepararJoc();
    
    //comença partida
    setTimeout(function(){ 

        crearJugadors();
        carregat();
       // console.log(jugadorsArray);

        for (let j in jugadorsArray) {
            jugadorsArray[j].mostrarFitxa();
        }

        jugar();             
        

    }, 3000);
    //
});

function prepararJoc() {
    var url = `{{ path('getTemes') }}`;
    $.post(url, { 'grup' : getGrup() })
    .done(function(response) {
        console.log(response)
        tema1 = response.tema1;
        tema2 = response.tema2;
        tema3 = response.tema3;
        tema4 = response.tema4;
        tema5 = response.tema5;
        team1nom = response.tema1nom;
        team2nom = response.tema2nom;
        team3nom = response.tema3nom;
        team4nom = response.tema4nom;
        team5nom = response.tema5nom;
        {% include 'partida/js/caselles.js' %}
        loadJugadors();
    });
}

function mostrarPregunta(id, tema, tipus) {
    desactivarCaselles();
    setTimeout(function(){ jugadorsArray[jugadorActual].canviarCasella(id); }, 500);
    if (tipus == 'doble') {
        mostrarBotoDau();
    } else if (tipus == 'quesito') {

    } else {

    }
    //setTimeout(function(){ $('#modalPregunta').show(); }, 500);
}

function mostrarBotoDau() {
    document.getElementById('botoDau').classList.remove('amagat');
}

function amagarBotoDau() {
    document.getElementById('botoDau').classList.add('amagat');
}

function jugar() {
    jugadorsArray[jugadorActual].iniciaTorn();
    mostrarBotoDau();
} 


function carregant() {
    var div = document.createElement('div');
    div.id = 'loading';
    div.style.width = '100%';
    div.style.height = '100%';
    div.style.background = 'rgb(0, 0, 0, 0.7)';
    div.style.position = 'absolute';
    div.style.zIndex = '1000';
    div.style.top = '0';
    div.style.left = '0';
    div.style.display = 'flex';
    div.style.justifyContent = 'center';
    div.style.alignItems = 'center';
    div.style.color = 'white';
    div.style.fontSize = '10rem';
    div.style.transition = 'opacity 0.3s ease-out';
    var loading = document.createElement('div');
    loading.style.opacity = '0.5';
    loading.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    div.appendChild(loading);
    document.body.appendChild(div);
}

function carregat() {
    var div = document.getElementById('loading');
    div.style.transition = 'opacity 0.3s ease-out';
    div.style.opacity = '0';
    div.style.zIndex = '-1000';
    document.body.removeChild(div);
}

function getGrup() {
    return eval("[" + readCookie("grup") + "]");
}

function loadJugadors() {
    
    jugadors = eval("[" + readCookie("jugadors") + "]");
    shuffle(jugadors);

    for (let j in jugadors) {
        getJugador(jugadors[j], j);
    }

}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


function getJugador(jugador, index) {
    var cookie = getCookie("nomjugadors");
    noms = cookie.split(',');
    $("#mostrarJugadors").append("<div style='background-color:" + jugador[1] + ";' class='row m-0' id='" + jugador[0] + "'><div class='ranking'></div><div class='col jugador'>" + noms[index] + "</div></div>");
}

function shuffle(array) {
    array.sort(() => Math.random() - 0.5);
  }

function crearJugadors() {
    for (let jugador in jugadors) {
        var j = new Jugador(jugadors[jugador][0], jugadors[jugador][1]);
        jugadorsArray.push(j);
    }
}

function Jugador(elementId, color) {
    this.id = elementId;
    var element = document.getElementById(elementId);
    this.color = color;
    this.tema1Puntuacio = 0;
    this.tema1Quesito = 0;
    this.tema1Encerts = 0;
    this.tema1Errors = 0;
    this.tema2Puntuacio = 0;
    this.tema2Quesito = 0;
    this.tema2Encerts = 0;
    this.tema2Errors = 0;
    this.tema3Puntuacio = 0;
    this.tema3Quesito = 0;
    this.tema3Encerts = 0;
    this.tema3Errors = 0;
    this.tema4Puntuacio = 0;
    this.tema4Quesito = 0;
    this.tema4Encerts = 0;
    this.tema4Errors = 0;
    this.tema5Puntuacio = 0;
    this.tema5Quesito = 0;
    this.tema5Encerts = 0;
    this.tema5Errors = 0;
    var casellaActual = document.getElementById('box_start');

    this.mostrarFitxa = function() {
        let div = document.createElement('div');
        div.id = this.id +'-icona';
        div.innerHTML = `<i style="color:${this.color}" class="fas fa-brain iconaJugador fa-xs"></i>`;
        casellaActual.appendChild(div);
    }

    this.canviarCasella = function(novaCasellaId) {
        document.getElementById(this.id+'-icona').remove();
        casellaActual = document.getElementById(novaCasellaId);
        this.mostrarFitxa();
    }

    this.iniciaTorn = function() {
        element.classList.add('actual');
    }

    this.finalitzaTorn = function() {
        element.classList.remove('actual');
    }

    this.getElement = function() {
        return element;
    }

    this.getCasellaActual = function() {
        return casellaActual;
    }

}

function desactivarCaselles() {
    $('.casilla').removeClass('parpadeo');
}

function Casella(elementId, tipus, tema) {

    $('#' + elementId).attr('data-tipus',tipus); 
    $('#' + elementId).attr('data-tema',tema);
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

    this.getCasellesAdjacents = function() {
        return casellesAdjacents;
    }
}


function dado(){
    $('#ui_dado').removeClass('amagat');
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

    var casellaActual = window[jugadorsArray[jugadorActual].getCasellaActual().id];
    casellaActual.activarCaselles(number);
    amagarBotoDau();
  }, 1120);
};