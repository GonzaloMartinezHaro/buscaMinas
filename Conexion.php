<?php

require_once(__DIR__ . '/Modelo/Persona.php');
require_once(__DIR__ . '/Modelo/Tablero.php');

Class Conexion{

    static $conexion;

    public static function conectar(){
           $cod = 0;
        try {
            self::$conexion = mysqli_connect(Constantes::$host, Constantes::$user, Constantes::$psswd, Constantes::$bdName);
        }catch(Exception $e){
            $cod = 1;
        }
        return $cod;
    }

    private static function desconectar()
    {
        mysqli_close(self::$conexion);
    }


    public static function seleccionarPersona($email,$pass){
        if (self::conectar()==0){
            $consulta = "SELECT * FROM PERSONAS WHERE email = ? AND pass = ?";
            $stmt = mysqli_prepare(self::$conexion, $consulta);
            mysqli_stmt_bind_param($stmt, "ss", $email,$pass);
            mysqli_stmt_execute($stmt);
            $correcto = [];
            $correcto_query = mysqli_stmt_get_result($stmt);
            if ($fila = mysqli_fetch_array($correcto_query)) {
                $p = new Persona($fila["ID"], $fila["NOMBRE"], $fila["CONTRASENA"], $fila["EMAIL"], $fila["PARTIDASGANADAS"], $fila["PARTIDASJUGADAS"], $fila["ADMIN"]);
                $correcto[] = $p;
                self::desconectar();
                return ($fila['id']);
            }
            else {
                self::desconectar();
                return 0;
            }
        }
        else {
            return -1; //conexión falla.
        }
        
    }

    public static function seleccionarTodasPersonas()
    {
        self::conectar();
        if (!self::$conexion) {
            die();
        } else {
            $consulta = "SELECT * FROM PERSONAS";
            $stmt = mysqli_prepare(self::$conexion, $consulta);
            mysqli_stmt_execute($stmt);
            $correcto = [];
            $correcto_query = mysqli_stmt_get_result($stmt);
            while ($fila = mysqli_fetch_array($correcto_query)) {
                $p = new Persona($fila["ID"], $fila["NOMBRE"], $fila["CONTRASENA"], $fila["EMAIL"], $fila["PARTIDASGANADAS"], $fila["PARTIDASJUGADAS"], $fila["ADMIN"]);
                $correcto[] = $p;
            }
            mysqli_free_result($correcto_query);
        }
        self::desconectar();
        return $correcto;
    }


    public static function insertarPersona($persona) {
        self::conectar();
        $correcto = false;
    
        if (!self::$conexion) {
            echo json_encode("Error");
        } else {
            $query = "INSERT INTO PERSONAS(NOMBRE, CONTRASENA, EMAIL, PARTIDASGANADAS, PARTIDASJUGADAS, ADMIN) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare(self::$conexion, $query);
    
            if (!$stmt) {
                echo json_encode("Error en la preparación de la consulta");
            } else {
                $password = $persona->getPassword();
                $nombre = $persona->getNombre();
                $email = $persona->getEmail();
                $partidasGanadas = $persona->getPartidasGanadas();
                $partidasJugadas = $persona->getPartidasJugadas();
                $admin = $persona->getAdmin();
    
                mysqli_stmt_bind_param($stmt, "sssiii", $nombre, $password, $email, $partidasGanadas, $partidasJugadas, $admin);
    
                try {
                    if (mysqli_stmt_execute($stmt)) {
                        $correcto = true;
                    } else {
                        echo json_encode("Error al ejecutar la consulta: " . mysqli_error(self::$conexion));
                    }
                } catch (Exception $e) {
                    $correcto = false;
                    echo json_encode("Error en la ejecución de la consulta: " . $e->getMessage());
                }
    
                mysqli_stmt_close($stmt);
            }
    
            self::desconectar();
        }
    
        return $correcto;
    }
    


    public static function borrarPersona($id)
    {
        self::conectar();
        $correcto = false;
        if (!self::$conexion) {
            die();
        } else {
            $query = "DELETE FROM personas WHERE ID = '$id'";
            try {

                $correcto = mysqli_query(self::$conexion, $query);
            } catch (Exception $e) {
                $correcto = false;
            }
            self::desconectar();
        }
        return $correcto;
    }

    public static function modificarContraseña($idCambiar, $data)
    {
        $correcto = false;
        self::conectar();
        if (!self::$conexion) {
            die();
        } else {
            $query = 'UPDATE personas SET password = ? where id = ?';
            $stmt = mysqli_prepare(self::$conexion, $query);
            mysqli_stmt_bind_param($stmt, "si", $data['password'], $idCambiar);
            try {
                mysqli_stmt_execute($stmt);
                $correcto = true;
            } catch (Exception $e) {
                $correcto = false;
            }
        }
        self::desconectar();
        return $correcto;
    }


    public static function modificarPersona($idCambiar, $data){
        $correcto = false;
        self::conectar();
        if (!self::$conexion) {
            die();
        } else {
            $query = 'UPDATE personas SET nombre = ?, email = ? where id = ?';
            $stmt = mysqli_prepare(self::$conexion, $query);
            mysqli_stmt_bind_param($stmt, "ssi", $data['Nombre'], $data['email'], $idCambiar);
            try {
                mysqli_stmt_execute($stmt);
                $correcto = true;
            } catch (Exception $e) {
                $correcto = false;
            }
        }
        self::desconectar();
        return $correcto;
    }

    

    public static function insertarTablero($tablero) {
        self::conectar();
        $correcto = false;
        
        if (!self::$conexion) {
            echo json_encode("Error");
        } else {
            $query = "INSERT INTO tablero (TABLERO_OCULTO, TABLERO_JUGADOR, FINALIZADO, ID_PERSONA) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare(self::$conexion, $query);
            
            if (!$stmt) {
                echo json_encode("Error en la preparación de la consulta");
            } else {
                $id_usuario = $tablero->getId_usuario();
                $tablero_oculto = $tablero->getTableroOculto();
                $tablero_jugador = $tablero->getTableroJugador();
                $finalizado = $tablero->getFinalizado();
                
                mysqli_stmt_bind_param($stmt, "ssii", $tablero_oculto, $tablero_jugador, $finalizado, $id_usuario);
                
                try {
                    if (mysqli_stmt_execute($stmt)) {
                        $correcto = true;
                    }
                } catch (Exception $e) {
                    $correcto = false;
                    echo json_encode("Error al ejecutar la consulta: " . $e->getMessage());
                }
                
                mysqli_stmt_close($stmt);
            }
            
            self::desconectar();
        }
        
        return $correcto;
    }
    

    
}