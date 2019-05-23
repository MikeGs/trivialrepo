pregunta = '';
checkpreguntaBool = false;
respostaFinale = '';
checkRespostaBool = false;

checkPartidaPujadaBool = false;
respostaPartidaPujada = '';

//puntuacio = 0;
nivellid = readCookie("nivell");

function QuestionLoop(id) {

    if (id != preguntes.ids[0].length - 1) {

        $.post(urlGetPregunta, { 'preguntaId': preguntes.ids[0][id] }) 
            .done(function(response) {
                pregunta = response;
        });

        setTimeout(function(){ checkPregunta() }, 500);

    } else {
        
        alert("Fi de l'entrenament!");

        pujarPartida();

    }

}

function pujarPartida() {

    partida = new Partida();

    $.post(urlPujarPartida, { 'partida': partida}) 
            .done(function(response) {
                respostaPartidaPujada = response
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

function checkIfCorrecte() {

    //console.log(respostaFinale);

    if (respostaFinale == '') {
        checkRespostaBool = false;
        checkIfCorrecte();
    } else {
        checkRespostaBool = true;
    }

    console.log(respostaFinale);

    if (respostaFinale[0] == true) {
        console.log('Correcte');
        respostaCorrecte();
    } else {
        console.log('Incorrecte');
        respostaIncorrecte();
    }

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