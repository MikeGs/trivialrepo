box_start = new Casella('box_start', 'inici', '');

box1 = new Casella('box1', 'normal', tema1);
box2 = new Casella('box2', 'normal', tema2);
box3 = new Casella('box3', 'doble', '');
box4 = new Casella('box4', 'normal', tema3);
box5 = new Casella('box5', 'normal', tema4);
box6 = new Casella('box6', 'quesito', tema5);

box7 = new Casella('box7', 'normal', tema2);
box8 = new Casella('box8', 'normal', tema3);
box9 = new Casella('box9', 'doble', '');
box10 = new Casella('box10', 'normal', tema1);
box11 = new Casella('box11', 'normal', tema5);
box12 = new Casella('box12', 'normal', tema4);
box13 = new Casella('box13', 'quesito', tema2);

box14 = new Casella('box14', 'normal', tema3);
box15 = new Casella('box15', 'normal', tema4);
box16 = new Casella('box16', 'doble', '');
box17 = new Casella('box17', 'normal', tema5);
box18 = new Casella('box18', 'normal', tema2);
box19 = new Casella('box19', 'normal', tema1);
box20 = new Casella('box20', 'quesito', tema3);

box21 = new Casella('box21', 'normal', tema4);
box22 = new Casella('box22', 'normal', tema1);
box23 = new Casella('box23', 'doble', '');
box24 = new Casella('box24', 'normal', tema2);
box25 = new Casella('box25', 'normal', tema3);
box26 = new Casella('box26', 'normal', tema5);
box27 = new Casella('box27', 'quesito', tema4);

box28 = new Casella('box28', 'normal', tema1);
box29 = new Casella('box29', 'normal', tema5);
box30 = new Casella('box30', 'doble', '');
box31 = new Casella('box31', 'normal', tema3);
box32 = new Casella('box32', 'normal', tema4);
box33 = new Casella('box33', 'normal', tema2);
box34 = new Casella('box34', 'quesito', tema1);

box35 = new Casella('box35', 'normal', tema5);
box36 = new Casella('box36', 'normal', tema2);
box37 = new Casella('box37', 'doble', '');
box38 = new Casella('box38', 'normal', tema4);
box39 = new Casella('box39', 'normal', tema1);
box40 = new Casella('box40', 'normal', tema3);

box41 = new Casella('box41', 'normal', tema4);
box42 = new Casella('box42', 'normal', tema5);
box43 = new Casella('box43', 'doble', '');
box44 = new Casella('box44', 'normal', tema2);
box45 = new Casella('box45', 'normal', tema3);

box46 = new Casella('box46', 'normal', tema3);
box47 = new Casella('box47', 'normal', tema1);
box48 = new Casella('box48', 'doble', '');
box49 = new Casella('box49', 'normal', tema5);
box50 = new Casella('box50', 'normal', tema2);

box51 = new Casella('box51', 'normal', tema5);
box52 = new Casella('box52', 'normal', tema3);
box53 = new Casella('box53', 'doble', '');
box54 = new Casella('box54', 'normal', tema4);
box55 = new Casella('box55', 'normal', tema2);

box56 = new Casella('box56', 'normal', tema2);
box57 = new Casella('box57', 'normal', tema4);
box58 = new Casella('box58', 'doble', '');
box59 = new Casella('box59', 'normal', tema1);
box60 = new Casella('box60', 'normal', tema5);

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

//tirada 1 casella 15
box15.afegirCasella(1,box16);
box15.afegirCasella(1,box14);

//tirada 2 casella 15
box15.afegirCasella(2,box17);
box15.afegirCasella(2,box13);

//tirada 3 casella 15
box15.afegirCasella(3,box55);
box15.afegirCasella(3,box12);
box15.afegirCasella(3,box18);

//tirada 4 casella 15
box15.afegirCasella(4,box54);
box15.afegirCasella(4,box19);
box15.afegirCasella(4,box11);

//tirada 5 casella 15
box15.afegirCasella(5,box53);
box15.afegirCasella(5,box20);
box15.afegirCasella(5,box10);

//tirada 6 casella 15
box15.afegirCasella(5,box52);
box15.afegirCasella(5,box60);
box15.afegirCasella(5,box21);
box15.afegirCasella(5,box9);

//tirada 1 casella 16
box16.afegirCasella(1,box17);
box16.afegirCasella(1,box15);

//tirada 2 casella 16
box16.afegirCasella(2,box18);
box16.afegirCasella(2,box14);

//tirada 3 casella 16
box16.afegirCasella(3,box19);
box16.afegirCasella(3,box13);

//tirada 4 casella 16
box16.afegirCasella(4,box20);
box16.afegirCasella(4,box12);
box16.afegirCasella(4,box55);

//tirada 5 casella 16
box16.afegirCasella(5,box60);
box16.afegirCasella(5,box21);
box16.afegirCasella(5,box54);
box16.afegirCasella(5,box11);

//tirada 6 casella 16
box16.afegirCasella(6,box22);
box16.afegirCasella(6,box59);
box16.afegirCasella(6,box53);
box16.afegirCasella(6,box10);

//tirada 1 casella 17
box17.afegirCasella(1,box18);
box17.afegirCasella(1,box16);

//tirada 2 casella 17
box17.afegirCasella(2,box19);
box17.afegirCasella(2,box15);

//tirada 3 casella 17
box17.afegirCasella(3,box20);
box17.afegirCasella(3,box14);

//tirada 4 casella 17
box17.afegirCasella(4,box60);
box17.afegirCasella(4,box21);
box17.afegirCasella(4,box13);

//tirada 5 casella 17
box17.afegirCasella(5,box22);
box17.afegirCasella(5,box59);
box17.afegirCasella(5,box55);
box17.afegirCasella(5,box12);

//tirada 6 casella 17
box17.afegirCasella(6,box23);
box17.afegirCasella(6,box58);
box17.afegirCasella(6,box54);
box17.afegirCasella(6,box11);

//tirada 1 casella 18
box18.afegirCasella(1,box19);
box18.afegirCasella(1,box17);

