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

        public static function ListaPersonas(){
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

        public static function BuscarPersona($contrasena,$email){
                $arrayPersonas = Conexion::seleccionarPersona($contrasena,$email);
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

            public static function ModificarPersona($id_usuario,$data){
                $arrayPersonas = Conexion::modificarPersona($id_usuario,$data);
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

            public static function Rendirse($id_usuario,$id_tablero){
                $arrayPersonas = Conexion::rendirse($id_usuario,$id_tablero);
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

            public static function EliminarPersona($id_persona){
                $arrayPersonas = Conexion::EliminarPersona($id_persona);
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

            public static function RevisarAdmin($id_persona){
                $admin = Conexion::RevisarAdmin($id_persona);
                $isAdmin = false;
                if($admin == 1){
                    $isAdmin = true;
                }

                return $isAdmin;
                
            }


            public static function OrdenarPersonasPorPartidasGanadas($arrayPersonas){
                usort($arrayPersonas, function($a, $b) {
                    return $b->partidasGanadas - $a->partidasGanadas;
                });
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

            //Esta funcion muestra los tableros que se encuentran activos
            public static function TablerosActivos($arrayTableros,$id_persona){
                
                $tablerosActivos = [];
                for($i=0; $i < count($arrayTableros); $i++){
                    if($arrayTableros[$i]->getFinalizado() == 0  && $arrayTableros[$i]->getId_usuario() == $id_persona){
                        array_push($tablerosActivos,$arrayTableros[$i]);
                    }
                }

                if($tablerosActivos == null){

                $cod = 201;
                $mes = "TODO OK";
                header(Constantes::$headerMssg . $cod . ' ' . $mes);
                $respuesta = [
                    'Cod:' => $cod,
                    'Mensaje:' => $mes,
                    'Disponibilidad' => "No hay niguna tabla disponible."
                ];

                }else{

                    $cod = 201;
                    $mes = "TODO OK";
                    header(Constantes::$headerMssg . $cod . ' ' . $mes);
                    $respuesta = [
                        'Cod:' => $cod,
                        'Mensaje:' => $mes,
                        'Tablas' => $tablerosActivos
                    ];


                }
                
                echo json_encode($respuesta);
            }

        //En esta función compruebo si el tablero existe o si esta activo, en el caso de que no sea ninguna de las dos pasa a la funcion jugar
        public static function iniciarJuego($id_tablero,$posicion){

        if(Conexion::seleccionarTablero($id_tablero) == null){

            $cod = 201;
                    $mes = "TODO OK";
                    header(Constantes::$headerMssg . $cod . ' ' . $mes);
                    $respuesta = [
                        'Cod:' => $cod,
                        'Mensaje:' => $mes,
                        'Resultado:' => 'Tablero inexistente'
                    ];
                
                echo json_encode($respuesta);

        }else if(Conexion::seleccionarTablero($id_tablero)->getFinalizado() == 1){

                $cod = 201;
                    $mes = "TODO OK";
                    header(Constantes::$headerMssg . $cod . ' ' . $mes);
                    $respuesta = [
                        'Cod:' => $cod,
                        'Mensaje:' => $mes,
                        'Resultado:' => 'Tablero inactivo, introduzca otro'
                    ];
                
                echo json_encode($respuesta);

            }else{

                self::Jugar($id_tablero,$posicion);
            }


        }

        //En esta funcion genero el tablero en funcion del id_tablero y guardo en dos variables 'tableroJugador' y 'tableroOculto'.
        //Y a acontinuacion comprueba si la posicion introducida es valida y si es asi pasa a la funcion 'ActualizarPosicion'
        public static function Jugar($id_tablero,$posicion){

            $tablero = Conexion::seleccionarTablero($id_tablero);
            $tableroJugador = str_split($tablero->getTableroJugador());
            $tableroOculto = str_split($tablero->getTableroOculto());
            $posElegida = $posicion -1;
            
            
            if(@$tableroOculto[$posElegida] == null){

                
                $cod = 201;
                    $mes = "TODO OK";
                    header(Constantes::$headerMssg . $cod . ' ' . $mes);
                    $respuesta = [
                        'Cod:' => $cod,
                        'Mensaje:' => $mes,
                        'Situacion:' => 'Posicion incorrecta',
                       
                    ];
            }else if($tableroJugador[$posElegida] == "1" || $tableroJugador[$posElegida] == "2" || $tableroJugador[$posElegida] == "0"){


                $cod = 201;
                    $mes = "TODO OK";
                    header(Constantes::$headerMssg . $cod . ' ' . $mes);
                    $respuesta = [
                        'Cod:' => $cod,
                        'Mensaje:' => $mes,
                        'Situacion:' => 'Celda ya destapada ',
                    ];
                echo json_encode($respuesta);

            
            }else if($tableroOculto[$posElegida] == "M"){

                $tableroActualizado = self::ActualizarPosicion($posElegida,$tableroJugador,$tableroOculto,$tablero);

                $cod = 201;
                    $mes = "TODO OK";
                    header(Constantes::$headerMssg . $cod . ' ' . $mes);
                    $respuesta = [
                        'Cod:' => $cod,
                        'Mensaje:' => $mes,
                        'Situacion:' => 'Has volado en pedazos, asi ha quedado tu tablero: ',
                        'Tablero:' => $tableroActualizado
                    ];


            }else if($tableroOculto[$posElegida] == "_"){

                $tableroActualizado = self::ActualizarPosicion($posElegida,$tableroJugador,$tableroOculto,$tablero);

                $cod = 201;
                    $mes = "TODO OK";
                    header(Constantes::$headerMssg . $cod . ' ' . $mes);
                    $respuesta = [
                        'Cod:' => $cod,
                        'Mensaje:' => $mes,
                        'Situacion:' => 'Estas a salvo , de momento. Asi se ha quedado tu tablero: ',
                        'Tablero:' => $tableroActualizado
                    ];
                
                
            }

            echo json_encode($respuesta);

        }

        //En esta funcion controlo que hay en la posicion seleccionaada, y en funcion de lo que sea actualizo la base de datos y devuelvo el tableroJugador actualizado
        
        public static function ActualizarPosicion($posicion,$tableroJugador,$tableroOculto,$tablero){
            
            if($tableroOculto[$posicion] == 'M'){

                $tableroJugador[$posicion] = 'M';
                Conexion::actualizarTablero($tablero->getId(),self::arrayToString($tableroJugador));
                Conexion::rendirse($tablero->getId_usuario(),$tablero->getId());

            }else if(@$tableroOculto[$posicion-1] == 'M' && @$tableroOculto[$posicion+1] == 'M'){
               
                $tableroJugador[$posicion] = '2';
                Conexion::actualizarTablero($tablero->getId(),self::arrayToString($tableroJugador));


            }else if(@$tableroOculto[$posicion-1] == 'M' || @$tableroOculto[$posicion+1] == 'M'){

                
                $tableroJugador[$posicion] = '1';
                Conexion::actualizarTablero($tablero->getId(),self::arrayToString($tableroJugador));

            }else{

                $tableroJugador[$posicion] = '0';
                Conexion::actualizarTablero($tablero->getId(),self::arrayToString($tableroJugador));


            }

            return $tableroJugador;

        }


}