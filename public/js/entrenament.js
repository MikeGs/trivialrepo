pregunta = '';
checkpreguntaBool = false;
respostaFinale = '';
checkRespostaBool = false;

checkPartidaPujadaBool = false;
respostaPartidaPujada = '';

partidaId = '';
currentTema = '';

PujarTemesResponse = '';
checkTemesPartidaPujatsBool = false;

//puntuacio = 0;

nivellid = readCookie("nivell");

function QuestionLoop(id) {

    if (id != preguntes.ids[0].length - 1) {

        $.post(urlGetPregunta, { 'preguntaId': preguntes.ids[0][id] }) 
            .done(function(response) {
                pregunta = response;
        });

        /*if (id == 2) {
            pujarTemes_Partida();
        }*/

        setTimeout(function(){ checkPregunta() }, 500);

    } else {
        
        alert("Fi de l'entrenament!");
        pujarTemes_Partida();

    }

}

function pujarTemes_Partida() {

    Temes_partida = [];

    /*console.log(temesPuntuacio);
    console.log(temesEncerts);
    console.log(temesErrors);*/

    temes.forEach(function(tema, idx) {

        var tp = new Tema_partida(tema, temesPuntuacio[idx], temesEncerts[idx], temesErrors[idx]);
        Temes_partida[idx] = tp;

    });

    console.log(Temes_partida);

    Temes_partidaJSON = JSON.stringify(Temes_partida);

    $.post(urlPujarTemes, { 'temes_partidaJSON': Temes_partidaJSON }) 
            .done(function(response) {
                PujarTemesResponse = response;
        });

        setTimeout(function(){ checkTemesPartidaPujats() }, 500);

}

function checkTemesPartidaPujats() {

    if (PujarTemesResponse == '') {
        checkTemesPartidaPujatsBool = false;
        checkTemesPartidaPujats();
    } else {
        checkTemesPartidaPujatsBool = true;
    }

    if (checkTemesPartidaPujatsBool) {
        console.log("Temes_partida pujats correctament");
    }

}

function Tema_partida(temaid, puntuacio, encerts, errors) {
    // 	id	usuari_id	partida_id	id_tema_id	nom	puntuacio	encerts	errors	formatges

    this.usuari_id = 0;
    this.partida_id = partidaId;
    this.id_tema_id = temaid;
    this.nom = "Tema";
    this.puntuacio = puntuacio;
    this.encerts = encerts;
    this.errors = errors;
    this.formatges = 0;

}

function pujarPartida() {

    partida = new Partida();

    $.post(urlPujarPartida, { 'partida': partida}) 
            .done(function(response) {
                respostaPartidaPujada = eval('[' + response + ']');
        });

    setTimeout(function(){ checkPartidaPujada() }, 500);
    
}

function checkPartidaPujada() {

    if (respostaPartidaPujada == '') {
        checkPartidaPujadaBool = false;
        checkPartidaPujada();
    } else {
        checkPartidaPujadaBool = true;
    }

    if (checkPartidaPujadaBool) {
        console.log("Partida pujada correctament");
        console.log("partidaid: " + respostaPartidaPujada[0]);
        partidaId = respostaPartidaPujada[0];
    }

}

function checkPregunta() {

    if (pregunta == '') {
        checkpreguntaBool = false;
        checkPregunta();
    } else {
        checkpreguntaBool = true;
    }

    if (checkpreguntaBool) {
        var preguntaObj = JSON.parse(pregunta);
        pregunta = '';
        pregunta = new Pregunta(preguntaObj);
        preguntaObj = '';

        currentTema = pregunta.tema;

        console.log(pregunta);

        updateCamps();
    }

}

function Partida() {

    this.data = data.getDate() + "/" + (data.getMonth()+1) + "/" + data.getFullYear();
    this.idNivell = nivellid;
    this.idTipusPartida = 2;

}