//tirada 2 casella 18
box18.afegirCasella(2,box20);
box18.afegirCasella(2,box16);

//tirada 3 casella 18
box18.afegirCasella(3,box21);
box18.afegirCasella(3,box60);
box18.afegirCasella(3,box15);

//tirada 4 casella 18
box18.afegirCasella(4,box22);
box18.afegirCasella(4,box59);
box18.afegirCasella(4,box14);

//tirada 5 casella 18
box18.afegirCasella(5,box23);
box18.afegirCasella(5,box58);
box18.afegirCasella(5,box13);

//tirada 6 casella 18
box18.afegirCasella(6,box24);
box18.afegirCasella(6,box57);
box18.afegirCasella(6,box55);
box18.afegirCasella(6,box12);

//tirada 1 casella 19
box19.afegirCasella(1,box20);
box19.afegirCasella(1,box18);

//tirada 2 casella 19
box19.afegirCasella(2,box21);
box19.afegirCasella(2,box60);
box19.afegirCasella(2,box17);

//tirada 3 casella 19
box19.afegirCasella(3,box22);
box19.afegirCasella(3,box59);
box19.afegirCasella(3,box16);

//tirada 4 casella 19
box19.afegirCasella(4,box58);
box19.afegirCasella(4,box23);
box19.afegirCasella(4,box15);

//tirada 5 casella 19
box19.afegirCasella(5,box57);
box19.afegirCasella(5,box24);
box19.afegirCasella(5,box14);

//tirada 6 casella 19
box19.afegirCasella(6,box56);
box19.afegirCasella(6,box25);
box19.afegirCasella(6,box13);

//tirada 1 casella 20
box20.afegirCasella(1,box21);
box20.afegirCasella(1,box19);
box20.afegirCasella(1,box60);

//tirada 2 casella 20
box20.afegirCasella(2,box22);
box20.afegirCasella(2,box18);
box20.afegirCasella(2,box59);

//tirada 3 casella 20
box20.afegirCasella(3,box23);
box20.afegirCasella(3,box17);
box20.afegirCasella(3,box58);

//tirada 4 casella 20
box20.afegirCasella(4,box24);
box20.afegirCasella(4,box16);
box20.afegirCasella(4,box57);

//tirada 5 casella 20
box20.afegirCasella(5,box25);
box20.afegirCasella(5,box15);
box20.afegirCasella(5,box56);

//tirada 6 casella 20
box20.afegirCasella(6,box26);
box20.afegirCasella(6,box14);
box20.afegirCasella(6,box_start);

//tirada 1 casella 21
box21.afegirCasella(1,box22);
box21.afegirCasella(1,box20);

//tirada 2 casella 21
box21.afegirCasella(2,box23);
box21.afegirCasella(2,box60);
box21.afegirCasella(2,box19);

//tirada 3 casella 21
box21.afegirCasella(3,box24);
box21.afegirCasella(3,box59);
box21.afegirCasella(3,box18);

//tirada 4 casella 21
box21.afegirCasella(4,box25);
box21.afegirCasella(4,box58);
box21.afegirCasella(4,box17);

//tirada 5 casella 21
box21.afegirCasella(5,box26);
box21.afegirCasella(5,box57);
box21.afegirCasella(5,box16);

//tirada 6 casella 21
box21.afegirCasella(6,box27);
box21.afegirCasella(6,box56);
box21.afegirCasella(6,box15);

//tirada 1 casella 22
box22.afegirCasella(1,box23);
box22.afegirCasella(1,box21);

//tirada 2 casella 22
box22.afegirCasella(2,box24);
box22.afegirCasella(2,box20);

//tirada 3 casella 22
box22.afegirCasella(3,box25);
box22.afegirCasella(3,box60);
box22.afegirCasella(3,box19);

//tirada 4 casella 22
box22.afegirCasella(4,box26);
box22.afegirCasella(4,box59);
box22.afegirCasella(4,box18);

//tirada 5 casella 22
box22.afegirCasella(5,box27);
box22.afegirCasella(5,box58);
box22.afegirCasella(5,box17);

//tirada 6 casella 22
box22.afegirCasella(6,box28);
box22.afegirCasella(6,box50);
box22.afegirCasella(6,box57);
box22.afegirCasella(6,box16);

//tirada 1 casella 23
box23.afegirCasella(1,box24);
box23.afegirCasella(1,box22);

//tirada 2 casella 23
box23.afegirCasella(2,box25);
box23.afegirCasella(2,box21);

//tirada 3 casella 23
box23.afegirCasella(3,box26);
box23.afegirCasella(3,box20);

//tirada 4 casella 23
box23.afegirCasella(4,box27);
box23.afegirCasella(4,box60);
box23.afegirCasella(4,box19);

//tirada 5 casella 23
box23.afegirCasella(5,box28);
box23.afegirCasella(5,box50);
box23.afegirCasella(5,box59);
box23.afegirCasella(5,box18);

//tirada 6 casella 23
box23.afegirCasella(6,box29);
box23.afegirCasella(6,box49);
box23.afegirCasella(6,box58);
box23.afegirCasella(6,box17);

//tirada 1 casella 24
box24.afegirCasella(1,box25);
box24.afegirCasella(1,box23);

//tirada 2 casella 24
box24.afegirCasella(2,box26);
box24.afegirCasella(2,box22);

//tirada 3 casella 24
box24.afegirCasella(3,box27);
box24.afegirCasella(3,box21);

//tirada 4 casella 24
box24.afegirCasella(4,box28);
box24.afegirCasella(4,box50);
box24.afegirCasella(4,box20);

//tirada 5 casella 24
box24.afegirCasella(5,box29);
box24.afegirCasella(5,box49);
box24.afegirCasella(5,box60);
box24.afegirCasella(5,box19);

//tirada 6 casella 24
box24.afegirCasella(6,box30);
box24.afegirCasella(6,box48);
box24.afegirCasella(6,box59);
box24.afegirCasella(6,box18);

//tirada 1 casella 25
box25.afegirCasella(1,box26);
box25.afegirCasella(1,box24);

//tirada 2 casella 25
box25.afegirCasella(2,box27);
box25.afegirCasella(2,box23);

