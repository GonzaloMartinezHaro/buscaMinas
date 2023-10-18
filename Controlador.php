<?php

require_once(__DIR__ . '/Modelo/Persona.php');
require_once(__DIR__ . '/Modelo/Tablero.php');


Class Controlador{

    public static function CrearTableroPredefinida($id_usuario){

        $array =  [];
        $arrayJugador = [];

        for($i = 0; $i < 10; $i++){

            array_push($array,'_');
        }

        $arrayJugador = $array;
        
        for($i = 0; $i < 2; $i++){

            $alt = rand(0,9);
            if($array[$alt] == '_'){

                $array[$alt] = 'M';

            }else{
                $i--;
            }

        }
        
        $stringArrayOculto = self::arrayToString($array);
        $stringArrayJugador = self::arrayToString($arrayJugador);
        
        $tablero = new Tablero(null,$id_usuario,$stringArrayOculto,$stringArrayJugador,0);

        return $tablero;
    }

    public static function crearTableroParametros($id_usuario,$numTablero,$numMina){

        $array =  [];
        $arrayJugador = [];

        for($i = 0; $i < $numTablero; $i++){

            array_push($array,'_');
        
        }
        $arrayJugador = $array;
        
        for($i = 0; $i < $numMina; $i++){

            $alt = rand(0,$numTablero-1);
            if($array[$alt] == '_'){

                $array[$alt] = 'M';

            }else{
                $i--;
            }
        }
              
        $stringArrayOculto = self::arrayToString($array);
        $stringArrayJugador = self::arrayToString($arrayJugador);
        
        $tablero = new Tablero(null,$id_usuario,$stringArrayOculto,$stringArrayJugador,0);

        return $tablero;
        
    }

    public static function crearPersona($password,$nombre,$email,$admin){

        $p = new Persona(null,$password,$nombre,$email,0 ,0,$admin);
        return $p;
    }

    public static function arrayToString($array){
        
        $string = '';

        for($i = 0; $i < count($array); $i++){
            $string = $string . $array[$i];
        }

        return $string;
        
    }

    public static function insertarTablero($p){

        Conexion::insertarTablero($p);
           
            $inserccion = true;
            $cod = 201;
            $mes = "TODO OK";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
                'Inserccion' => $inserccion,
                
            ];
            echo json_encode($respuesta);
        }

        public static function insertarPersona($p){

            Conexion::insertarPersona($p);
               
                $inserccion = true;
                $cod = 201;
                $mes = "TODO OK";
                header(Constantes::$headerMssg . $cod . ' ' . $mes);
                $respuesta = [
                    'Cod:' => $cod,
                    'Mensaje:' => $mes,
                    'Inserccion' => $inserccion,
                    
                ];
                echo json_encode($respuesta);
            }

        public static function ListaUsuarios(){
                $arrayPersonas = Conexion::SeleccionarTodasPersonas();
                $cod = 201;
                $mes = "TODO OK";
                header(Constantes::$headerMssg . $cod . ' ' . $mes);
                $respuesta = [
                    'Cod:' => $cod,
                    'Mensaje:' => $mes,
                    'Personas' => $arrayPersonas
                ];
                echo json_encode($respuesta);
            }


}