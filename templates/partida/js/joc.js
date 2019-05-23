
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
fiDelJoc = false;

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

function contador(quesito) {

    count = count - 1;
    if (count < 0 && !fiDelJoc) {
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
        var newLog = document.createElement('div');
        newLog.style.color = 'red';
        newLog.innerHTML = 'S\'ha acabat el temps!';
        document.getElementById('log').appendChild(newLog);
        updateScroll();
        if (quesito) {
            printLog(restarQuesito(temaGlob));
            jugadorsArray[jugadorActual].printQuesitos();
        } else {
            printLog(restarPunts(temaGlob));
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
            document.getElementById("timer").classList.remove('out');
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

function ordenarJugadors() {
    jugadorsOrdenats = jugadorsArray.slice(0, jugadorsArray.length);
    
    jugadorsOrdenats.sort(function (a,b) {
        return b.totalPuntuacio - a.totalPuntuacio
    });
    for (let j in jugadorsOrdenats) {
        $('#' + jugadorsOrdenats[j].id + '> .ranking').html(parseInt(j)+1);
    }
}

function printLog(log) {

    var newLog = document.createElement('div');
    newLog.style.color = log[1];
    newLog.innerHTML = log[0];
    document.getElementById('log').appendChild(newLog);
    updateScroll();
}

function mostrarPregunta(id, tema, tipus) {
    temaGlob = tema;
    var url = `{{ path('getPregunta_ajax') }}`;
    desactivarCaselles();
    setTimeout(function(){ jugadorsArray[jugadorActual].canviarCasella(id); }, 500);
    if (tipus == 'doble') {
        mostrarBotoDau();
        var nom = jugadorsArray[jugadorActual].getElement().textContent;
        var newLog = document.createElement('div');
        newLog.style.color = 'blue';
        newLog.innerHTML = `<strong>${nom.replace(/[0-9]/, '')}</strong> torna a tirar!`;
        document.getElementById('log').appendChild(newLog);
        updateScroll();
    } else if (tipus =='inici') {
        jugadorsArray[jugadorActual].finalitzaTorn();

            jugadorActual++;
            if (jugadorActual >= jugadorsArray.length) {
                jugadorActual = 0;

            }
            setTimeout(function(){
                jugadorsArray[jugadorActual].iniciaTorn();
                mostrarBotoDau();
            }, 2000);
        
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

                    printLog(assignarQuesito(tema));

                    jugadorsArray[jugadorActual].printQuesitos();
                    jugadorsArray[jugadorActual].printEstadistiques();
                
                    if (jugadorsArray[jugadorActual].sumaQuesitos() == 5) {

                        fiJoc();
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
                    printLog(restarQuesito(tema));
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
                    
                    printLog(sumarPunts(tema));
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
                    printLog(restarPunts(tema));
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
    var msg = `El jugador <strong>${nom.replace(/[0-9]/, '')}</strong> ha guanyat el formatget `;
    if (tema1 == tema) {
        jugadorsArray[jugadorActual].addQuesitoTema1();
        msg += `verd!`;
        color = '#189218';
        jugadorsArray[jugadorActual].tema1Encerts += 1;
        jugadorsArray[jugadorActual].tema1Puntuacio += params[0][2];
    
    } else if (tema2 == tema) {
        jugadorsArray[jugadorActual].addQuesitoTema2();
        msg += `vermell!`;
        color = '#C12824';
        jugadorsArray[jugadorActual].tema2Encerts += 1;
        jugadorsArray[jugadorActual].tema2Puntuacio += params[0][2];
     
    } else if (tema3 == tema) {
        jugadorsArray[jugadorActual].addQuesitoTema3();
        msg += `blau!`;
        color = '#0283AC';
        jugadorsArray[jugadorActual].tema3Encerts += 1;
        jugadorsArray[jugadorActual].tema3Puntuacio += params[0][2];
  
    } else if (tema4 == tema) {
        jugadorsArray[jugadorActual].addQuesitoTema4();
        msg += `lila!`;
        color = '#583EB0';
        jugadorsArray[jugadorActual].tema4Encerts += 1;
        jugadorsArray[jugadorActual].tema4Puntuacio += params[0][2];
      
    } else if (tema5 == tema) {
        jugadorsArray[jugadorActual].addQuesitoTema5();
        msg += `groc!`;
        color = '#DD9334';
        jugadorsArray[jugadorActual].tema5Encerts += 1;
        jugadorsArray[jugadorActual].tema5Puntuacio += params[0][2];
       
    }

    jugadorsArray[jugadorActual].totalPuntuacio += params[0][2];
    $('#points-span').text(jugadorsArray[jugadorActual].totalPuntuacio);
    $('#points-shadow-span').text($('#points-span').text());
    ordenarJugadors();
    var quesitoLog = [msg, color];

    return quesitoLog;
}

function restarQuesito(tema) {
    var nom = jugadorsArray[jugadorActual].getElement().textContent;
    var color = '';
    var msg = `El jugador <strong>${nom.replace(/[0-9]/, '')}</strong> ha perdut el formatget `;
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
    msg += ' -100 punts.'
    var quesitoLog = [msg, color];
    ordenarJugadors();
    return quesitoLog;
}

function sumarPunts(tema) {
    var nom = jugadorsArray[jugadorActual].getElement().textContent;
    var color = '';
    var msg = `El jugador <strong>${nom.replace(/[0-9]/, '')}</strong> ha guanyat ${params[0][1]} punts!`;
    if (tema1 == tema) {
        color = '#189218';
        jugadorsArray[jugadorActual].tema1Encerts += 1;
        jugadorsArray[jugadorActual].tema1Puntuacio += params[0][1];
    } else if (tema2 == tema) {
        color = '#C12824';
        jugadorsArray[jugadorActual].tema2Encerts += 1;
        jugadorsArray[jugadorActual].tema2Puntuacio += params[0][1];
    } else if (tema3 == tema) {
        color = '#0283AC';
        jugadorsArray[jugadorActual].tema3Encerts += 1;
        jugadorsArray[jugadorActual].tema3Puntuacio += params[0][1];
    } else if (tema4 == tema) {
        color = '#583EB0';
        jugadorsArray[jugadorActual].tema4Encerts += 1;
        jugadorsArray[jugadorActual].tema4Puntuacio += params[0][1];
    } else if (tema5 == tema) {
        color = '#DD9334';
        jugadorsArray[jugadorActual].tema5Encerts += 1;
        jugadorsArray[jugadorActual].tema5Puntuacio += params[0][1];
    }

    jugadorsArray[jugadorActual].totalPuntuacio += params[0][1];
    $('#points-span').text(jugadorsArray[jugadorActual].totalPuntuacio);
    $('#points-shadow-span').text($('#points-span').text());
    
    var quesitoLog = [msg, color];
    ordenarJugadors();
    return quesitoLog;
}

function restarPunts(tema) {
    console.log(tema);
    var nom = jugadorsArray[jugadorActual].getElement().textContent;
    var color = '';
    var msg = `El jugador <strong>${nom.replace(/[0-9]/, '')}</strong> ha perdut ${params[0][1]} punts!`;
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
    ordenarJugadors();
    return quesitoLog;
}

function fiJoc() {
    fiDelJoc = true;
    var primer = jugadorsOrdenats[0].getElement().textContent;
    primer = primer.split(' ');
    primer = primer[0];
    primer = primer.replace(/[0-9]/, '');
    var segon = jugadorsOrdenats[1].getElement().textContent;
    segon = segon.split(' ');
    segon = segon[0];
    segon = segon.replace(/[0-9]/, '');
    if (jugadorsOrdenats.length > 2) {
        var tercer = jugadorsOrdenats[2].getElement().textContent;
        tercer = tercer.split(' ');
        tercer = tercer[0];
        tercer = tercer.replace(/[0-9]/, '');
    } else {
        tercer = '-';
    }
    

    setTimeout(function(){
        $('.modal-header').css({'background-color': 'transparent', 'border-bottom': 'none', 'background-image': 'linear-gradient(90deg, #47cf73, #ae63e4, #ffdd40, #0ebeff, #47cf73, #ae63e4, #ffdd40, #0ebeff)', 'background-size': '200% 200%'});
        $('#modalTitol').text('JOC COMPLETAT!');
        $('#timer').hide();
        $('.modal-body').html('<div style="height: 200px" class="mt-3 col-12 justify-content-center align-items-end d-flex"><div class="rounded-top col-2 bg-primary h-75 segon"><div><i class="fas fa-award"></i></div></div><div class="rounded-top col-2 bg-success h-100 primer"><div><i class="fas fa-trophy"></i></div></div><div class="rounded-top tercer col-2 bg-warning h-50"><div><i class="fas fa-medal"></i></div></div></div><div class="mt-2 col-12 text-center justify-content-center align-items-end d-flex numeros"><div class="col-2">2</div><div class="col-2">1</div><div class="col-2">3</div></div><div class="mt-2 col-12 text-center justify-content-center align-items-end d-flex nomswinners"><div class="col-2">' + segon + '</div><div class="col-2">' + primer + '</div><div class="col-2">' + tercer + '</div></div><div class="mt-5 col-12 text-center"><button class="btn-figame btn btn-lg btn-info">TORNAR A L\'INICI</button></div>');
        $('#modalPregunta').show();
        $('#confetti').addClass('yeei');
        confetti();
    }, 2500);

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

function updateScroll(){
    var element = document.getElementById("log");
    element.scrollTop = element.scrollHeight;
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
        $('#'+tema1est).attr('aria-valuenow', 0);
        $('#'+tema1est).css('width', 0 + '%');
        $('#'+tema1est).html('');
        $('#'+tema2est).attr('aria-valuenow', 0);
        $('#'+tema2est).css('width', 0 + '%');
        $('#'+tema2est).html('');
        $('#'+tema3est).attr('aria-valuenow', 0);
        $('#'+tema3est).css('width', 0 + '%');
        $('#'+tema3est).html('');
        $('#'+tema4est).attr('aria-valuenow', 0);
        $('#'+tema4est).css('width', 0 + '%');
        $('#'+tema4est).html('');
        $('#'+tema5est).attr('aria-valuenow', 0);
        $('#'+tema5est).css('width', 0 + '%');
        $('#'+tema5est).html('');
        jugadorsArray[jugadorActual].printEstadistiques();
        var nom = jugadorsArray[jugadorActual].getElement().textContent;
        var newLog = document.createElement('div');
        newLog.style.color = 'black';
        newLog.innerHTML = `>>> Torn de ${nom.replace(/[0-9]/, '')}`;
        document.getElementById('log').appendChild(newLog);
        updateScroll();
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
        var max1 = jugadorsArray[jugadorActual].tema1Encerts + jugadorsArray[jugadorActual].tema1Errors;
        var actualEncerts1 = (jugadorsArray[jugadorActual].tema1Encerts / max1) * 100;

        $('#'+tema1est).attr('aria-valuenow', actualEncerts1);
        $('#'+tema1est).css('width', actualEncerts1 + '%');
        if (!isNaN(actualEncerts1) || !actualEncerts1 == 0) {
            $('#'+tema1est).html(actualEncerts1 + '%');
        }
        
        var max2 = jugadorsArray[jugadorActual].tema2Encerts + jugadorsArray[jugadorActual].tema2Errors;
        var actualEncerts2 = (jugadorsArray[jugadorActual].tema2Encerts / max2) * 100;

        $('#'+tema2est).attr('aria-valuenow', actualEncerts2);
        $('#'+tema2est).css('width', actualEncerts2 + '%');
        if (!isNaN(actualEncerts2) || !actualEncerts2 == 0) {
            $('#'+tema2est).html(actualEncerts2 + '%');
        }

        var max3 = jugadorsArray[jugadorActual].tema3Encerts + jugadorsArray[jugadorActual].tema3Errors;
        var actualEncerts3 = (jugadorsArray[jugadorActual].tema3Encerts / max3) * 100;

        $('#'+tema3est).attr('aria-valuenow', actualEncerts3);
        $('#'+tema3est).css('width', actualEncerts3 + '%');
        if (!isNaN(actualEncerts3) || !actualEncerts3 == 0) {
            $('#'+tema3est).html(actualEncerts3 + '%');
        }

        var max4 = jugadorsArray[jugadorActual].tema4Encerts + jugadorsArray[jugadorActual].tema4Errors;
        var actualEncerts4 = (jugadorsArray[jugadorActual].tema4Encerts / max4) * 100;

        $('#'+tema4est).attr('aria-valuenow', actualEncerts4);
        $('#'+tema4est).css('width', actualEncerts4 + '%');
        if (!isNaN(actualEncerts4) || !actualEncerts4 == 0) {
            $('#'+tema4est).html(actualEncerts4 + '%');
        }

        var max5 = jugadorsArray[jugadorActual].tema5Encerts + jugadorsArray[jugadorActual].tema5Errors;
        var actualEncerts5 = (jugadorsArray[jugadorActual].tema5Encerts / max5) * 100;

        $('#'+tema5est).attr('aria-valuenow', actualEncerts5);
        $('#'+tema5est).css('width', actualEncerts5 + '%');
        if (!isNaN(actualEncerts5) || !actualEncerts5 == 0) {
            $('#'+tema5est).html(actualEncerts5 + '%');
        }
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

function confetti() {
    var frameRate = 30;
    var dt = 1.0 / frameRate;
    var DEG_TO_RAD = Math.PI / 180;
    var RAD_TO_DEG = 180 / Math.PI;
    var colors = [
        ["#df0049", "#660671"],
        ["#00e857", "#005291"],
        ["#2bebbc", "#05798a"],
        ["#ffd200", "#b06c00"]
    ];

    function Vector2(_x, _y) {
        this.x = _x, this.y = _y;
        this.Length = function() {
            return Math.sqrt(this.SqrLength());
        }
        this.SqrLength = function() {
            return this.x * this.x + this.y * this.y;
        }
        this.Equals = function(_vec0, _vec1) {
            return _vec0.x == _vec1.x && _vec0.y == _vec1.y;
        }
        this.Add = function(_vec) {
            this.x += _vec.x;
            this.y += _vec.y;
        }
        this.Sub = function(_vec) {
            this.x -= _vec.x;
            this.y -= _vec.y;
        }
        this.Div = function(_f) {
            this.x /= _f;
            this.y /= _f;
        }
        this.Mul = function(_f) {
            this.x *= _f;
            this.y *= _f;
        }
        this.Normalize = function() {
            var sqrLen = this.SqrLength();
            if (sqrLen != 0) {
                var factor = 1.0 / Math.sqrt(sqrLen);
                this.x *= factor;
                this.y *= factor;
            }
        }
        this.Normalized = function() {
            var sqrLen = this.SqrLength();
            if (sqrLen != 0) {
                var factor = 1.0 / Math.sqrt(sqrLen);
                return new Vector2(this.x * factor, this.y * factor);
            }
            return new Vector2(0, 0);
        }
    }
    Vector2.Lerp = function(_vec0, _vec1, _t) {
        return new Vector2((_vec1.x - _vec0.x) * _t + _vec0.x, (_vec1.y - _vec0.y) * _t + _vec0.y);
    }
    Vector2.Distance = function(_vec0, _vec1) {
        return Math.sqrt(Vector2.SqrDistance(_vec0, _vec1));
    }
    Vector2.SqrDistance = function(_vec0, _vec1) {
        var x = _vec0.x - _vec1.x;
        var y = _vec0.y - _vec1.y;
        return (x * x + y * y + z * z);
    }
    Vector2.Scale = function(_vec0, _vec1) {
        return new Vector2(_vec0.x * _vec1.x, _vec0.y * _vec1.y);
    }
    Vector2.Min = function(_vec0, _vec1) {
        return new Vector2(Math.min(_vec0.x, _vec1.x), Math.min(_vec0.y, _vec1.y));
    }
    Vector2.Max = function(_vec0, _vec1) {
        return new Vector2(Math.max(_vec0.x, _vec1.x), Math.max(_vec0.y, _vec1.y));
    }
    Vector2.ClampMagnitude = function(_vec0, _len) {
        var vecNorm = _vec0.Normalized;
        return new Vector2(vecNorm.x * _len, vecNorm.y * _len);
    }
    Vector2.Sub = function(_vec0, _vec1) {
        return new Vector2(_vec0.x - _vec1.x, _vec0.y - _vec1.y, _vec0.z - _vec1.z);
    }

    function EulerMass(_x, _y, _mass, _drag) {
        this.position = new Vector2(_x, _y);
        this.mass = _mass;
        this.drag = _drag;
        this.force = new Vector2(0, 0);
        this.velocity = new Vector2(0, 0);
        this.AddForce = function(_f) {
            this.force.Add(_f);
        }
        this.Integrate = function(_dt) {
            var acc = this.CurrentForce(this.position);
            acc.Div(this.mass);
            var posDelta = new Vector2(this.velocity.x, this.velocity.y);
            posDelta.Mul(_dt);
            this.position.Add(posDelta);
            acc.Mul(_dt);
            this.velocity.Add(acc);
            this.force = new Vector2(0, 0);
        }
        this.CurrentForce = function(_pos, _vel) {
            var totalForce = new Vector2(this.force.x, this.force.y);
            var speed = this.velocity.Length();
            var dragVel = new Vector2(this.velocity.x, this.velocity.y);
            dragVel.Mul(this.drag * this.mass * speed);
            totalForce.Sub(dragVel);
            return totalForce;
        }
    }

    function ConfettiPaper(_x, _y) {
        this.pos = new Vector2(_x, _y);
        this.rotationSpeed = Math.random() * 600 + 800;
        this.angle = DEG_TO_RAD * Math.random() * 360;
        this.rotation = DEG_TO_RAD * Math.random() * 360;
        this.cosA = 1.0;
        this.size = 5.0;
        this.oscillationSpeed = Math.random() * 1.5 + 0.5;
        this.xSpeed = 40.0;
        this.ySpeed = Math.random() * 60 + 50.0;
        this.corners = new Array();
        this.time = Math.random();
        var ci = Math.round(Math.random() * (colors.length - 1));
        this.frontColor = colors[ci][0];
        this.backColor = colors[ci][1];
        for (var i = 0; i < 4; i++) {
            var dx = Math.cos(this.angle + DEG_TO_RAD * (i * 90 + 45));
            var dy = Math.sin(this.angle + DEG_TO_RAD * (i * 90 + 45));
            this.corners[i] = new Vector2(dx, dy);
        }
        this.Update = function(_dt) {
            this.time += _dt;
            this.rotation += this.rotationSpeed * _dt;
            this.cosA = Math.cos(DEG_TO_RAD * this.rotation);
            this.pos.x += Math.cos(this.time * this.oscillationSpeed) * this.xSpeed * _dt
            this.pos.y += this.ySpeed * _dt;
            if (this.pos.y > ConfettiPaper.bounds.y) {
                this.pos.x = Math.random() * ConfettiPaper.bounds.x;
                this.pos.y = 0;
            }
        }
        this.Draw = function(_g) {
            if (this.cosA > 0) {
                _g.fillStyle = this.frontColor;
            } else {
                _g.fillStyle = this.backColor;
            }
            _g.beginPath();
            _g.moveTo(this.pos.x + this.corners[0].x * this.size, this.pos.y + this.corners[0].y * this.size * this.cosA);
            for (var i = 1; i < 4; i++) {
                _g.lineTo(this.pos.x + this.corners[i].x * this.size, this.pos.y + this.corners[i].y * this.size * this.cosA);
            }
            _g.closePath();
            _g.fill();
        }
    }
    ConfettiPaper.bounds = new Vector2(0, 0);

    function ConfettiRibbon(_x, _y, _count, _dist, _thickness, _angle, _mass, _drag) {
        this.particleDist = _dist;
        this.particleCount = _count;
        this.particleMass = _mass;
        this.particleDrag = _drag;
        this.particles = new Array();
        var ci = Math.round(Math.random() * (colors.length - 1));
        this.frontColor = colors[ci][0];
        this.backColor = colors[ci][1];
        this.xOff = Math.cos(DEG_TO_RAD * _angle) * _thickness;
        this.yOff = Math.sin(DEG_TO_RAD * _angle) * _thickness;
        this.position = new Vector2(_x, _y);
        this.prevPosition = new Vector2(_x, _y);
        this.velocityInherit = Math.random() * 2 + 4;
        this.time = Math.random() * 100;
        this.oscillationSpeed = Math.random() * 2 + 2;
        this.oscillationDistance = Math.random() * 40 + 40;
        this.ySpeed = Math.random() * 40 + 80;
        for (var i = 0; i < this.particleCount; i++) {
            this.particles[i] = new EulerMass(_x, _y - i * this.particleDist, this.particleMass, this.particleDrag);
        }
        this.Update = function(_dt) {
            var i = 0;
            this.time += _dt * this.oscillationSpeed;
            this.position.y += this.ySpeed * _dt;
            this.position.x += Math.cos(this.time) * this.oscillationDistance * _dt;
            this.particles[0].position = this.position;
            var dX = this.prevPosition.x - this.position.x;
            var dY = this.prevPosition.y - this.position.y;
            var delta = Math.sqrt(dX * dX + dY * dY);
            this.prevPosition = new Vector2(this.position.x, this.position.y);
            for (i = 1; i < this.particleCount; i++) {
                var dirP = Vector2.Sub(this.particles[i - 1].position, this.particles[i].position);
                dirP.Normalize();
                dirP.Mul((delta / _dt) * this.velocityInherit);
                this.particles[i].AddForce(dirP);
            }
            for (i = 1; i < this.particleCount; i++) {
                this.particles[i].Integrate(_dt);
            }
            for (i = 1; i < this.particleCount; i++) {
                var rp2 = new Vector2(this.particles[i].position.x, this.particles[i].position.y);
                rp2.Sub(this.particles[i - 1].position);
                rp2.Normalize();
                rp2.Mul(this.particleDist);
                rp2.Add(this.particles[i - 1].position);
                this.particles[i].position = rp2;
            }
            if (this.position.y > ConfettiRibbon.bounds.y + this.particleDist * this.particleCount) {
                this.Reset();
            }
        }
        this.Reset = function() {
            this.position.y = -Math.random() * ConfettiRibbon.bounds.y;
            this.position.x = Math.random() * ConfettiRibbon.bounds.x;
            this.prevPosition = new Vector2(this.position.x, this.position.y);
            this.velocityInherit = Math.random() * 2 + 4;
            this.time = Math.random() * 100;
            this.oscillationSpeed = Math.random() * 2.0 + 1.5;
            this.oscillationDistance = Math.random() * 40 + 40;
            this.ySpeed = Math.random() * 40 + 80;
            var ci = Math.round(Math.random() * (colors.length - 1));
            this.frontColor = colors[ci][0];
            this.backColor = colors[ci][1];
            this.particles = new Array();
            for (var i = 0; i < this.particleCount; i++) {
                this.particles[i] = new EulerMass(this.position.x, this.position.y - i * this.particleDist, this.particleMass, this.particleDrag);
            }
        }
        this.Draw = function(_g) {
            for (var i = 0; i < this.particleCount - 1; i++) {
                var p0 = new Vector2(this.particles[i].position.x + this.xOff, this.particles[i].position.y + this.yOff);
                var p1 = new Vector2(this.particles[i + 1].position.x + this.xOff, this.particles[i + 1].position.y + this.yOff);
                if (this.Side(this.particles[i].position.x, this.particles[i].position.y, this.particles[i + 1].position.x, this.particles[i + 1].position.y, p1.x, p1.y) < 0) {
                    _g.fillStyle = this.frontColor;
                    _g.strokeStyle = this.frontColor;
                } else {
                    _g.fillStyle = this.backColor;
                    _g.strokeStyle = this.backColor;
                }
                if (i == 0) {
                    _g.beginPath();
                    _g.moveTo(this.particles[i].position.x, this.particles[i].position.y);
                    _g.lineTo(this.particles[i + 1].position.x, this.particles[i + 1].position.y);
                    _g.lineTo((this.particles[i + 1].position.x + p1.x) * 0.5, (this.particles[i + 1].position.y + p1.y) * 0.5);
                    _g.closePath();
                    _g.stroke();
                    _g.fill();
                    _g.beginPath();
                    _g.moveTo(p1.x, p1.y);
                    _g.lineTo(p0.x, p0.y);
                    _g.lineTo((this.particles[i + 1].position.x + p1.x) * 0.5, (this.particles[i + 1].position.y + p1.y) * 0.5);
                    _g.closePath();
                    _g.stroke();
                    _g.fill();
                } else if (i == this.particleCount - 2) {
                    _g.beginPath();
                    _g.moveTo(this.particles[i].position.x, this.particles[i].position.y);
                    _g.lineTo(this.particles[i + 1].position.x, this.particles[i + 1].position.y);
                    _g.lineTo((this.particles[i].position.x + p0.x) * 0.5, (this.particles[i].position.y + p0.y) * 0.5);
                    _g.closePath();
                    _g.stroke();
                    _g.fill();
                    _g.beginPath();
                    _g.moveTo(p1.x, p1.y);
                    _g.lineTo(p0.x, p0.y);
                    _g.lineTo((this.particles[i].position.x + p0.x) * 0.5, (this.particles[i].position.y + p0.y) * 0.5);
                    _g.closePath();
                    _g.stroke();
                    _g.fill();
                } else {
                    _g.beginPath();
                    _g.moveTo(this.particles[i].position.x, this.particles[i].position.y);
                    _g.lineTo(this.particles[i + 1].position.x, this.particles[i + 1].position.y);
                    _g.lineTo(p1.x, p1.y);
                    _g.lineTo(p0.x, p0.y);
                    _g.closePath();
                    _g.stroke();
                    _g.fill();
                }
            }
        }
        this.Side = function(x1, y1, x2, y2, x3, y3) {
            return ((x1 - x2) * (y3 - y2) - (y1 - y2) * (x3 - x2));
        }
    }
    ConfettiRibbon.bounds = new Vector2(0, 0);
    confetti = {};
    confetti.Context = function(parent) {
        var i = 0;
        var canvasParent = document.getElementById(parent);
        var canvas = document.createElement('canvas');
        canvas.width = canvasParent.offsetWidth;
        canvas.height = canvasParent.offsetHeight;
        canvasParent.appendChild(canvas);
        var context = canvas.getContext('2d');
        var interval = null;
        var confettiRibbonCount = 7;
        var rpCount = 30;
        var rpDist = 8.0;
        var rpThick = 8.0;
        var confettiRibbons = new Array();
        ConfettiRibbon.bounds = new Vector2(canvas.width, canvas.height);
        for (i = 0; i < confettiRibbonCount; i++) {
            confettiRibbons[i] = new ConfettiRibbon(Math.random() * canvas.width, -Math.random() * canvas.height * 2, rpCount, rpDist, rpThick, 45, 1, 0.05);
        }
        var confettiPaperCount = 25;
        var confettiPapers = new Array();
        ConfettiPaper.bounds = new Vector2(canvas.width, canvas.height);
        for (i = 0; i < confettiPaperCount; i++) {
            confettiPapers[i] = new ConfettiPaper(Math.random() * canvas.width, Math.random() * canvas.height);
        }
        this.resize = function() {
            canvas.width = canvasParent.offsetWidth;
            canvas.height = canvasParent.offsetHeight;
            ConfettiPaper.bounds = new Vector2(canvas.width, canvas.height);
            ConfettiRibbon.bounds = new Vector2(canvas.width, canvas.height);
        }
        this.start = function() {
            this.stop()
            var context = this
            this.interval = setInterval(function() {
                confetti.update();
            }, 1000.0 / frameRate)
        }
        this.stop = function() {
            clearInterval(this.interval);
        }
        this.update = function() {
            var i = 0;
            context.clearRect(0, 0, canvas.width, canvas.height);
            for (i = 0; i < confettiPaperCount; i++) {
                confettiPapers[i].Update(dt);
                confettiPapers[i].Draw(context);
            }
            for (i = 0; i < confettiRibbonCount; i++) {
                confettiRibbons[i].Update(dt);
                confettiRibbons[i].Draw(context);
            }
        }
    }
    var confetti = new confetti.Context('confetti');
    confetti.start();
    $(window).resize(function() {
        confetti.resize();
    });
}