//tirada 3 casella 25
box25.afegirCasella(3,box28);
box25.afegirCasella(3,box50);
box25.afegirCasella(3,box22);

//tirada 4 casella 25
box25.afegirCasella(4,box29);
box25.afegirCasella(4,box49);
box25.afegirCasella(4,box21);

//tirada 5 casella 25
box25.afegirCasella(5,box30);
box25.afegirCasella(5,box48);
box25.afegirCasella(5,box20);

//tirada 6 casella 25
box25.afegirCasella(6,box31);
box25.afegirCasella(6,box47);
box25.afegirCasella(6,box60);
box25.afegirCasella(6,box19);

//tirada 1 casella 26
box26.afegirCasella(1,box27);
box26.afegirCasella(1,box25);

//tirada 2 casella 26
box26.afegirCasella(2,box28);
box26.afegirCasella(2,box24);
box26.afegirCasella(2,box50);

//tirada 3 casella 26
box26.afegirCasella(3,box29);
box26.afegirCasella(3,box23);
box26.afegirCasella(3,box49);

//tirada 4 casella 26
box26.afegirCasella(4,box30);
box26.afegirCasella(4,box22);
box26.afegirCasella(4,box48);

//tirada 5 casella 26
box26.afegirCasella(5,box31);
box26.afegirCasella(5,box21);
box26.afegirCasella(5,box47);

//tirada 6 casella 26
box26.afegirCasella(6,box32);
box26.afegirCasella(6,box20);
box26.afegirCasella(6,box46);

//tirada 1 casella 27
box27.afegirCasella(1,box28);
box27.afegirCasella(1,box26);
box27.afegirCasella(1,box50);

//tirada 2 casella 27
box27.afegirCasella(2,box29);
box27.afegirCasella(2,box25);
box27.afegirCasella(2,box49);

//tirada 3 casella 27
box27.afegirCasella(3,box30);
box27.afegirCasella(3,box24);
box27.afegirCasella(3,box48);

//tirada 4 casella 27
box27.afegirCasella(4,box31);
box27.afegirCasella(4,box23);
box27.afegirCasella(4,box47);

//tirada 5 casella 27
box27.afegirCasella(5,box32);
box27.afegirCasella(5,box22);
box27.afegirCasella(5,box46);

//tirada 6 casella 27
box27.afegirCasella(6,box33);
box27.afegirCasella(6,box21);
box27.afegirCasella(6,box_start);

//tirada 1 casella 28
box28.afegirCasella(1,box29);
box28.afegirCasella(1,box27);

//tirada 2 casella 28
box28.afegirCasella(2,box30);
box28.afegirCasella(2,box26);
box28.afegirCasella(2,box50);

//tirada 3 casella 28
box28.afegirCasella(3,box31);
box28.afegirCasella(3,box25);
box28.afegirCasella(3,box49);

//tirada 4 casella 28
box28.afegirCasella(4,box32);
box28.afegirCasella(4,box24);
box28.afegirCasella(4,box48);

//tirada 5 casella 28
box28.afegirCasella(5,box33);
box28.afegirCasella(5,box23);
box28.afegirCasella(5,box47);

//tirada 6 casella 28
box28.afegirCasella(6,box34);
box28.afegirCasella(6,box22);
box28.afegirCasella(6,box46);

//tirada 1 casella 29
box29.afegirCasella(1,box30);
box29.afegirCasella(1,box28);

//tirada 2 casella 29
box29.afegirCasella(2,box31);
box29.afegirCasella(2,box27);

//tirada 3 casella 29
box29.afegirCasella(3,box32);
box29.afegirCasella(3,box26);
box29.afegirCasella(3,box50);

//tirada 4 casella 29
box29.afegirCasella(4,box33);
box29.afegirCasella(4,box25);
box29.afegirCasella(4,box49);

//tirada 5 casella 29
box29.afegirCasella(5,box34);
box29.afegirCasella(5,box24);
box29.afegirCasella(5,box48);

//tirada 6 casella 29
box29.afegirCasella(6,box35);
box29.afegirCasella(6,box45);
box29.afegirCasella(6,box23);
box29.afegirCasella(6,box47);

//tirada 1 casella 30
box30.afegirCasella(1,box31);
box30.afegirCasella(1,box29);

//tirada 2 casella 30
box30.afegirCasella(2,box32);
box30.afegirCasella(2,box28);

//tirada 3 casella 30
box30.afegirCasella(3,box33);
box30.afegirCasella(3,box27);

//tirada 4 casella 30
box30.afegirCasella(4,box34);
box30.afegirCasella(4,box26);
box30.afegirCasella(4,box50);

//tirada 5 casella 30
box30.afegirCasella(5,box35);
box30.afegirCasella(5,box45);
box30.afegirCasella(5,box25);
box30.afegirCasella(5,box49);

//tirada 6 casella 30
box30.afegirCasella(6,box36);
box30.afegirCasella(6,box44);
box30.afegirCasella(6,box24);
box30.afegirCasella(6,box48);

//tirada 1 casella 31
box31.afegirCasella(1,box30);
box31.afegirCasella(1,box32);

//tirada 2 casella 31
box31.afegirCasella(2,box29);
box31.afegirCasella(2,box33);

//tirada 3 casella 31
box31.afegirCasella(3,box28);
box31.afegirCasella(3,box34);

//tirada 4 casella 31
box31.afegirCasella(4,box27);
box31.afegirCasella(4,box45);
box31.afegirCasella(4,box35);

//tirada 5 casella 31
box31.afegirCasella(5,box26);
box31.afegirCasella(5,box44);
box31.afegirCasella(5,box36);
box31.afegirCasella(5,box50);

//tirada 6 casella 31
box31.afegirCasella(6,box25);
box31.afegirCasella(6,box43);
box31.afegirCasella(6,box37);
box31.afegirCasella(6,box49);

//tirada 1 casella 32
box32.afegirCasella(1,box31);
box32.afegirCasella(1,box33);

//tirada 2 casella 32
box32.afegirCasella(2,box30);
box32.afegirCasella(2,box34);

