<?php

require_once(__DIR__ . '/Modelo/Persona.php');
require_once(__DIR__ . '/Modelo/Tablero.php');
require_once('Conexion.php');
require_once('Constantes.php');
require_once('Controlador.php');

header("Content-Type:application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths =  $_SERVER['REQUEST_URI'];
$datosRecibidos = file_get_contents("php://input");

$argus = explode('/', $paths);
unset($argus[0]);


$data = json_decode($datosRecibidos,true);


if ($requestMethod == 'POST') {

    if ($argus[1] == 'CrearTablero') {

            $data = json_decode($datosRecibidos,true);
            Controlador::insertarTablero(Controlador::CrearTableroPredefinida($data['user_id']));
            
            $cod = 201;
            $mes = "Perfe";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta);

        }else if ($argus[1] == 'CrearTableroPersonalizada') {
            $data = json_decode($datosRecibidos,true);
            Controlador::insertarTablero(Controlador::crearTableroParametros($data['user_id'],$data['numTablero'],$data['numMinas']));
            $cod = 201;
            $mes = "Perfe";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta);

        }else if ($argus[1] == 'CrearPersona') {

            if(Controlador::RevisarAdmin($argus[2]) == true){

                $data = json_decode($datosRecibidos,true);
            Controlador::insertarPersona(Controlador::crearPersona($data['password'],$data['nombre'],$data['email'],$data['admin']));
            $cod = 201;
            $mes = "Perfe";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta);   
            }else{
                echo json_encode('No eres administrador');
            }
             
        
        }else if ($argus[1] == 'Jugar' && $data != null) {

           Controlador::iniciarJuego($data['id_tablero'],$data['posicion']);

             
        
        }else if ($argus[1] == 'Jugar') {

            Controlador::TablerosActivos(Conexion::seleccionarTodasTableros(),$argus[2]);
            $cod = 201;
            $mes = "Perfe";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta); 
            
             
        
        }else{

            $cod = 404;
            $mes = "Introdusca valores correctos";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta);

        }


      
    }else if($requestMethod == 'GET'){

        if ($argus[1] == 'ListaPersonas') {

            if(Controlador::RevisarAdmin($argus[2]) == true){
                Controlador::ListaPersonas();
                $cod = 201;
                $mes = "Perfe";
                header(Constantes::$headerMssg . $cod . ' ' . $mes);
                $respuesta = [
                    'Cod:' => $cod,
                    'Mensaje:' => $mes,
                ];
                echo json_encode($respuesta); 
            }else{
                echo json_encode('No eres administrador');
            }
            

        }else if ($argus[1] == 'BuscarPersona') {
            
            if(Controlador::RevisarAdmin($argus[2]) == true){
                Controlador::BuscarPersona($argus[3],$argus[4]);
                $cod = 201;
                $mes = "Perfe";
                header(Constantes::$headerMssg . $cod . ' ' . $mes);
                $respuesta = [
                    'Cod:' => $cod,
                    'Mensaje:' => $mes,
                ];
                echo json_encode($respuesta); 
            }else{
                echo json_encode('No eres administrador');
            }

        }else if ($argus[1] == 'Ranking') {
             
            Controlador::OrdenarPersonasPorPartidasGanadas(Conexion::seleccionarTodasPersonas());
            $cod = 201;
            $mes = "Perfe";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta); 
        
        }else{

            $cod = 404;
            $mes = "Introdusca valores correctos";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta);

        }


    }else if($requestMethod == 'PUT'){

        if ($argus[1] == 'ModificarPersona') {
            
            if(Controlador::RevisarAdmin($argus[2]) == true){
                $data = json_decode($datosRecibidos,true);
                Controlador::ModificarPersona($argus[3],$data);
                $cod = 201;
                $mes = "Perfe";
                header(Constantes::$headerMssg . $cod . ' ' . $mes);
                $respuesta = [
                    'Cod:' => $cod,
                    'Mensaje:' => $mes,
            ];
                echo json_encode($respuesta);
            }else{
                echo json_encode('No eres administrador');
            }
                

        }else if ($argus[1] == 'Rendirse') {
            
           
            $data = json_decode($datosRecibidos,true);
            Controlador::Rendirse($argus[2],$data['id_tablero']);
            $cod = 201;
            $mes = "Perfe";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta);   
             
        
        }else{

            $cod = 404;
            $mes = "Introdusca valores correctos";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta);

        }


    }else if($requestMethod == 'DELETE'){

        if ($argus[1] == 'EliminarPersona') {
            
            if(Controlador::RevisarAdmin($argus[2]) == true){
                $data = json_decode($datosRecibidos,true);
                Controlador::EliminarPersona($data['id_persona']);
                $cod = 201;
                $mes = "Perfe";
                header(Constantes::$headerMssg . $cod . ' ' . $mes);
                $respuesta = [
                    'Cod:' => $cod,
                    'Mensaje:' => $mes,
                ];
                echo json_encode($respuesta);
            }else{
                echo json_encode('No eres administrador');
            }
              
             
        
        }else{

            $cod = 404;
            $mes = "Introdusca valores correctos";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta);

        }


    }
