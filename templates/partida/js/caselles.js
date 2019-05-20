var box_start = new Casella('box-start', 'inici', '');

var box1 = new Casella('box1', 'normal', tema1);
var box2 = new Casella('box2', 'normal', tema2);
var box3 = new Casella('box3', 'doble', '');
var box4 = new Casella('box4', 'normal', tema3);
var box5 = new Casella('box5', 'normal', tema4);
var box6 = new Casella('box6', 'quesito', tema5);

var box7 = new Casella('box7', 'normal', tema2);
var box8 = new Casella('box8', 'normal', tema3);
var box9 = new Casella('box9', 'doble', '');
var box10 = new Casella('box10', 'normal', tema1);
var box11 = new Casella('box11', 'normal', tema5);
var box12 = new Casella('box12', 'normal', tema4);
var box13 = new Casella('box13', 'quesito', tema2);

var box14 = new Casella('box14', 'normal', tema3);
var box15 = new Casella('box15', 'normal', tema4);
var box16 = new Casella('box16', 'doble', '');
var box17 = new Casella('box17', 'normal', tema5);
var box18 = new Casella('box18', 'normal', tema2);
var box19 = new Casella('box19', 'normal', tema1);
var box20 = new Casella('box20', 'quesito', tema3);

var box21 = new Casella('box21', 'normal', tema4);
var box22 = new Casella('box22', 'normal', tema1);
var box23 = new Casella('box23', 'doble', '');
var box24 = new Casella('box24', 'normal', tema2);
var box25 = new Casella('box25', 'normal', tema3);
var box26 = new Casella('box26', 'normal', tema5);
var box27 = new Casella('box27', 'quesito', tema4);

var box28 = new Casella('box28', 'normal', tema1);
var box29 = new Casella('box29', 'normal', tema5);
var box30 = new Casella('box30', 'doble', '');
var box31 = new Casella('box31', 'normal', tema3);
var box32 = new Casella('box32', 'normal', tema4);
var box33 = new Casella('box33', 'normal', tema2);
var box34 = new Casella('box34', 'quesito', tema1);

var box35 = new Casella('box35', 'normal', tema5);
var box36 = new Casella('box36', 'normal', tema2);
var box37 = new Casella('box37', 'doble', '');
var box38 = new Casella('box38', 'normal', tema4);
var box39 = new Casella('box39', 'normal', tema1);
var box40 = new Casella('box40', 'normal', tema3);

var box41 = new Casella('box41', 'normal', tema4);
var box42 = new Casella('box42', 'normal', tema5);
var box43 = new Casella('box43', 'doble', '');
var box44 = new Casella('box44', 'normal', tema2);
var box45 = new Casella('box45', 'normal', tema3);

var box46 = new Casella('box46', 'normal', tema3);
var box47 = new Casella('box47', 'normal', tema1);
var box48 = new Casella('box48', 'doble', '');
var box49 = new Casella('box49', 'normal', tema5);
var box50 = new Casella('box50', 'normal', tema2);

var box51 = new Casella('box51', 'normal', tema5);
var box52 = new Casella('box52', 'normal', tema3);
var box53 = new Casella('box53', 'doble', '');
var box54 = new Casella('box54', 'normal', tema4);
var box55 = new Casella('box55', 'normal', tema2);

var box56 = new Casella('box56', 'normal', tema2);
var box57 = new Casella('box57', 'normal', tema4);
var box58 = new Casella('box58', 'doble', '');
var box59 = new Casella('box59', 'normal', tema1);
var box60 = new Casella('box60', 'normal', tema5);

//tirada 1 casella start
box_start.afegirCasella(1,box1);
box_start.afegirCasella(1,box51);
box_start.afegirCasella(1,box56);
box_start.afegirCasella(1,box46);
box_start.afegirCasella(1,box41);

//tirada 2 casella start
box_start.afegirCasella(2,box2);
box_start.afegirCasella(2,box52);
box_start.afegirCasella(2,box57);
box_start.afegirCasella(2,box47);
box_start.afegirCasella(2,box42);

//tirada 3 casella start
box_start.afegirCasella(3,box3);
box_start.afegirCasella(3,box53);
box_start.afegirCasella(3,box58);
box_start.afegirCasella(3,box48);
box_start.afegirCasella(3,box43);

//tirada 4 casella start
box_start.afegirCasella(4,box4);
box_start.afegirCasella(4,box54);
box_start.afegirCasella(4,box59);
box_start.afegirCasella(4,box49);
box_start.afegirCasella(4,box44);

//tirada 5 casella start
box_start.afegirCasella(5,box5);
box_start.afegirCasella(5,box55);
box_start.afegirCasella(5,box60);
box_start.afegirCasella(5,box50);
box_start.afegirCasella(5,box45);

//tirada 6 casella start
box_start.afegirCasella(6,box6);
box_start.afegirCasella(6,box13);
box_start.afegirCasella(6,box20);
box_start.afegirCasella(6,box27);
box_start.afegirCasella(6,box34);

//tirada 1 casella 1
box1.afegirCasella(1,box_start);
box1.afegirCasella(1,box2);

//tirada 2 casella 1
box1.afegirCasella(2,box3);
box1.afegirCasella(2,box41);
box1.afegirCasella(2,box51);
box1.afegirCasella(2,box46);
box1.afegirCasella(2,box56);

//tirada 3 casella 1
box1.afegirCasella(3,box4);
box1.afegirCasella(3,box42);
box1.afegirCasella(3,box52);
box1.afegirCasella(3,box47);
box1.afegirCasella(3,box57);