//tirada 3 casella 32
box32.afegirCasella(3,box29);
box32.afegirCasella(3,box35);
box32.afegirCasella(3,box45);

//tirada 4 casella 32
box32.afegirCasella(4,box28);
box32.afegirCasella(4,box36);
box32.afegirCasella(4,box44);

//tirada 5 casella 32
box32.afegirCasella(5,box27);
box32.afegirCasella(5,box37);
box32.afegirCasella(5,box43);

//tirada 6 casella 32
box32.afegirCasella(6,box26);
box32.afegirCasella(6,box38);
box32.afegirCasella(6,box42);
box32.afegirCasella(6,box50);

//tirada 1 casella 33
box33.afegirCasella(1,box32);
box33.afegirCasella(1,box34);

//tirada 2 casella 33
box33.afegirCasella(2,box31);
box33.afegirCasella(2,box35);
box33.afegirCasella(2,box45);

//tirada 3 casella 33
box33.afegirCasella(3,box30);
box33.afegirCasella(3,box36);
box33.afegirCasella(3,box44);

//tirada 4 casella 33
box33.afegirCasella(4,box29);
box33.afegirCasella(4,box37);
box33.afegirCasella(4,box43);

//tirada 5 casella 33
box33.afegirCasella(5,box28);
box33.afegirCasella(5,box38);
box33.afegirCasella(5,box42);

//tirada 6 casella 33
box33.afegirCasella(6,box27);
box33.afegirCasella(6,box39);
box33.afegirCasella(6,box41);

//tirada 1 casella 34
box34.afegirCasella(1,box33);
box34.afegirCasella(1,box35);
box34.afegirCasella(1,box45);

//tirada 2 casella 34
box34.afegirCasella(2,box32);
box34.afegirCasella(2,box36);
box34.afegirCasella(2,box44);

//tirada 3 casella 34
box34.afegirCasella(3,box31);
box34.afegirCasella(3,box37);
box34.afegirCasella(3,box43);

//tirada 4 casella 34
box34.afegirCasella(4,box30);
box34.afegirCasella(4,box38);
box34.afegirCasella(4,box42);

//tirada 5 casella 34
box34.afegirCasella(5,box29);
box34.afegirCasella(5,box39);
box34.afegirCasella(5,box41);

//tirada 6 casella 34
box34.afegirCasella(6,box28);
box34.afegirCasella(6,box40);
box34.afegirCasella(6,box_start);

//tirada 1 casella 35
box35.afegirCasella(1,box34);
box35.afegirCasella(1,box36);

//tirada 2 casella 35
box35.afegirCasella(2,box33);
box35.afegirCasella(2,box37);
box35.afegirCasella(2,box45);

//tirada 3 casella 35
box35.afegirCasella(3,box32);
box35.afegirCasella(3,box38);
box35.afegirCasella(3,box44);

//tirada 4 casella 35
box35.afegirCasella(4,box30);
box35.afegirCasella(4,box39);
box35.afegirCasella(4,box43);

//tirada 5 casella 35
box35.afegirCasella(5,box29);
box35.afegirCasella(5,box40);
box35.afegirCasella(5,box42);

//tirada 6 casella 35
box35.afegirCasella(6,box28);
box35.afegirCasella(6,box6);
box35.afegirCasella(6,box41);

//tirada 1 casella 36
box36.afegirCasella(1,box35);
box36.afegirCasella(1,box37);

//tirada 2 casella 36
box36.afegirCasella(2,box34);
box36.afegirCasella(2,box38);

//tirada 3 casella 36
box36.afegirCasella(3,box33);
box36.afegirCasella(3,box39);
box36.afegirCasella(3,box45);

//tirada 4 casella 36
box36.afegirCasella(4,box32);
box36.afegirCasella(4,box40);
box36.afegirCasella(4,box44);

//tirada 5 casella 36
box36.afegirCasella(5,box31);
box36.afegirCasella(5,box6);
box36.afegirCasella(5,box43);

//tirada 6 casella 36
box36.afegirCasella(6,box30);
box36.afegirCasella(6,box7);
box36.afegirCasella(6,box5);
box36.afegirCasella(6,box42);

//tirada 1 casella 37
box37.afegirCasella(1,box36);
box37.afegirCasella(1,box38);

//tirada 2 casella 37
box37.afegirCasella(2,box35);
box37.afegirCasella(2,box39);

//tirada 3 casella 37
box37.afegirCasella(3,box34);
box37.afegirCasella(3,box40);

//tirada 4 casella 37
box37.afegirCasella(4,box33);
box37.afegirCasella(4,box45);
box37.afegirCasella(4,box6);

//tirada 5 casella 37
box37.afegirCasella(5,box32);
box37.afegirCasella(5,box44);
box37.afegirCasella(5,box7);
box37.afegirCasella(5,box5);

//tirada 6 casella 37
box37.afegirCasella(6,box31);
box37.afegirCasella(6,box43);
box37.afegirCasella(6,box8);
box37.afegirCasella(6,box4);

//tirada 1 casella 38
box38.afegirCasella(1,box37);
box38.afegirCasella(1,box39);

//tirada 2 casella 38
box38.afegirCasella(2,box36);
box38.afegirCasella(2,box40);

//tirada 3 casella 38
box38.afegirCasella(3,box35);
box38.afegirCasella(3,box6);

//tirada 4 casella 38
box38.afegirCasella(4,box34);
box38.afegirCasella(4,box7);
box38.afegirCasella(4,box5);

//tirada 5 casella 38
box38.afegirCasella(5,box33);
box38.afegirCasella(5,box45);
box38.afegirCasella(5,box8);
box38.afegirCasella(5,box4);

//tirada 6 casella 38
box38.afegirCasella(6,box32);
box38.afegirCasella(6,box44);
box38.afegirCasella(6,box9);
box38.afegirCasella(6,box3);

//tirada 1 casella 39
box39.afegirCasella(1,box38);
box39.afegirCasella(1,box40);

//tirada 2 casella 39
box39.afegirCasella(2,box37);
box39.afegirCasella(2,box6);

