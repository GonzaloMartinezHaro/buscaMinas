Guia de Uso

-ListarPersonas

Se pasa por la URL mediante el verbo GET, 'ListaPersona' para indicar la funcion y 3 que indica el id del usuario, con el cual se comprobara si es amdministraador o no.

URL: GET /ListaPersonas/3

Succes Response:

  Code:200
  Content:
  
{"Cod:":201,"Mensaje:":"TODO OK","Personas":[{"id":1,"password":"Benito","nombre":"benito1234","email":"benito@asdf.com","partidasGanadas":0,"partidasJugadas":0,"admin":0},{"id":3,"password":"Pedro","nombre":"Pedro","email":"Pedro@Pedro.com","partidasGanadas":3,"partidasJugadas":0,"admin":1},{"id":4,"password":"Juan","nombre":"Juan","email":"Juan@Juan.com","partidasGanadas":1,"partidasJugadas":0,"admin":0},{"id":5,"password":"Pepe","nombre":"Pepe","email":"Pepe@Pepe.com","partidasGanadas":2,"partidasJugadas":0,"admin":0},{"id":6,"password":"Jose","nombre":"Jose","email":"Jose@Jose.com","partidasGanadas":4,"partidasJugadas":0,"admin":0}]}{"Cod:":201,"Mensaje:":"Perfe"}


-BuscarPersona

Se pasa por la URL mediante el verbo GET, 'BuscarPersona' para indicar la funcion, 3 que indica el id del usuario, con el cual se comprobara si es amdministraador o no, y el email y la contraseña para busacar a la persona deseada.

URL: GET /BuscarPersona/3/benito/benito1234

Succes Response:

  Code:201
  Content:

{"Cod:":201,"Mensaje:":"TODO OK","Personas":[{"id":1,"password":"Benito","nombre":"benito1234","email":"benito","partidasGanadas":0,"partidasJugadas":0,"admin":0}]}{"Cod:":201,"Mensaje:":"Perfe"}


-Ranking

Se pasa por la URL mediante el verbo GET, 'Ranking' para indicar la funcion.

URL: GET /Ranking


Succes Response:

  Code:201
  Content:

{"Cod:":201,"Mensaje:":"TODO OK","Personas":[{"id":6,"password":"Jose","nombre":"Jose","email":"Jose@Jose.com","partidasGanadas":4,"partidasJugadas":0,"admin":0},{"id":3,"password":"Pedro","nombre":"Pedro","email":"Pedro.com","partidasGanadas":3,"partidasJugadas":0,"admin":1},{"id":5,"password":"Pepe","nombre":"Pepe","email":"Pepe@Pepe.com","partidasGanadas":2,"partidasJugadas":0,"admin":0},{"id":4,"password":"Juan","nombre":"Juan","email":"Juan@Juan.com","partidasGanadas":1,"partidasJugadas":0,"admin":0},{"id":1,"password":"Benito","nombre":"benito1234","email":"benito","partidasGanadas":0,"partidasJugadas":0,"admin":0}]}{"Cod:":201,"Mensaje:":"Perfe"}
  

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

  

