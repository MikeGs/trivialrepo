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

//tirada 4 casella 1
box1.afegirCasella(4,box5);
box1.afegirCasella(4,box43);
box1.afegirCasella(4,box53);
box1.afegirCasella(4,box48);
box1.afegirCasella(4,box58);

//tirada 5 casella 1
box1.afegirCasella(5,box6);
box1.afegirCasella(5,box44);
box1.afegirCasella(5,box54);
box1.afegirCasella(5,box49);
box1.afegirCasella(5,box59);

//tirada 6 casella 1
box1.afegirCasella(6,box7);
box1.afegirCasella(6,box40);
box1.afegirCasella(6,box45);
box1.afegirCasella(6,box55);
box1.afegirCasella(6,box50);
box1.afegirCasella(6,box60);

//tirada 1 casella 2
box2.afegirCasella(1,box1);
box2.afegirCasella(1,box3);

//tirada 2 casella 2
box2.afegirCasella(2,box_start);
box2.afegirCasella(2,box4);

//tirada 3 casella 2
box2.afegirCasella(3,box41);
box2.afegirCasella(3,box51);
box2.afegirCasella(3,box46);
box2.afegirCasella(3,box56);
box2.afegirCasella(3,box5);

//tirada 4 casella 2
box2.afegirCasella(4,box42);
box2.afegirCasella(4,box47);
box2.afegirCasella(4,box57);
box2.afegirCasella(4,box52);
box2.afegirCasella(4,box6);

//tirada 5 casella 2
box2.afegirCasella(5,box43);
box2.afegirCasella(5,box48);
box2.afegirCasella(5,box58);
box2.afegirCasella(5,box53);
box2.afegirCasella(5,box40);
box2.afegirCasella(5,box7);

//tirada 6 casella 2
box2.afegirCasella(6,box44);
box2.afegirCasella(6,box49);
box2.afegirCasella(6,box59);
box2.afegirCasella(6,box54);
box2.afegirCasella(6,box39);
box2.afegirCasella(6,box8);

//tirada 1 casella 3
box3.afegirCasella(1,box2);
box3.afegirCasella(1,box4);

//tirada 2 casella 3
box3.afegirCasella(2,box1);
box3.afegirCasella(2,box5);

//tirada 3 casella 3
box3.afegirCasella(3,box_start);
box3.afegirCasella(3,box6);

//tirada 4 casella 3
box3.afegirCasella(4,box41);
box3.afegirCasella(4,box51);
box3.afegirCasella(4,box46);
box3.afegirCasella(4,box56);
box3.afegirCasella(4,box40);
box3.afegirCasella(4,box7);

//tirada 5 casella 3
box3.afegirCasella(5,box42);
box3.afegirCasella(5,box47);
box3.afegirCasella(5,box57);
box3.afegirCasella(5,box52);
box3.afegirCasella(5,box39);
box3.afegirCasella(5,box8);

//tirada 6 casella 3
box3.afegirCasella(6,box43);
box3.afegirCasella(6,box48);
box3.afegirCasella(6,box58);
box3.afegirCasella(6,box53);
box3.afegirCasella(6,box38);
box3.afegirCasella(6,box9);

//tirada 1 casella 4
box4.afegirCasella(1,box3);
box4.afegirCasella(1,box5);

//tirada 2 casella 4
box4.afegirCasella(2,box2);
box4.afegirCasella(2,box6);

//tirada 3 casella 4
box4.afegirCasella(3,box1);
box4.afegirCasella(3,box40);
box4.afegirCasella(3,box7);

//tirada 4 casella 4
box4.afegirCasella(4,box_start);
box4.afegirCasella(4,box39);
box4.afegirCasella(4,box8);

//tirada 5 casella 4
box4.afegirCasella(5,box41);
box4.afegirCasella(5,box46);
box4.afegirCasella(5,box56);
box4.afegirCasella(5,box51);
box4.afegirCasella(5,box38);
box4.afegirCasella(5,box9);

//tirada 6 casella 4
box4.afegirCasella(6,box42);
box4.afegirCasella(6,box47);
box4.afegirCasella(6,box57);
box4.afegirCasella(6,box52);
box4.afegirCasella(6,box37);
box4.afegirCasella(6,box10);