//tirada 3 casella 39
box39.afegirCasella(3,box36);
box39.afegirCasella(3,box5);
box39.afegirCasella(3,box7);

//tirada 4 casella 39
box39.afegirCasella(4,box35);
box39.afegirCasella(4,box4);
box39.afegirCasella(4,box8);

//tirada 5 casella 39
box39.afegirCasella(5,box34);
box39.afegirCasella(5,box3);
box39.afegirCasella(5,box9);

//tirada 6 casella 39
box39.afegirCasella(6,box33);
box39.afegirCasella(6,box45);
box39.afegirCasella(6,box2);
box39.afegirCasella(6,box10);

//tirada 1 casella 40
box40.afegirCasella(1,box39);
box40.afegirCasella(1,box6);

//tirada 2 casella 40
box40.afegirCasella(2,box38);
box40.afegirCasella(2,box7);
box40.afegirCasella(2,box5);

//tirada 3 casella 40
box40.afegirCasella(3,box37);
box40.afegirCasella(3,box8);
box40.afegirCasella(3,box4);

//tirada 4 casella 40
box40.afegirCasella(4,box36);
box40.afegirCasella(4,box9);
box40.afegirCasella(4,box3);

//tirada 5 casella 40
box40.afegirCasella(5,box35);
box40.afegirCasella(5,box10);
box40.afegirCasella(5,box2);

//tirada 6 casella 40
box40.afegirCasella(6,box34);
box40.afegirCasella(6,box11);
box40.afegirCasella(6,box1);

//tirada 1 casella 41	
box41.afegirCasella(1,box_start);
box41.afegirCasella(1,box42);

//tirada 2 casella 41	
box41.afegirCasella(2,box43);
box41.afegirCasella(2,box46);
box41.afegirCasella(2,box1);
box41.afegirCasella(2,box51);
box41.afegirCasella(2,box56);

//tirada 3 casella 41	
box41.afegirCasella(3,box44);
box41.afegirCasella(3,box47);
box41.afegirCasella(3,box2);
box41.afegirCasella(3,box52);
box41.afegirCasella(3,box57);

//tirada 4 casella 41	
box41.afegirCasella(4,box45);
box41.afegirCasella(4,box48);
box41.afegirCasella(4,box3);
box41.afegirCasella(4,box53);
box41.afegirCasella(4,box58);

//tirada 5 casella 41	
box41.afegirCasella(5,box34);
box41.afegirCasella(5,box49);
box41.afegirCasella(5,box4);
box41.afegirCasella(5,box54);
box41.afegirCasella(5,box59);

//tirada 6 casella 41	
box41.afegirCasella(6,box33);
box41.afegirCasella(6,box35);
box41.afegirCasella(6,box50);
box41.afegirCasella(6,box5);
box41.afegirCasella(6,box55);
box41.afegirCasella(6,box60);

//tirada 1 casella 42
box42.afegirCasella(1,box41);
box42.afegirCasella(1,box43);

//tirada 2 casella 42
box42.afegirCasella(2,box_start);
box42.afegirCasella(2,box44);

//tirada 3 casella 42
box42.afegirCasella(3,box45);
box42.afegirCasella(3,box46);
box42.afegirCasella(3,box1);
box42.afegirCasella(3,box51);
box42.afegirCasella(3,box56);

//tirada 4 casella 42
box42.afegirCasella(4,box34);
box42.afegirCasella(4,box47);
box42.afegirCasella(4,box2);
box42.afegirCasella(4,box52);
box42.afegirCasella(4,box57);

//tirada 5 casella 42
box42.afegirCasella(5,box33);
box42.afegirCasella(5,box35);
box42.afegirCasella(5,box48);
box42.afegirCasella(5,box3);
box42.afegirCasella(5,box53);
box42.afegirCasella(5,box58);

//tirada 6 casella 42
box42.afegirCasella(6,box32);
box42.afegirCasella(6,box36);
box42.afegirCasella(6,box49);
box42.afegirCasella(6,box4);
box42.afegirCasella(6,box54);
box42.afegirCasella(6,box59);

//tirada 1 casella 43
box43.afegirCasella(1,box44);
box43.afegirCasella(1,box42);

//tirada 2 casella 43
box43.afegirCasella(2,box45);
box43.afegirCasella(2,box41);

//tirada 3 casella 43
box43.afegirCasella(3,box34);
box43.afegirCasella(3,box_start);

//tirada 4 casella 43
box43.afegirCasella(4,box33);
box43.afegirCasella(4,box35);
box43.afegirCasella(4,box46);
box43.afegirCasella(4,box1);
box43.afegirCasella(4,box51);
box43.afegirCasella(4,box56);

//tirada 5 casella 43
box43.afegirCasella(5,box32);
box43.afegirCasella(5,box36);
box43.afegirCasella(5,box47);
box43.afegirCasella(5,box2);
box43.afegirCasella(5,box52);
box43.afegirCasella(5,box57);

//tirada 6 casella 43
box43.afegirCasella(6,box31);
box43.afegirCasella(6,box37);
box43.afegirCasella(6,box48);
box43.afegirCasella(6,box3);
box43.afegirCasella(6,box53);
box43.afegirCasella(6,box58);

//tirada 1 casella 44
box44.afegirCasella(1,box45);
box44.afegirCasella(1,box43);

//tirada 2 casella 44
box44.afegirCasella(2,box34);
box44.afegirCasella(2,box42);

//tirada 3 casella 44
box44.afegirCasella(3,box33);
box44.afegirCasella(3,box41);
box44.afegirCasella(3,box35);

//tirada 4 casella 44
box44.afegirCasella(4,box32);
box44.afegirCasella(4,box_start);
box44.afegirCasella(4,box36);

//tirada 5 casella 44
box44.afegirCasella(5,box31);
box44.afegirCasella(5,box46);
box44.afegirCasella(5,box1);
box44.afegirCasella(5,box56);
box44.afegirCasella(5,box51);
box44.afegirCasella(5,box37);

