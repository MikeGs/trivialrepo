
jugadors = [];
jugadornom = "";
jugadorsArray = [];
jugadorActual = 0;
tema1 = '';
tema2 = '';
tema3 = ''
tema4 = '';
tema5 = '';
tema1nom = '';
tema2nom = '';
tema3nom = '';
tema4nom = '';
tema5nom = '';
idioma = 'cat';
params = getParams();
contadorActiu = false;

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
    
});

function contador(tema,quesito) {

    count = count - 1;
    if (count < 0) {
        contadorActiu = false;
        document.getElementById("timer").classList.remove('pass');
        document.getElementById("timer").classList.remove('scalered');
        document.getElementById("timer").classList.add('out');
        $('.respostaOpcio').addClass('no-pointer');
        var opcions = document.getElementsByClassName('respostaOpcio');

        for (var o in opcions) {
            if ($(opcions[o]).text().trim() == respostaCorrecta) {
         
                $(opcions[o]).removeClass('alert-info').addClass('alert-success');
            }    
        }
        tempsFinalitzat();
        if (quesito) {
            restarQuesito(tema);
            jugadorsArray[jugadorActual].printQuesitos();
        } else {
            restarPunts(tema);
        }
        jugadorsArray[jugadorActual].printEstadistiques();

        jugadorsArray[jugadorActual].finalitzaTorn();

        jugadorActual++;
        if (jugadorActual >= jugadorsArray.length) {
            jugadorActual = 0;

        }
        setTimeout(function(){
            jugadorsArray[jugadorActual].iniciaTorn();
            mostrarBotoDau();
            $('#modalPregunta').css('display', 'none');

            count = params[0][0]+1; 
            $('.respostaOpcio').removeClass('no-pointer');
            $('.respostaOpcio').removeClass('alert-success');
            $('.respostaOpcio').removeClass('alert-danger');
            $('.respostaOpcio').addClass('alert-info');
        }, 2000);
                
    } else {
        
        document.getElementById("timer").classList.add('pass');
        document.getElementById("time").innerHTML = count;
        if (count == (params[0][0]/2)) {
            document.getElementById("timer").classList.remove('pass');
             document.getElementById("timer").classList.add('scalered');           
        }
    
        if (contadorActiu) 
        {
            window.setTimeout("contador()", 1000);
        }
        
    }

}

function tempsFinalitzat() {

}

function prepararJoc() {
    var url = `{{ path('getTemes') }}`;
    $.post(url, { 'grup' : getGrup() })
    .done(function(response) {

        tema1 = response.tema1;
        tema2 = response.tema2;
        tema3 = response.tema3;
        tema4 = response.tema4;
        tema5 = response.tema5;
        tema1est = 'est-bar2';
        tema2est = 'est-bar5';
        tema3est = 'est-bar4';
        tema4est = 'est-bar3';
        tema5est = 'est-bar1';
        tema1nom = response.tema1nom;
        tema2nom = response.tema2nom;
        tema3nom = response.tema3nom;
        tema4nom = response.tema4nom;
        tema5nom = response.tema5nom;
        {% include 'partida/js/caselles.js' %}
        loadJugadors();
        $('#est-tema1').text(tema1nom);
        $('#est-tema2').text(tema2nom);
        $('#est-tema3').text(tema3nom);
        $('#est-tema4').text(tema4nom);
        $('#est-tema5').text(tema5nom);
        
    });
}