//tirada 1 casella 5
box5.afegirCasella(1,box4);
box5.afegirCasella(1,box6);

//tirada 2 casella 5
box5.afegirCasella(2,box3);
box5.afegirCasella(2,box40);
box5.afegirCasella(2,box7);

//tirada 3 casella 5
box5.afegirCasella(3,box2);
box5.afegirCasella(3,box39);
box5.afegirCasella(3,box8);

//tirada 4 casella 5
box5.afegirCasella(4,box1);
box5.afegirCasella(4,box38);
box5.afegirCasella(4,box9);

//tirada 5 casella 5
box5.afegirCasella(5,box_start);
box5.afegirCasella(5,box37);
box5.afegirCasella(5,box10);

//tirada 6 casella 5
box5.afegirCasella(6,box41);
box5.afegirCasella(6,box46);
box5.afegirCasella(6,box56);
box5.afegirCasella(6,box51);
box5.afegirCasella(6,box36);
box5.afegirCasella(6,box11);

//tirada 1 casella 6
box6.afegirCasella(1,box40);
box6.afegirCasella(1,box7);

//tirada 2 casella 6
box6.afegirCasella(2,box39);
box6.afegirCasella(2,box8);

//tirada 3 casella 6
box6.afegirCasella(3,box38);
box6.afegirCasella(3,box9);

//tirada 4 casella 6
box6.afegirCasella(4,box37);
box6.afegirCasella(4,box10);

//tirada 5 casella 6
box6.afegirCasella(5,box36);
box6.afegirCasella(5,box11);

//tirada 6 casella 6
box6.afegirCasella(6,box35);
box6.afegirCasella(6,box12);

//tirada 1 casella 7
box7.afegirCasella(1,box6);
box7.afegirCasella(1,box8);

//tirada 2 casella 7
box7.afegirCasella(2,box40);
box7.afegirCasella(2,box5);
box7.afegirCasella(2,box9);

//tirada 3 casella 7
box7.afegirCasella(3,box4);
box7.afegirCasella(3,box39);
box7.afegirCasella(3,box10);

//tirada 4 casella 7
box7.afegirCasella(4,box38);
box7.afegirCasella(4,box3);
box7.afegirCasella(4,box11);

//tirada 5 casella 7
box7.afegirCasella(5,box37);
box7.afegirCasella(5,box12);
box7.afegirCasella(5,box2);

//tirada 6 casella 7
box7.afegirCasella(6,box36);
box7.afegirCasella(6,box1);
box7.afegirCasella(6,box13);

//tirada 1 casella 8
box8.afegirCasella(1,box7);
box8.afegirCasella(1,box9);

//tirada 2 casella 8
box8.afegirCasella(2,box6);
box8.afegirCasella(2,box10);

//tirada 3 casella 8
box8.afegirCasella(3,box40);
box8.afegirCasella(3,box5);
box8.afegirCasella(3,box11);

//tirada 4 casella 8
box8.afegirCasella(4,box39);
box8.afegirCasella(4,box4);
box8.afegirCasella(4,box12);

//tirada 5 casella 8
box8.afegirCasella(5,box3);
box8.afegirCasella(5,box38);
box8.afegirCasella(5,box13);

//tirada 6 casella 8
box8.afegirCasella(6,box2);
box8.afegirCasella(6,box37);
box8.afegirCasella(6,box55);
box8.afegirCasella(6,box14);

//tirada 1 casella 9
box9.afegirCasella(1,box8);
box9.afegirCasella(1,box10);

//tirada 2 casella 9
box9.afegirCasella(2,box7);
box9.afegirCasella(2,box11);

//tirada 3 casella 9
box9.afegirCasella(3,box6);
box9.afegirCasella(3,box12);

//tirada 4 casella 9
box9.afegirCasella(4,box5);
box9.afegirCasella(4,box40);
box9.afegirCasella(4,box13);

//tirada 5 casella 9
box9.afegirCasella(5,box4);
box9.afegirCasella(5,box39);
box9.afegirCasella(5,box55);
box9.afegirCasella(5,box14);

//tirada 6 casella 9
box9.afegirCasella(6,box38);
box9.afegirCasella(6,box3);
box9.afegirCasella(6,box54);
box9.afegirCasella(6,box15);

//tirada 1 casella 10
box10.afegirCasella(1,box9);
box10.afegirCasella(1,box11);