//tirada 6 casella 44
box44.afegirCasella(6,box30);
box44.afegirCasella(6,box47);
box44.afegirCasella(6,box2);
box44.afegirCasella(6,box57);
box44.afegirCasella(6,box52);
box44.afegirCasella(6,box38);

//tirada 1 casella 45
box45.afegirCasella(1,box34);
box45.afegirCasella(1,box44);

//tirada 2 casella 45
box45.afegirCasella(2,box33);
box45.afegirCasella(2,box35);
box45.afegirCasella(2,box43);

//tirada 3 casella 45
box45.afegirCasella(3,box32);
box45.afegirCasella(3,box36);
box45.afegirCasella(3,box42);

//tirada 4 casella 45
box45.afegirCasella(4,box31);
box45.afegirCasella(4,box37);
box45.afegirCasella(4,box41);


//tirada 5 casella 45
box45.afegirCasella(5,box30);
box45.afegirCasella(5,box38);
box45.afegirCasella(5,box_start);

//tirada 6 casella 45
box45.afegirCasella(6,box29);
box45.afegirCasella(6,box39);
box45.afegirCasella(6,box46);
box45.afegirCasella(6,box1);
box45.afegirCasella(6,box56);
box45.afegirCasella(6,box51);

//tirada 1 casella 46
box46.afegirCasella(1,box_start);
box46.afegirCasella(1,box47);

//tirada 2 casella 46
box45.afegirCasella(2,box41);
box45.afegirCasella(2,box1);
box45.afegirCasella(2,box56);
box45.afegirCasella(2,box51);
box46.afegirCasella(2,box48);

//tirada 3 casella 46
box45.afegirCasella(3,box42);
box45.afegirCasella(3,box2);
box45.afegirCasella(3,box57);
box45.afegirCasella(3,box52);
box46.afegirCasella(3,box49);

//tirada 4 casella 46
box45.afegirCasella(4,box43);
box45.afegirCasella(4,box3);
box45.afegirCasella(4,box58);
box45.afegirCasella(4,box53);
box46.afegirCasella(4,box50);

//tirada 5 casella 46
box45.afegirCasella(5,box44);
box45.afegirCasella(5,box4);
box45.afegirCasella(5,box59);
box45.afegirCasella(5,box54);
box46.afegirCasella(5,box27);

//tirada 5 casella 46
box45.afegirCasella(5,box45);
box45.afegirCasella(5,box5);
box45.afegirCasella(5,box60);
box45.afegirCasella(5,box55);
box46.afegirCasella(5,box26);
box46.afegirCasella(5,box28);

//tirada 1 casella 47
box47.afegirCasella(1,box46);
box47.afegirCasella(1,box48);

//tirada 2 casella 47
box47.afegirCasella(2,box_start);
box47.afegirCasella(2,box49);

//tirada 3 casella 47
box47.afegirCasella(3,box50);
box47.afegirCasella(3,box41);
box47.afegirCasella(3,box1);
box47.afegirCasella(3,box51);
box47.afegirCasella(3,box56);

//tirada 4 casella 47
box47.afegirCasella(4,box27);
box47.afegirCasella(4,box42);
box47.afegirCasella(4,box2);
box47.afegirCasella(4,box52);
box47.afegirCasella(4,box57);

//tirada 5 casella 47
box47.afegirCasella(5,box28);
box47.afegirCasella(5,box26);
box47.afegirCasella(5,box43);
box47.afegirCasella(5,box3);
box47.afegirCasella(5,box53);
box47.afegirCasella(5,box58);

//tirada 6 casella 47
box47.afegirCasella(6,box29);
box47.afegirCasella(6,box25);
box47.afegirCasella(6,box44);
box47.afegirCasella(6,box4);
box47.afegirCasella(6,box54);
box47.afegirCasella(6,box59);

//tirada 1 casella 48
box48.afegirCasella(1,box49);
box48.afegirCasella(1,box47);

//tirada 2 casella 48
box48.afegirCasella(2,box50);
box48.afegirCasella(2,box46);

//tirada 3 casella 48
box48.afegirCasella(3,box27);
box48.afegirCasella(3,box_start);

//tirada 4 casella 48
box48.afegirCasella(4,box28);
box48.afegirCasella(4,box26);
box48.afegirCasella(4,box41);
box48.afegirCasella(4,box1);
box48.afegirCasella(4,box51);
box48.afegirCasella(4,box56);

//tirada 5 casella 48
box48.afegirCasella(5,box29);
box48.afegirCasella(5,box25);
box48.afegirCasella(5,box42);
box48.afegirCasella(5,box2);
box48.afegirCasella(5,box52);
box48.afegirCasella(5,box57);

//tirada 6 casella 48
box48.afegirCasella(6,box30);
box48.afegirCasella(6,box24);
box48.afegirCasella(6,box43);
box48.afegirCasella(6,box3);
box48.afegirCasella(6,box53);
box48.afegirCasella(6,box58);

//tirada 1 casella 49
box49.afegirCasella(1,box50);
box49.afegirCasella(1,box48);

//tirada 2 casella 49
box49.afegirCasella(2,box27);
box49.afegirCasella(2,box47);

//tirada 3 casella 49
box49.afegirCasella(3,box26);
box49.afegirCasella(3,box28);
box49.afegirCasella(3,box46);

//tirada 4 casella 49
box49.afegirCasella(4,box25);
box49.afegirCasella(4,box29);
box49.afegirCasella(4,box_start);

//tirada 5 casella 49
box49.afegirCasella(5,box24);
box49.afegirCasella(5,box30);
box49.afegirCasella(5,box41);
box49.afegirCasella(5,box1);
box49.afegirCasella(5,box51);
box49.afegirCasella(5,box56);

//tirada 6 casella 49
box49.afegirCasella(6,box23);
box49.afegirCasella(6,box31);
box49.afegirCasella(6,box42);
box49.afegirCasella(6,box2);
box49.afegirCasella(6,box52);
box49.afegirCasella(6,box57);

//tirada 1 casella 50
box50.afegirCasella(1,box27);
box50.afegirCasella(1,box49);

//tirada 2 casella 50
box50.afegirCasella(2,box28);
box50.afegirCasella(2,box26);
box50.afegirCasella(2,box48);

