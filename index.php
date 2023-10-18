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

            $cod = 404;
            $mes = "Introdusca valores correctos";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta);

        }


      
    }if($requestMethod == 'GET'){

        if ($argus[1] == 'ListaUsuarios') {
            
            Controlador::ListaUsuarios();

        }else if ($argus[1] == 'CrearTableroPersonalizada') {
            

        }else if ($argus[1] == 'CrearPersona') {
             
        
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
