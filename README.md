Guia de Uso


-ListarPersonas

Se pasa por la URL mediante el verbo GET, 'ListaPersona' para indicar la funcion y 3 que indica el id del usuario, con el cual se comprobara si es amdministraador o no.

URL: GET /ListaPersonas/3

Succes Response:

  Code:200
  Content:
  
{"Cod:":201,"Mensaje:":"TODO OK","Personas":[{"id":1,"password":"Benito","nombre":"benito1234","email":"benito@gmail","partidasGanadas":0,"partidasJugadas":0,"admin":0},{"id":3,"password":"Pedro","nombre":"Pedro","email":"Pedro@gmail","partidasGanadas":3,"partidasJugadas":0,"admin":1},{"id":4,"password":"Juan","nombre":"Juan","email":"benito@gmail","partidasGanadas":1,"partidasJugadas":0,"admin":0},{"id":5,"password":"Pepe","nombre":"Pepe","email":"Pepe@gmail","partidasGanadas":2,"partidasJugadas":0,"admin":0},{"id":6,"password":"Jose","nombre":"Jose","email":"Jose@gmail","partidasGanadas":4,"partidasJugadas":0,"admin":0}]}{"Cod:":201,"Mensaje:":"Perfe"}




-BuscarPersona

Se pasa por la URL mediante el verbo GET, 'BuscarPersona' para indicar la funcion, 3 que indica el id del usuario, con el cual se comprobara si es amdministraador o no, y el email y la contraseña para busacar a la persona deseada.

URL: GET /BuscarPersona/3/benito@gmail/benito1234

Succes Response:

  Code:201
  Content:

{"Cod:":201,"Mensaje:":"TODO OK","Personas":[{"id":1,"password":"Benito","nombre":"benito1234","email":"benito@gmail","partidasGanadas":0,"partidasJugadas":0,"admin":0}]}{"Cod:":201,"Mensaje:":"Perfe"}



















-Ranking

Se pasa por la URL mediante el verbo GET, 'Ranking' para indicar la funcion.

URL: GET /Ranking


Succes Response:

  Code:201
  Content:

{"Cod:":201,"Mensaje:":"TODO OK","Personas":[{"id":6,"password":"Jose","nombre":"Jose","email":"Jose@gmail","partidasGanadas":4,"partidasJugadas":0,"admin":0},{"id":3,"password":"Pedro","nombre":"Pedro","email":"Pedro@gmail","partidasGanadas":3,"partidasJugadas":0,"admin":1},{"id":5,"password":"Pepe","nombre":"Pepe","email":"Pepe@gmail","partidasGanadas":2,"partidasJugadas":0,"admin":0},{"id":4,"password":"Juan","nombre":"Juan","email":"benito@gmail","partidasGanadas":1,"partidasJugadas":0,"admin":0},{"id":1,"password":"Benito","nombre":"benito1234","email":"benito@gmail","partidasGanadas":0,"partidasJugadas":0,"admin":0}]}{"Cod:":201,"Mensaje:":"Perfe"}
  




-CrearTablero

Se pasa por la URL mediante el verbo POST, 'CrearTablero' para indicar la funcion, y el el body pasaremos el id de la persona.


URL: POST /CrearPersona


Body: 

{
  "user_id" : 3
}

Succes Response:

  Code:201
  Content:

  {"Cod:":201,"Mensaje:":"TODO OK","Inserccion":true}{"Cod:":201,"Mensaje:":"Perfe"}





-CrearTableroPersonalizada

Se pasa por la URL mediante el verbo POST, 'CrearTableroPersonalizada' para indicar la funcion, y en el body pasaremos el id de la persona, el numero de casillas de tablero y el numero de minas.

URL: POST /CrearTableroPersonalizada

Body: 

{
  "user_id" : 3,
  "numTablero" : 6,
  "numMinas" : 2

}

Succes Response:

  Code:201
  Content:

  {"Cod:":201,"Mensaje:":"TODO OK","Inserccion":true}{"Cod:":201,"Mensaje:":"Perfe"}





-CrearPersona