//tirada 3 casella 50
box50.afegirCasella(3,box29);
box50.afegirCasella(3,box25);
box50.afegirCasella(3,box47);

//tirada 4 casella 50
box50.afegirCasella(4,box30);
box50.afegirCasella(4,box24);
box50.afegirCasella(4,box46);

//tirada 5 casella 50
box50.afegirCasella(5,box31);
box50.afegirCasella(5,box23);
box50.afegirCasella(5,box_start);

//tirada 6 casella 50
box50.afegirCasella(6,box32);
box50.afegirCasella(6,box22);
box50.afegirCasella(6,box41);
box50.afegirCasella(6,box1);
box50.afegirCasella(6,box51);
box50.afegirCasella(6,box56);

//tirada 1 casella 51
box51.afegirCasella(1,box_start);
box51.afegirCasella(1,box52);

//tirada 2 casella 51
box51.afegirCasella(2,box1);
box51.afegirCasella(2,box56);
box51.afegirCasella(2,box41);
box51.afegirCasella(2,box46);
box51.afegirCasella(2,box53);

//tirada 3 casella 51
box51.afegirCasella(3,box2);
box51.afegirCasella(3,box57);
box51.afegirCasella(3,box42);
box51.afegirCasella(3,box47);
box51.afegirCasella(3,box54);

//tirada 4 casella 51
box51.afegirCasella(4,box3);
box51.afegirCasella(4,box58);
box51.afegirCasella(4,box43);
box51.afegirCasella(4,box48);
box51.afegirCasella(4,box55);

//tirada 5 casella 51
box51.afegirCasella(5,box4);
box51.afegirCasella(5,box59);
box51.afegirCasella(5,box44);
box51.afegirCasella(5,box49);
box51.afegirCasella(5,box13);

//tirada 6 casella 51
box51.afegirCasella(6,box5);
box51.afegirCasella(6,box60);
box51.afegirCasella(6,box45);
box51.afegirCasella(6,box50);
box51.afegirCasella(6,box14);
box51.afegirCasella(6,box12);

//tirada 1 casella 52
box52.afegirCasella(1,box51);
box52.afegirCasella(1,box53);

//tirada 2 casella 52
box52.afegirCasella(2,box_start);
box52.afegirCasella(2,box54);

//tirada 3 casella 52
box52.afegirCasella(3,box1);
box52.afegirCasella(3,box41);
box52.afegirCasella(3,box46);
box52.afegirCasella(3,box56);
box52.afegirCasella(3,box55);

//tirada 4 casella 52
box52.afegirCasella(4,box2);
box52.afegirCasella(4,box42);
box52.afegirCasella(4,box47);
box52.afegirCasella(4,box57);
box52.afegirCasella(4,box13);

//tirada 5 casella 52
box52.afegirCasella(5,box3);
box52.afegirCasella(5,box43);
box52.afegirCasella(5,box48);
box52.afegirCasella(5,box58);
box52.afegirCasella(5,box12);
box52.afegirCasella(5,box14);

//tirada 6 casella 52
box52.afegirCasella(6,box4);
box52.afegirCasella(6,box44);
box52.afegirCasella(6,box49);
box52.afegirCasella(6,box59);
box52.afegirCasella(6,box11);
box52.afegirCasella(6,box15);

//tirada 1 casella 53
box53.afegirCasella(1,box52);
box53.afegirCasella(1,box54);

//tirada 2 casella 53
box53.afegirCasella(2,box51);
box53.afegirCasella(2,box55);

//tirada 3 casella 53
box53.afegirCasella(3,box_start);
box53.afegirCasella(3,box13);

//tirada 4 casella 53
box53.afegirCasella(4,box1);
box53.afegirCasella(4,box41);
box53.afegirCasella(4,box46);
box53.afegirCasella(4,box56);
box53.afegirCasella(4,box12);
box53.afegirCasella(4,box14);

//tirada 5 casella 53
box53.afegirCasella(5,box2);
box53.afegirCasella(5,box42);
box53.afegirCasella(5,box47);
box53.afegirCasella(5,box57);
box53.afegirCasella(5,box11);
box53.afegirCasella(5,box15);

//tirada 6 casella 53
box53.afegirCasella(6,box3);
box53.afegirCasella(6,box43);
box53.afegirCasella(6,box48);
box53.afegirCasella(6,box58);
box53.afegirCasella(6,box10);
box53.afegirCasella(6,box16);

//tirada 1 casella 54
box54.afegirCasella(1,box53);
box54.afegirCasella(1,box55);

//tirada 2 casella 54
box54.afegirCasella(2,box52);
box54.afegirCasella(2,box13);

//tirada 3 casella 54
box54.afegirCasella(3,box51);
box54.afegirCasella(3,box14);
box54.afegirCasella(3,box12);

//tirada 4 casella 54
box54.afegirCasella(4,box_start);
box54.afegirCasella(4,box15);
box54.afegirCasella(4,box11);

//tirada 5 casella 54
box54.afegirCasella(5,box1);
box54.afegirCasella(5,box41);
box54.afegirCasella(5,box46);
box54.afegirCasella(5,box56);
box54.afegirCasella(5,box16);
box54.afegirCasella(5,box10);

//tirada 6 casella 54
box54.afegirCasella(6,box2);
box54.afegirCasella(6,box42);
box54.afegirCasella(6,box47);
box54.afegirCasella(6,box57);
box54.afegirCasella(6,box17);
box54.afegirCasella(6,box9);

//tirada 1 casella 55
box55.afegirCasella(1,box54);
box55.afegirCasella(1,box13);

//tirada 2 casella 55
box55.afegirCasella(2,box53);
box55.afegirCasella(2,box12);
box55.afegirCasella(2,box14);

//tirada 3 casella 55
box55.afegirCasella(3,box52);
box55.afegirCasella(3,box11);
box55.afegirCasella(3,box15);

//tirada 4 casella 55
box55.afegirCasella(4,box51);
box55.afegirCasella(4,box10);
box55.afegirCasella(4,box16);