function mostrarPregunta(id, tema, tipus) {
    var url = `{{ path('getPregunta_ajax') }}`;
    desactivarCaselles();
    setTimeout(function(){ jugadorsArray[jugadorActual].canviarCasella(id); }, 500);
    if (tipus == 'doble') {
        mostrarBotoDau();
    } else if (tipus == 'quesito') {
        $.post(url, { 'tema': tema, 'idioma': idioma, 'quesito': true })
        .done(function(response) {
            $('#modalTitol').text(assignarTemaModal(tema, true));
            $('#pregunta').text(response.pregunta);
            respostaCorrecta = response.respostaCorrecta;
            respostes = [
                response.respostaCorrecta, 
                response.respostaIncorrecta1,
                response.respostaIncorrecta2,
                response.respostaIncorrecta3
                ];
             
            shuffle(respostes);
            assignarRespostesModal(respostes);
            setTimeout(function(){ 
                $('#modalPregunta').show(); 
                $('#ui_dado').addClass('amagat');
                $('#result').text('');
            }, 500);

            count = params[0][0]+1;
            contadorActiu = true;
        
            contador(tema,true);
            $('body').on('click','.respostaOpcio', function() {

                $('.respostaOpcio').addClass('no-pointer');
                if ($(this).text().trim() == response.respostaCorrecta) {
                    $(this).removeClass('alert-info').addClass('alert-success');

                    assignarQuesito(tema);
                    jugadorsArray[jugadorActual].printQuesitos();
                    jugadorsArray[jugadorActual].printEstadistiques();
                    //comprovar si s'acaba partida
                    if (jugadorsArray[jugadorActual].sumaQuesitos >= 5) {
                        //acaba
                    } else {
                        setTimeout(function(){ 
                            mostrarBotoDau();
                        }, 2000);
                    }
                } else {
                    $(this).removeClass('alert-info').addClass('alert-danger');
                    var opcions = document.getElementsByClassName('respostaOpcio');
                    for (var o in opcions) {
                        if ($(opcions[o]).text().trim() == response.respostaCorrecta) {
                            $(opcions[o]).removeClass('alert-info').addClass('alert-success');
                        }    
                    }
                    restarQuesito(tema);
                    jugadorsArray[jugadorActual].printQuesitos();
                    jugadorsArray[jugadorActual].printEstadistiques();
                    jugadorsArray[jugadorActual].finalitzaTorn();

                    jugadorActual++;
                    if (jugadorActual >= jugadorsArray.length) {
                        jugadorActual = 0;

                    }
                    setTimeout(function(){
                        jugadorsArray[jugadorActual].iniciaTorn();
                        mostrarBotoDau();
                    }, 2000);
                }
                setTimeout(function(){ 
                    $('#modalPregunta').css('display', 'none'); 
                    count = params[0][0]+1; 
                    $('.respostaOpcio').removeClass('no-pointer');
                    $('.respostaOpcio').removeClass('alert-success');
                    $('.respostaOpcio').removeClass('alert-danger');
                    $('.respostaOpcio').addClass('alert-info');
                }, 2000);
                contadorActiu = false;
                $("body").off("click",'.respostaOpcio');
            });

        });
    } else {
        $.post(url, { 'tema': tema, 'idioma': idioma, 'quesito': false })
        .done(function(response) {
            $('#modalTitol').text(assignarTemaModal(tema, false));
            $('#pregunta').text(response.pregunta);
            respostaCorrecta = response.respostaCorrecta;
            respostes = [
                response.respostaCorrecta, 
                response.respostaIncorrecta1,
                response.respostaIncorrecta2,
                response.respostaIncorrecta3
                ];
            
            shuffle(respostes);
            assignarRespostesModal(respostes);
            setTimeout(function(){ 
                $('#modalPregunta').show(); 
                $('#ui_dado').addClass('amagat');
                $('#result').text('');
            }, 500);

            count = params[0][0]+1;
            contadorActiu = true;

            contador(tema,false);

            $('body').on('click','.respostaOpcio', function() {

                $('.respostaOpcio').addClass('no-pointer');
                if ($(this).text().trim() == response.respostaCorrecta) {
                    $(this).removeClass('alert-info').addClass('alert-success');
                    
                    sumarPunts(tema);
                    jugadorsArray[jugadorActual].printEstadistiques();
                    setTimeout(function(){ 
                        mostrarBotoDau();
                    }, 2000);
                    
                } else {
                    $(this).removeClass('alert-info').addClass('alert-danger');
                    var opcions = document.getElementsByClassName('respostaOpcio');
                    for (var o in opcions) {
                        if ($(opcions[o]).text().trim() == response.respostaCorrecta) {
                            $(opcions[o]).removeClass('alert-info').addClass('alert-success');
                        }    
                    }
                    restarPunts(tema);
                    jugadorsArray[jugadorActual].printEstadistiques();
                    //saltar torn
                    jugadorsArray[jugadorActual].finalitzaTorn();

                    jugadorActual++;
                    if (jugadorActual >= jugadorsArray.length) {
                        jugadorActual = 0;

                    }
                    setTimeout(function(){
                        jugadorsArray[jugadorActual].iniciaTorn();
                        mostrarBotoDau();
                    }, 2000);
                }
            
                setTimeout(function(){ 
                    $('#modalPregunta').css('display', 'none'); 
                    count = params[0][0]+1; 
                    $('.respostaOpcio').removeClass('no-pointer');
                    $('.respostaOpcio').removeClass('alert-success');
                    $('.respostaOpcio').removeClass('alert-danger');
                    $('.respostaOpcio').addClass('alert-info');
                }, 2000);
                contadorActiu = false;
                $("body").off("click",'.respostaOpcio');
            });
        });
    }
}