//tirada 2 casella 10
box10.afegirCasella(2,box8);
box10.afegirCasella(2,box12);

//tirada 3 casella 10
box10.afegirCasella(3,box7);
box10.afegirCasella(3,box13);

//tirada 4 casella 10
box10.afegirCasella(4,box6);
box10.afegirCasella(4,box55);
box10.afegirCasella(4,box14);

//tirada 5 casella 10
box10.afegirCasella(5,box5);
box10.afegirCasella(5,box40);
box10.afegirCasella(5,box54);
box10.afegirCasella(5,box15);

//tirada 6 casella 10
box10.afegirCasella(6,box4);
box10.afegirCasella(6,box39);
box10.afegirCasella(6,box53);
box10.afegirCasella(6,box16);

//tirada 1 casella 11
box11.afegirCasella(1,box10);
box11.afegirCasella(1,box12);

//tirada 2 casella 11
box11.afegirCasella(2,box9);
box11.afegirCasella(2,box13);

//tirada 3 casella 11
box11.afegirCasella(3,box8);
box11.afegirCasella(3,box55);
box11.afegirCasella(3,box14);

//tirada 4 casella 11
box11.afegirCasella(4,box7);
box11.afegirCasella(4,box54);
box11.afegirCasella(4,box15);

//tirada 5 casella 11
box11.afegirCasella(5,box6);
box11.afegirCasella(5,box53);
box11.afegirCasella(5,box16);

//tirada 6 casella 11
box11.afegirCasella(6,box40);
box11.afegirCasella(6,box52);
box11.afegirCasella(6,box5);
box11.afegirCasella(6,box17);

//tirada 1 casella 12
box12.afegirCasella(1,box11);
box12.afegirCasella(1,box13);

//tirada 2 casella 12
box12.afegirCasella(2,box10);
box12.afegirCasella(2,box55);
box12.afegirCasella(2,box14);

//tirada 3 casella 12
box12.afegirCasella(3,box54);
box12.afegirCasella(3,box9);
box12.afegirCasella(3,box15);

//tirada 4 casella 12
box12.afegirCasella(4,box53);
box12.afegirCasella(4,box8);
box12.afegirCasella(4,box16);

//tirada 5 casella 12
box12.afegirCasella(5,box52);
box12.afegirCasella(5,box17);
box12.afegirCasella(5,box7);

//tirada 6 casella 12
box12.afegirCasella(6,box51);
box12.afegirCasella(6,box18);
box12.afegirCasella(6,box6);

//tirada 1 casella 13
box13.afegirCasella(1,box55);
box13.afegirCasella(1,box12);
box13.afegirCasella(1,box14);

//tirada 2 casella 13
box13.afegirCasella(2,box54);
box13.afegirCasella(2,box11);
box13.afegirCasella(2,box15);

//tirada 3 casella 13
box13.afegirCasella(3,box53);
box13.afegirCasella(3,box16);
box13.afegirCasella(3,box10);

//tirada 4 casella 13
box13.afegirCasella(4,box52);
box13.afegirCasella(4,box17);
box13.afegirCasella(4,box9);

//tirada 5 casella 13
box13.afegirCasella(5,box51);
box13.afegirCasella(5,box18);
box13.afegirCasella(5,box8);

//tirada 6 casella 13
box13.afegirCasella(6,box_start);
box13.afegirCasella(6,box19);
box13.afegirCasella(6,box7);

//tirada 1 casella 14
box14.afegirCasella(1,box13);
box14.afegirCasella(1,box15);

//tirada 2 casella 14
box14.afegirCasella(2,box16);
box14.afegirCasella(2,box12);
box14.afegirCasella(2,box55);

//tirada 3 casella 14
box14.afegirCasella(3,box17);
box14.afegirCasella(3,box11);
box14.afegirCasella(3,box54);

//tirada 4 casella 14
box14.afegirCasella(4,box53);
box14.afegirCasella(4,box10);
box14.afegirCasella(4,box18);

//tirada 5 casella 14
box14.afegirCasella(5,box19);
box14.afegirCasella(5,box52);
box14.afegirCasella(5,box9);

//tirada 6 casella 14
box14.afegirCasella(6,box51);
box14.afegirCasella(6,box20);
box14.afegirCasella(6,box8);
