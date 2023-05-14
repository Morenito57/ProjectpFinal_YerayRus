<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);
    class UsuarioAccesoDatos {	
        function __construct() {
        }

        function insertar($usuario,$clave,$perfil) {
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'LegendaryMotorsport');
            $consulta = mysqli_prepare($conexion, "INSERT INTO Usuario(NombreUsuario, Clave, TipoDeUsuario) VALUES (?,?,?);");
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            $consulta->bind_param("sss", $usuario,$hash,$perfil);
            $res = $consulta->execute();
            
            return $res;
        }

        function verificar($usuario,$clave) {
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');
            $consulta = mysqli_prepare($conexion, "SELECT NombreUsuario, Clave, TipoDeUsuario FROM Usuario WHERE NombreUsuario = ?;");
            $sanitized_usuario = mysqli_real_escape_string($conexion, $usuario);       
            $consulta->bind_param("s", $sanitized_usuario);
            $consulta->execute();
            $res = $consulta->get_result();

            if ($res->num_rows==0) {
                return 'NOT_FOUND';
            }

            if ($res->num_rows>1) {
                return 'NOT_FOUND';
            }

            $myrow = $res->fetch_assoc();
            $x = $myrow['Clave'];

            var_dump($x);

            if (password_verify($clave, $x)) {
                return $myrow['TipoDeUsuario'];
            } else {
                return 'NOT_FOUND';
            }
        }
    }