function assignarRespostesModal(respostes) {
    $('#respostaAText').text(respostes[0]);
    $('#respostaBText').text(respostes[1]);
    $('#respostaCText').text(respostes[2]);
    $('#respostaDText').text(respostes[3]);
}

function getParams() {
    return eval("[" + readCookie("params") + "]");
}

function assignarTemaModal(tema, quesito) {
    var titolModal = '';
    if (tema1 == tema) {
        titolModal = tema1nom;
        $('.modal-header').css({'background-color': '#5CB85C', 'border-bottom': '1px solid #5CB85C'});
    } else if (tema2 == tema) {
        titolModal = tema2nom;
        $('.modal-header').css({'background-color': '#D9534F', 'border-bottom': '1px solid #D9534F'});
    } else if (tema3 == tema) {
        titolModal = tema3nom;
        $('.modal-header').css({'background-color': '#5BBFDE', 'border-bottom': '1px solid #5BBFDE'});
    } else if (tema4 == tema) {
        titolModal = tema4nom;
        $('.modal-header').css({'background-color': '#876EDF', 'border-bottom': '1px solid #876EDF'});
    } else if (tema5 == tema) {
        titolModal = tema5nom;
        $('.modal-header').css({'background-color': '#F0D54E', 'border-bottom': '1px solid #F0D54E'});
    }
    if (quesito) {
        $('.modal-header').addClass('header-quesito');
    } else {
        $('.modal-header').removeClass('header-quesito');
    }
    return titolModal;
}

function assignarQuesito(tema) {
    var nom = jugadorsArray[jugadorActual].getElement().textContent;
    var color = '';
    var msg = `El jugador <strong>${nom}</strong> ha guanyat el formatget `;
    if (tema1 == tema) {
        jugadorsArray[jugadorActual].addQuesitoTema1();
        msg += `verd!`;
        color = '#5CB85C';
        jugadorsArray[jugadorActual].tema1Encerts += 1;
        jugadorsArray[jugadorActual].tema1Puntuacio += params[0][2];
        console.log(jugadorsArray[jugadorActual].tema1Encerts)
    } else if (tema2 == tema) {
        jugadorsArray[jugadorActual].addQuesitoTema2();
        msg += `vermell!`;
        color = '#D9534F';
        jugadorsArray[jugadorActual].tema2Encerts += 1;
        jugadorsArray[jugadorActual].tema2Puntuacio += params[0][2];
        console.log(jugadorsArray[jugadorActual].tema2Encerts)
    } else if (tema3 == tema) {
        jugadorsArray[jugadorActual].addQuesitoTema3();
        msg += `blau!`;
        color = '#5BBFDE';
        jugadorsArray[jugadorActual].tema3Encerts += 1;
        jugadorsArray[jugadorActual].tema3Puntuacio += params[0][2];
        console.log(jugadorsArray[jugadorActual].tema3Encerts)
    } else if (tema4 == tema) {
        jugadorsArray[jugadorActual].addQuesitoTema4();
        msg += `lila!`;
        color = '#876EDF';
        jugadorsArray[jugadorActual].tema4Encerts += 1;
        jugadorsArray[jugadorActual].tema4Puntuacio += params[0][2];
        console.log(jugadorsArray[jugadorActual].tema4Encerts)
    } else if (tema5 == tema) {
        jugadorsArray[jugadorActual].addQuesitoTema5();
        msg += `groc!`;
        color = '#F0D54E';
        jugadorsArray[jugadorActual].tema5Encerts += 1;
        jugadorsArray[jugadorActual].tema5Puntuacio += params[0][2];
        console.log(jugadorsArray[jugadorActual].tema5Encerts)
    }

    jugadorsArray[jugadorActual].totalPuntuacio += params[0][2];
    $('#points-span').text(jugadorsArray[jugadorActual].totalPuntuacio);
    $('#points-shadow-span').text($('#points-span').text());
    
    var quesitoLog = [msg, color];

    return quesitoLog;
}