//tirada 5 casella 55
box55.afegirCasella(5,box_start);
box55.afegirCasella(5,box9);
box55.afegirCasella(5,box17);

//tirada 6 casella 55
box55.afegirCasella(6,box1);
box55.afegirCasella(6,box41);
box55.afegirCasella(6,box46);
box55.afegirCasella(6,box56);
box55.afegirCasella(6,box8);
box55.afegirCasella(6,box18);

//tirada 1 casella 56
box56.afegirCasella(1,box_start);
box56.afegirCasella(1,box57);

//tirada 2 casella 56
box56.afegirCasella(2,box1);
box56.afegirCasella(2,box51);
box56.afegirCasella(2,box41);
box56.afegirCasella(2,box46);
box56.afegirCasella(2,box58);

//tirada 3 casella 56
box56.afegirCasella(3,box2);
box56.afegirCasella(3,box52);
box56.afegirCasella(3,box42);
box56.afegirCasella(3,box47);
box56.afegirCasella(3,box59);

//tirada 4 casella 56
box56.afegirCasella(4,box3);
box56.afegirCasella(4,box53);
box56.afegirCasella(4,box43);
box56.afegirCasella(4,box48);
box56.afegirCasella(4,box60);

//tirada 5 casella 56
box56.afegirCasella(5,box4);
box56.afegirCasella(5,box54);
box56.afegirCasella(5,box44);
box56.afegirCasella(5,box49);
box56.afegirCasella(5,box20);

//tirada 6 casella 56
box56.afegirCasella(6,box5);
box56.afegirCasella(6,box55);
box56.afegirCasella(6,box45);
box56.afegirCasella(6,box50);
box56.afegirCasella(6,box21);
box56.afegirCasella(6,box19);

//tirada 1 casella 57
box57.afegirCasella(1,box56);
box57.afegirCasella(1,box58);

//tirada 2 casella 57
box57.afegirCasella(2,box_start);
box57.afegirCasella(2,box59);

//tirada 3 casella 57
box57.afegirCasella(3,box1);
box57.afegirCasella(3,box41);
box57.afegirCasella(3,box51);
box57.afegirCasella(3,box46);
box57.afegirCasella(3,box60);

//tirada 4 casella 57
box57.afegirCasella(4,box2);
box57.afegirCasella(4,box42);
box57.afegirCasella(4,box52);
box57.afegirCasella(4,box47);
box57.afegirCasella(4,box20);

//tirada 5 casella 57
box57.afegirCasella(5,box3);
box57.afegirCasella(5,box43);
box57.afegirCasella(5,box53);
box57.afegirCasella(5,box48);
box57.afegirCasella(5,box21);
box57.afegirCasella(5,box19);

//tirada 6 casella 57
box57.afegirCasella(6,box4);
box57.afegirCasella(6,box44);
box57.afegirCasella(6,box54);
box57.afegirCasella(6,box49);
box57.afegirCasella(6,box22);
box57.afegirCasella(6,box18);

//tirada 1 casella 58
box58.afegirCasella(1,box57);
box58.afegirCasella(1,box59);

//tirada 2 casella 58
box58.afegirCasella(2,box56);
box58.afegirCasella(2,box60);

//tirada 3 casella 58
box58.afegirCasella(3,box_start);
box58.afegirCasella(3,box20);

//tirada 4 casella 58
box58.afegirCasella(4,box1);
box58.afegirCasella(4,box41);
box58.afegirCasella(4,box51);
box58.afegirCasella(4,box46);
box58.afegirCasella(4,box19);
box58.afegirCasella(4,box21);

//tirada 5 casella 58
box58.afegirCasella(5,box2);
box58.afegirCasella(5,box42);
box58.afegirCasella(5,box52);
box58.afegirCasella(5,box47);
box58.afegirCasella(5,box18);
box58.afegirCasella(5,box22);

//tirada 6 casella 58
box58.afegirCasella(6,box3);
box58.afegirCasella(6,box43);
box58.afegirCasella(6,box53);
box58.afegirCasella(6,box48);
box58.afegirCasella(6,box17);
box58.afegirCasella(6,box23);

//tirada 1 casella 59
box59.afegirCasella(1,box58);
box59.afegirCasella(1,box60);

//tirada 2 casella 59
box59.afegirCasella(2,box57);
box59.afegirCasella(2,box20);

//tirada 3 casella 59
box59.afegirCasella(3,box56);
box59.afegirCasella(3,box19);
box59.afegirCasella(3,box21);

//tirada 4 casella 59
box59.afegirCasella(4,box_start);
box59.afegirCasella(4,box18);
box59.afegirCasella(4,box22);

//tirada 5 casella 59
box59.afegirCasella(5,box1);
box59.afegirCasella(5,box51);
box59.afegirCasella(5,box41);
box59.afegirCasella(5,box46);
box59.afegirCasella(5,box17);
box59.afegirCasella(5,box23);

//tirada 6 casella 59
box59.afegirCasella(6,box2);
box59.afegirCasella(6,box52);
box59.afegirCasella(6,box42);
box59.afegirCasella(6,box47);
box59.afegirCasella(6,box16);
box59.afegirCasella(6,box24);

//tirada 1 casella 60
box60.afegirCasella(1,box59);
box60.afegirCasella(1,box20);

//tirada 2 casella 60
box60.afegirCasella(2,box58);
box60.afegirCasella(2,box19);
box60.afegirCasella(2,box21);

//tirada 3 casella 60
box60.afegirCasella(3,box57);
box60.afegirCasella(3,box18);
box60.afegirCasella(3,box22);

//tirada 4 casella 60
box60.afegirCasella(4,box56);
box60.afegirCasella(4,box17);
box60.afegirCasella(4,box23);

//tirada 5 casella 60
box60.afegirCasella(5,box_start);
box60.afegirCasella(5,box16);
box60.afegirCasella(5,box24);

//tirada 6 casella 60
box60.afegirCasella(5,box1);
box60.afegirCasella(5,box51);
box60.afegirCasella(5,box41);
box60.afegirCasella(5,box46);
box60.afegirCasella(5,box15);
box60.afegirCasella(5,box25);