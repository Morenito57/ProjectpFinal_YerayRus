<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);
    class UsuarioAccesoDatos {	
        function __construct() {
        }

        function insertar($usuario, $clave, $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI, $telefono, $email, $otro) {
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta1 = mysqli_prepare($conexion, "INSERT INTO DatosPersonales(Nombre, Apellidos, FechaNacimiento, Direccion, DNI) VALUES (?,?,?,?,?);");
            $consulta1->bind_param("sssss", $usuario, $apellidos, $fechaNacimiento, $direccion, $DNI);
            $consulta1->execute();

            $DatosPersonales_id = $conexion->insert_id;

            $consulta2 = mysqli_prepare($conexion, "INSERT INTO DatosContacto(Telefono, Email, Otro) VALUES (?,?,?);");
            $consulta2->bind_param("iss", $telefono, $email, $otro);
            $consulta2->execute();

            $DatosContacto_id = $conexion->insert_id;

            $saldo = 0;
            $tipoUsuario = 'Normal';

            $consulta3 = mysqli_prepare($conexion, "INSERT INTO Usuario(NombreUsuario, IdDatosContacto, IdDatosPersonales, Saldo, Clave, TipoDeUsuario) VALUES (?,?,?,?,?,?);");
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            $consulta3->bind_param("siiiss", $usuario, $DatosPersonales_id, $DatosContacto_id, $saldo, $hash, $tipoUsuario);
            $res = $consulta3->execute();
            
            return $res;
        }

        function verificar($usuario,$clave) {

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "SELECT NombreUsuario, Clave, TipoDeUsuario, Activo FROM Usuario WHERE NombreUsuario = ?;");

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

            if (!$myrow['Activo']) {
                return 'NOT_FOUND';
            }
        
            if (password_verify($clave, $x)) {
                return $myrow['TipoDeUsuario'];
            } else {
                return 'NOT_FOUND';
            }
        }

        function obtenerUsuario($usuario){
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'LegendaryMotorsport');
            $consulta1 = mysqli_prepare($conexion, "SELECT Usuario.NombreUsuario AS Usuario, Usuario.Clave AS Clave, Usuario.Saldo AS Saldo, Usuario.TipoDeUsuario AS TipoUsuario, Activo, DatosPersonales.Nombre AS Nombre, DatosPersonales.Apellidos AS Apellidos, DatosPersonales.FechaNacimiento AS FechaNacimiento, DatosPersonales.Direccion AS Direccion, DatosPersonales.DNI AS DNI, DatosContacto.Telefono AS Telefono, DatosContacto.Email AS Email, DatosContacto.Otro AS Otro, IdDatosContacto, IdDatosPersonales FROM Usuario INNER JOIN DatosPersonales ON Usuario.IdDatosPersonales = DatosPersonales.Id INNER JOIN DatosContacto ON Usuario.IdDatosContacto = DatosContacto.Id WHERE Usuario.NombreUsuario like (?);");
            $consulta1->bind_param("s", $usuario);
            $consulta1->execute();
            $result = $consulta1->get_result();

            $usuarios =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($usuarios,$myrow);
    
            }

            return $usuarios;
        }

        function obtenerAllUsuario(){
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'LegendaryMotorsport');
            $consulta1 = mysqli_prepare($conexion, "SELECT Usuario.NombreUsuario AS Usuario, Usuario.Clave AS Clave, Usuario.Saldo AS Saldo, Usuario.TipoDeUsuario AS TipoUsuario, Activo, DatosPersonales.Nombre AS Nombre, DatosPersonales.Apellidos AS Apellidos, DatosPersonales.FechaNacimiento AS FechaNacimiento, DatosPersonales.Direccion AS Direccion, DatosPersonales.DNI AS DNI, DatosContacto.Telefono AS Telefono, DatosContacto.Email AS Email, DatosContacto.Otro AS Otro, IdDatosContacto, IdDatosPersonales FROM Usuario INNER JOIN DatosPersonales ON Usuario.IdDatosPersonales = DatosPersonales.Id INNER JOIN DatosContacto ON Usuario.IdDatosContacto = DatosContacto.Id;");
            $consulta1->execute();
            $result = $consulta1->get_result();

            $usuarios =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($usuarios,$myrow);
    
            }

            return $usuarios;
        }

        function actualizarUsuario($usuarioOriginal,$usuario, $clave, $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI, $telefono, $email, $otro, $IdDatosContacto, $IdDatosPersonales) {
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            if ($usuario !== null && $usuario !== '') {

                mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=0;");

                $consulta2 = mysqli_prepare($conexion,"UPDATE Usuario SET NombreUsuario = ? WHERE NombreUsuario = ?;");
                $consulta2->bind_param("ss",$usuario,$usuarioOriginal);
                $consulta2->execute();

                session_start();
                $_SESSION['usuario'] = $usuario;

                $consulta1 = mysqli_prepare($conexion,"UPDATE Alquiler SET IdUser = ? WHERE IdUser = ?;");
                $consulta1->bind_param("ss",$usuario,$usuarioOriginal);
                $consulta1->execute();

                mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=1;");
            }
            
            if ($clave !== null && $clave !== '') {
                $consulta3 = mysqli_prepare($conexion,"UPDATE Usuario SET Clave = ? WHERE NombreUsuario = ?;");
                $hash = password_hash($clave, PASSWORD_DEFAULT);
                $consulta3->bind_param("ss",$hash,$usuarioOriginal);
                $consulta3->execute();
            }
            
            if ($nombre !== null && $nombre !== '') {
                $consulta4 = mysqli_prepare($conexion,"UPDATE DatosPersonales SET Nombre = ? WHERE Id IN (SELECT IdDatosPersonales FROM Usuario WHERE IdDatosPersonales = ?);");
                $consulta4->bind_param("ss",$nombre,$IdDatosPersonales);
                $consulta4->execute();
            }
            
            if ($apellidos !== null && $apellidos !== '') {
                $consulta4 = mysqli_prepare($conexion,"UPDATE DatosPersonales SET Apellidos = ? WHERE Id IN (SELECT IdDatosPersonales FROM Usuario WHERE IdDatosPersonales = ?);");
                $consulta4->bind_param("ss",$apellidos,$IdDatosPersonales);
                $consulta4->execute();
            }
            
            if ($fechaNacimiento !== null && $fechaNacimiento !== '' && strtotime($fechaNacimiento) !== false) {
                $consulta4 = mysqli_prepare($conexion,"UPDATE DatosPersonales SET FechaNacimiento = ? WHERE Id IN (SELECT IdDatosPersonales FROM Usuario WHERE IdDatosPersonales = ?);");
                $consulta4->bind_param("ss",$fechaNacimiento,$IdDatosPersonales);
                $consulta4->execute();
            }
            
            if ($direccion !== null && $direccion !== '') {
                $consulta4 = mysqli_prepare($conexion,"UPDATE DatosPersonales SET Direccion = ? WHERE Id IN (SELECT IdDatosPersonales FROM Usuario WHERE IdDatosPersonales = ?);");
                $consulta4->bind_param("ss",$direccion,$IdDatosPersonales);
                $consulta4->execute();
            }
            
            if ($DNI !== null && $DNI !== '') {
                $consulta4 = mysqli_prepare($conexion,"UPDATE DatosPersonales SET DNI = ? WHERE Id IN (SELECT IdDatosPersonales FROM Usuario WHERE IdDatosPersonales = ?);");
                $consulta4->bind_param("ss",$DNI,$IdDatosPersonales);
                $consulta4->execute();
            }
            
            if ($telefono !== null && $telefono !== '' || $email !== null && $email !== '' || $otro !== null && $otro !== '') {
                $consulta5 = mysqli_prepare($conexion,"UPDATE DatosContacto SET Telefono = ?, Email = ?, Otro = ? WHERE Id IN (SELECT IdDatosContacto FROM Usuario WHERE IdDatosContacto = ?);");
                $consulta5->bind_param("isss",$telefono,$email,$otro,$IdDatosContacto);
                $consulta5->execute();
            }
                    
            return header("Location: Area_Personal_Datos_Usuario_Vista.php");;
        }

        function actualizarSalsoUsuario($usuarioOriginal, $saldo) {

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta1 = mysqli_prepare($conexion,"UPDATE Usuario SET Saldo = Saldo + ? WHERE NombreUsuario = ?;");
            $consulta1->bind_param("is",$saldo,$usuarioOriginal);
            $res = $consulta1->execute();

            return $res;

        }

        function suspenderUsuario($usuarioOriginal) {

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');
            
            $consulta = mysqli_prepare($conexion, "UPDATE Usuario SET Activo = False WHERE NombreUsuario = ?;");
            $consulta->bind_param("s", $usuarioOriginal);
            $res = $consulta->execute();

            return $res;
        }

        function eliminarUsuario($Usuario, $idDatosContacto, $idDatosPersonales) {

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=0;");
    
            $consulta2 = mysqli_prepare($conexion, "DELETE FROM DatosContacto WHERE Id = ?");
            $consulta2->bind_param('i', $idDatosContacto);
            $consulta2->execute();
    
            $consulta3 = mysqli_prepare($conexion, "DELETE FROM DatosPersonales WHERE Id = ?");
            $consulta3->bind_param('i', $idDatosPersonales);
            $consulta3->execute();

            $consulta1 = mysqli_prepare($conexion, "DELETE FROM Usuario WHERE NombreUsuario = ?");
            $consulta1->bind_param('s', $nombreUsuario);
            $consulta1->execute();

            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=1;");

        }

        function deslogearse() {
            session_unset();
            session_destroy();
            header("Location: loginVista.php");
            exit();
    }
}