function restarQuesito(tema) {
    var nom = jugadorsArray[jugadorActual].getElement().textContent;
    var color = '';
    var msg = `El jugador <strong>${nom}</strong> ha perdut el formatget `;
    if (tema1 == tema) {
        jugadorsArray[jugadorActual].removeQuesitoTema1();
        msg += `verd!`;
        color = '#5CB85C';
        jugadorsArray[jugadorActual].tema1Errors += 1;
        jugadorsArray[jugadorActual].tema1Puntuacio -= params[0][2];
        if (jugadorsArray[jugadorActual].tema1Puntuacio < 0) {
            jugadorsArray[jugadorActual].tema1Puntuacio = 0;
        } 
    } else if (tema2 == tema) {
        jugadorsArray[jugadorActual].removeQuesitoTema2();
        msg += `vermell!`;
        color = '#D9534F';
        jugadorsArray[jugadorActual].tema2Errors += 1;
        jugadorsArray[jugadorActual].tema2Puntuacio -= params[0][2];
        if (jugadorsArray[jugadorActual].tema2Puntuacio < 0) {
            jugadorsArray[jugadorActual].tema2Puntuacio = 0;
        } 
    } else if (tema3 == tema) {
        jugadorsArray[jugadorActual].removeQuesitoTema3();
        msg += `blau!`;
        color = '#5BBFDE';
        jugadorsArray[jugadorActual].tema3Errors += 1;
        jugadorsArray[jugadorActual].tema3Puntuacio -= params[0][2];
        if (jugadorsArray[jugadorActual].tema3Puntuacio < 0) {
            jugadorsArray[jugadorActual].tema3Puntuacio = 0;
        } 
    } else if (tema4 == tema) {
        jugadorsArray[jugadorActual].removeQuesitoTema4();
        msg += `lila!`;
        color = '#876EDF';
        jugadorsArray[jugadorActual].tema4Errors += 1;
        jugadorsArray[jugadorActual].tema4Puntuacio -= params[0][2];
        if (jugadorsArray[jugadorActual].tema4Puntuacio < 0) {
            jugadorsArray[jugadorActual].tema4Puntuacio = 0;
        } 
    } else if (tema5 == tema) {
        jugadorsArray[jugadorActual].removeQuesitoTema5();
        msg += `groc!`;
        color = '#F0D54E';
        jugadorsArray[jugadorActual].tema5Errors += 1;
        jugadorsArray[jugadorActual].tema5Puntuacio -= params[0][2];
        if (jugadorsArray[jugadorActual].tema5Puntuacio < 0) {
            jugadorsArray[jugadorActual].tema5Puntuacio = 0;
        } 
    }
    jugadorsArray[jugadorActual].totalPuntuacio -= params[0][2];
    if (jugadorsArray[jugadorActual].totalPuntuacio < 0) {
        jugadorsArray[jugadorActual].totalPuntuacio = 0;
    } 
    $('#points-span').text(jugadorsArray[jugadorActual].totalPuntuacio);
    $('#points-shadow-span').text($('#points-span').text());
    
    var quesitoLog = [msg, color];

    return quesitoLog;
}