function Pregunta(obj) {

    this.id = obj.id;
    this.tema = obj.tema;
    this.tipusid = obj.tipusid;
    this.dificultat = obj.dificultatid;
    this.preguntaTitle = obj.pregunta_cat;
    
    var preguntesArr = [];
    var preguntesTemp = [obj.resposta1, obj.resposta2, obj.resposta3, obj.resposta4];

    preguntesArr = shuffle(preguntesTemp);
    preguntesTemp = '';
    
    this.resposta1 = preguntesArr[0];
    this.resposta2 = preguntesArr[1];
    this.resposta3 = preguntesArr[2];
    this.resposta4 = preguntesArr[3];

}

function updateCamps() {

    $('#preguntaTitle').html(pregunta.preguntaTitle);
    $('#primeraResposta p').html(pregunta.resposta1);
    $('#segonaResposta p').html(pregunta.resposta2);
    $('#terceraResposta p').html(pregunta.resposta3);
    $('#quartaResposta p').html(pregunta.resposta4);

    $("#preguntaContingut").css({"visibility": "visible"});

}

$('body').on( 'click', '#primeraResposta, #segonaResposta, #terceraResposta, #quartaResposta', function() {
    
    var p = $("#" + this.id + " p").html();
    checkResposta(p);

});

function checkResposta(resposta) {

    $.post(urlGetResposta, { 'preguntaId': preguntes.ids[0][id], 'resposta': resposta }) 
        .done(function(response) {
            respostaFinale = eval('[' + response + ']');
    });

    setTimeout(function(){ checkIfCorrecte() }, 500);

}

function getTemaPos() {
    var pos = '';
    temes.forEach(function(tema, idx) {
        if (tema == currentTema) {
            pos = idx;
        }
    });
    return pos;
}

function checkIfCorrecte() {

    //console.log(respostaFinale);

    if (respostaFinale == '') {
        checkRespostaBool = false;
        checkIfCorrecte();
    } else {
        checkRespostaBool = true;
    }

    console.log(respostaFinale);

    var posicioTema = getTemaPos();
    console.log("Current tema: " + currentTema + " Posició: " + posicioTema);

    actualitzarValors(respostaFinale[0], posicioTema);

    if (respostaFinale[0] == true) {
        console.log('Correcte');
        respostaCorrecte();
    } else {
        console.log('Incorrecte');
        respostaIncorrecte();
    }

}

function actualitzarValors(boolResposta, posicioTema) {

    /*temesPuntuacio = [];
    temesEncerts = [];
    temesErrors = [];*/

    switch(boolResposta) {
        case true:
            temesPuntuacio[posicioTema] = temesPuntuacio[posicioTema] + 15;
            temesEncerts[posicioTema]++;
            break;
        case false:
            temesPuntuacio[posicioTema] = temesPuntuacio[posicioTema] - 7;
            temesErrors[posicioTema]++;
            break;
    }

    console.log(temesPuntuacio);
    console.log(temesEncerts);
    console.log(temesErrors);

}

function respostaCorrecte() {

    marcarCaselles();
    // SOMETHING
    setTimeout(function(){ cleanPreg() }, 2000);

}

function respostaIncorrecte() {

    marcarCaselles();
    // SOMETHING
    setTimeout(function(){ cleanPreg() }, 2000);

}

function cleanPreg() {

    pregunta = '';
    checkpreguntaBool = false;
    respostaFinale = '';
    checkRespostaBool = false;

    $('.respostaCasella .respostaInt').css({
        "border": "2px solid transparent",
    })

    $("#preguntaContingut").css({"visibility": "hidden"});

    if (id != preguntes.ids[0].length - 1) {
        id++;
        QuestionLoop(id);
    } else {
        alert("Fi de l'entrenament!");
    }

}

function marcarCaselles() {

    var caselles = ['#primeraResposta', '#segonaResposta', '#terceraResposta', '#quartaResposta'];

    caselles.forEach(function(casella) {

        if ($(casella + " p").html() == respostaFinale[1]) {

            $(casella + " .respostaInt").css({
                "border": "2px solid green",
            });
        } else {
            $(casella + " .respostaInt").css({
                "border": "2px solid red",
            });
        }
    });

}