Se pasa por la URL mediante el verbo POST, 'CrearPersona' para indicar la funcion y el id de la persona para comprobar si es administrador y en el body pasaremos la contraseña, el nombre, el email y si es o no administrador.

URL: POST /CrearPersona/3

Body: 

{
  "password" : "Andres",
  "nombre" : "Andres",
  "email" : "Andres@gmail",
  "admin" : 1
  
}

Succes Response:

  Code:201
  Content:

  {"Cod:":201,"Mensaje:":"TODO OK","Inserccion":true}{"Cod:":201,"Mensaje:":"Perfe"}





-Jugar

Para esta funcion hay dos finalidades, mostrar al usuario los tableros que tiene activos para saber con cual quiere jugar, y jugar elegiendo una casilla de una tabla especifica.


Para el primer caso se introducira por la URL mediante el verbo POST, 'Jugar' y el id del usuario.

URL: POST /Jugar/3

Succes Response:

  Code:201
  Content:

{"Cod:":201,"Mensaje:":"TODO OK","Tablas":[{"id":25,"id_usuario":3,"tableroOculto":"M________M","tableroJugador":"_1________","finalizado":0},{"id":27,"id_usuario":3,"tableroOculto":"_____M___M","tableroJugador":"__________","finalizado":0},{"id":28,"id_usuario":3,"tableroOculto":"M__M______","tableroJugador":"__________","finalizado":0},{"id":29,"id_usuario":3,"tableroOculto":"___M____M_","tableroJugador":"__________","finalizado":0},{"id":30,"id_usuario":3,"tableroOculto":"_____MM___","tableroJugador":"__________","finalizado":0},{"id":31,"id_usuario":3,"tableroOculto":"M____M","tableroJugador":"______","finalizado":0}]}{"Cod:":201,"Mensaje:":"Perfe"}

Para el segundo caso se introducira por la URL mediante el verbo POST, 'Jugar' y en el body pasaremos el id de la tabla y la posicion a destapar.

URL: POST /Jugar

Body: 

{
  "id_tablero" : 29,
  "posicion" : 1
}

Succes Response:

  Code:201
  Content:

{
  "Cod:": 201,
  "Mensaje:": "TODO OK",
  "Situacion:": "Estas a salvo , de momento. Asi se ha quedado tu tablero: ",
  "Tablero:": [
    "0",
    "_",
    "_",
    "_",
    "_",
    "_",
    "_",
    "_",
    "_",
    "_"
  ]
}






-ModificarPersona

Se pasa por la URL mediante el verbo PUT, 'ModificarPersona' para indicar la funcion, el id de la persona para comprobar si es administrador y el id de la perona que se quiere modificar. En el body pasaremos el nombre, el email y la contraseña.

URL: PUT ModificarPersona/3/1

Body: 

{
 "nombre" : "benit0",
  "email" : "benit0@gmail",
  "contraseña" : "benit0"
}

Succes Response:

  Code:201
  Content:

  {"Cod:":201,"Mensaje:":"TODO OK","Personas":true}{"Cod:":201,"Mensaje:":"Perfe"}





-Rendirse

Se pasa por la URL mediante el verbo PUT, 'Rendirse' para indicar la funcion, y el id de la persona que quiere rendirse. En el body se pasara el id del tablero que quiere finalizar.

URL: PUT Rendirse/3

Body: 

{
 "id_tablero" : 31
}

Succes Response:

  Code:201
  Content:

{"Cod:":201,"Mensaje:":"TODO OK","Personas":true}{"Cod:":201,"Mensaje:":"Perfe"}





-EliminarPersona

Se pasa por la URL mediante el verbo DELETE, 'EliminarPersona' para indicar la funcion, y el id de la persona para comprobar si es administrador.En el body se pasara el id de la persona que se quiere eliminar.


URL: DELETE EliminarPersona/3

Body: 

{
 "id_persona" : 8
}

Succes Response:

  Code:201
  Content:

{"Cod:":201,"Mensaje:":"TODO OK","Personas":true}{"Cod:":201,"Mensaje:":"Perfe"}