function sumarPunts(tema) {
    var nom = jugadorsArray[jugadorActual].getElement().textContent;
    var color = '';
    var msg = `El jugador <strong>${nom}</strong> ha guanyat ${params[0][1]} punts!`;
    if (tema1 == tema) {
        color = '#5CB85C';
        jugadorsArray[jugadorActual].tema1Encerts += 1;
        jugadorsArray[jugadorActual].tema1Puntuacio += params[0][1];
    } else if (tema2 == tema) {
        color = '#D9534F';
        jugadorsArray[jugadorActual].tema2Encerts += 1;
        jugadorsArray[jugadorActual].tema2Puntuacio += params[0][1];
    } else if (tema3 == tema) {
        color = '#5BBFDE';
        jugadorsArray[jugadorActual].tema3Encerts += 1;
        jugadorsArray[jugadorActual].tema3Puntuacio += params[0][1];
    } else if (tema4 == tema) {
        color = '#876EDF';
        jugadorsArray[jugadorActual].tema4Encerts += 1;
        jugadorsArray[jugadorActual].tema4Puntuacio += params[0][1];
    } else if (tema5 == tema) {
        color = '#F0D54E';
        jugadorsArray[jugadorActual].tema5Encerts += 1;
        jugadorsArray[jugadorActual].tema5Puntuacio += params[0][1];
    }

    jugadorsArray[jugadorActual].totalPuntuacio += params[0][1];
    $('#points-span').text(jugadorsArray[jugadorActual].totalPuntuacio);
    $('#points-shadow-span').text($('#points-span').text());
    
    var quesitoLog = [msg, color];

    return quesitoLog;
}

function restarPunts(tema) {
    var nom = jugadorsArray[jugadorActual].getElement().textContent;
    var color = '';
    var msg = `El jugador <strong>${nom}</strong> ha perdut ${params[0][1]} punts!`;
    if (tema1 == tema) {
        color = '#5CB85C';
        jugadorsArray[jugadorActual].tema1Errors += 1;
        jugadorsArray[jugadorActual].tema1Puntuacio -= params[0][1];
        if (jugadorsArray[jugadorActual].tema1Puntuacio < 0) {
            jugadorsArray[jugadorActual].tema1Puntuacio = 0;
        } 
        
    } else if (tema2 == tema) {
        color = '#D9534F';
        jugadorsArray[jugadorActual].tema2Errors += 1;
        jugadorsArray[jugadorActual].tema2Puntuacio -= params[0][1];
        if (jugadorsArray[jugadorActual].tema2Puntuacio < 0) {
            jugadorsArray[jugadorActual].tema2Puntuacio = 0;
        } 
        
    } else if (tema3 == tema) {
        color = '#5BBFDE';
        jugadorsArray[jugadorActual].tema3Errors += 1;
        jugadorsArray[jugadorActual].tema3Puntuacio -= params[0][1];
        if (jugadorsArray[jugadorActual].tema3Puntuacio < 0) {
            jugadorsArray[jugadorActual].tema3Puntuacio = 0;
        } 
        
    } else if (tema4 == tema) {
        color = '#876EDF';
        jugadorsArray[jugadorActual].tema4Errors += 1;
        jugadorsArray[jugadorActual].tema4Puntuacio -= params[0][1];
        if (jugadorsArray[jugadorActual].tema4Puntuacio < 0) {
            jugadorsArray[jugadorActual].tema4Puntuacio = 0;
        } 
        
    } else if (tema5 == tema) {
        color = '#F0D54E';
        jugadorsArray[jugadorActual].tema5Errors += 1;
        jugadorsArray[jugadorActual].tema5Puntuacio -= params[0][1];
        if (jugadorsArray[jugadorActual].tema5Puntuacio < 0) {
            jugadorsArray[jugadorActual].tema5Puntuacio = 0;
        } 
        
    }

    jugadorsArray[jugadorActual].totalPuntuacio -= params[0][1];
    if (jugadorsArray[jugadorActual].totalPuntuacio < 0) {
        jugadorsArray[jugadorActual].totalPuntuacio = 0;
    } 
    $('#points-span').text(jugadorsArray[jugadorActual].totalPuntuacio);
    $('#points-shadow-span').text($('#points-span').text());
    
    var quesitoLog = [msg, color];

    return quesitoLog;
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
    $("#mostrarJugadors").append("<div style='background-color:" + jugador[1] + ";' class='row m-0' id='" + jugador[0] + "'><div class='ranking'></div><div class='col jugador'>" + noms[index].replace(/`/g, '') + "</div></div>");
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
    this.totalPuntuacio = 0;
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
        $('#points-span').text(jugadorsArray[jugadorActual].totalPuntuacio);
        $('#points-shadow-span').text($('#points-span').text());
        jugadorsArray[jugadorActual].printQuesitos();
        jugadorsArray[jugadorActual].printEstadistiques();
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

    this.sumaQuesitos = function() {
        return this.tema1Quesito + this.tema2Quesito + this.tema3Quesito + this.tema4Quesito + this.tema5Quesito;
    }

    this.addQuesitoTema1 = function() {
        this.tema1Quesito = 1;
    }

    this.removeQuesitoTema1 = function() {
        this.tema1Quesito = 0;
    }

    this.addQuesitoTema2 = function() {
        this.tema2Quesito = 1;
        
    }

    this.removeQuesitoTema2 = function() {
        this.tema2Quesito = 0;


    }

    this.addQuesitoTema3 = function() {
        this.tema3Quesito = 1;
        
    }

    this.removeQuesitoTema3 = function() {
        this.tema3Quesito = 0;
       

    }

    this.addQuesitoTema4 = function() {
        this.tema4Quesito = 1;
        
    }

    this.removeQuesitoTema4 = function() {
        this.tema4Quesito = 0;
       

    }

    this.addQuesitoTema5 = function() {
        this.tema5Quesito = 1;


    }

    this.removeQuesitoTema5 = function() {
        this.tema5Quesito = 0;
     

    }

    this.printQuesitos = function() {
        if (this.tema1Quesito == 1) {
            $('.verd').removeClass('no-quesito');
        } else {
            $('.verd').addClass('no-quesito');
        }
        if (this.tema2Quesito == 1) {
            $('.vermell').removeClass('no-quesito');
        } else {
            $('.vermell').addClass('no-quesito');
        }
        if (this.tema3Quesito == 1) {
            $('.blau').removeClass('no-quesito');
        } else {
            $('.blau').addClass('no-quesito');
        }
        if (this.tema4Quesito == 1) {
            $('.lila').removeClass('no-quesito');
        } else {
            $('.lila').addClass('no-quesito');
        }
        if (this.tema5Quesito == 1) {
            $('.groc').removeClass('no-quesito');
        } else {
            $('.groc').addClass('no-quesito');
        }
    }

    this.printEstadistiques = function() {
        var max1 = this.tema1Encerts + this.tema1Errors;
        var actualEncerts1 = (this.tema1Encerts / max1) * 100;

        $('#'+tema1est).attr('aria-valuenow', actualEncerts1);
        $('#'+tema1est).css('width', actualEncerts1 + '%');


        var max2 = this.tema2Encerts + this.tema2Errors;
        var actualEncerts2 = (this.tema2Encerts / max2) * 100;

        $('#'+tema2est).attr('aria-valuenow', actualEncerts2);
        $('#'+tema2est).css('width', actualEncerts2 + '%');

        var max3 = this.tema3Encerts + this.tema3Errors;
        var actualEncerts3 = (this.tema3Encerts / max3) * 100;

        $('#'+tema3est).attr('aria-valuenow', actualEncerts3);
        $('#'+tema3est).css('width', actualEncerts3 + '%');

        var max4 = this.tema4Encerts + this.tema4Errors;
        var actualEncerts4 = (this.tema4Encerts / max4) * 100;

        $('#'+tema4est).attr('aria-valuenow', actualEncerts4);
        $('#'+tema4est).css('width', actualEncerts4 + '%');

        var max5 = this.tema5Encerts + this.tema5Errors;
        var actualEncerts5 = (this.tema5Encerts / max5) * 100;

        $('#'+tema5est).attr('aria-valuenow', actualEncerts5);
        $('#'+tema5est).css('width', actualEncerts5 + '%');
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
    $('#ui_dado').css('zIndex', '2');
  $('#platform').removeClass('stop').addClass('playing');
  $('#dice');
  setTimeout(function(){
    $('#platform').removeClass('playing').addClass('stop');
    $('#ui_dado').css('zIndex', '1');
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