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

            $usuario = mysqli_real_escape_string($conexion, $usuario);
            $clave = mysqli_real_escape_string($conexion, $clave);
            $nombre = mysqli_real_escape_string($conexion, $nombre);
            $apellidos = mysqli_real_escape_string($conexion, $apellidos);
            $fechaNacimiento = mysqli_real_escape_string($conexion, $fechaNacimiento);
            $direccion = mysqli_real_escape_string($conexion, $direccion);
            $DNI = mysqli_real_escape_string($conexion, $DNI);
            $telefono = mysqli_real_escape_string($conexion, $telefono);
            $email = mysqli_real_escape_string($conexion, $email);
            $otro = mysqli_real_escape_string($conexion, $otro);


            $consulta = mysqli_prepare($conexion, "SELECT COUNT(*) FROM Usuario WHERE NombreUsuario COLLATE utf8mb4_general_ci = ?;");
            $consulta->bind_param("s", $usuario);
            $consulta->execute();
            $result = $consulta->get_result();
            $row = $result->fetch_row();
            if ($row[0] > 0) {
                echo "<script type='text/javascript'>alert('Este nombre de usuario ya existe, por favor elige otro.');</script>";
                echo "<script type='text/javascript'>window.location.href = 'loginVista.php';</script>";
                mysqli_close($conexion);
                exit();
            }

            $consulta1 = mysqli_prepare($conexion, "INSERT INTO DatosPersonales(Nombre, Apellidos, FechaNacimiento, Direccion, DNI) VALUES (?,?,?,?,?);");
            $consulta1->bind_param("sssss", $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI);
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
            echo "<script type='text/javascript'>alert('Se ha creado con exito el usuario.');</script>";
            echo "<script type='text/javascript'>window.location.href = 'loginVista.php';</script>";


            mysqli_close($conexion);
            return $res;
        }

        function verificar($usuario,$clave) {

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $usuario = mysqli_real_escape_string($conexion, $usuario);
            $clave = mysqli_real_escape_string($conexion, $clave);

            $consulta = mysqli_prepare($conexion, "SELECT NombreUsuario, Clave, TipoDeUsuario, Activo FROM Usuario WHERE NombreUsuario = ?;");

            $sanitized_usuario = mysqli_real_escape_string($conexion, $usuario);       
            $consulta->bind_param("s", $sanitized_usuario);
            $consulta->execute();

            $res = $consulta->get_result();

            if ($res->num_rows==0) {
                return 'NOT_FOUND';
                mysqli_close($conexion);
                exit();
            }

            if ($res->num_rows>1) {
                return 'NOT_FOUND';
                mysqli_close($conexion);
                exit();
            }

            $myrow = $res->fetch_assoc();
            $x = $myrow['Clave'];

            if (!$myrow['Activo']) {
                return 'NOT_FOUND';
                mysqli_close($conexion);
                exit();
            }
        
            if (password_verify($clave, $x)) {
                return $myrow['TipoDeUsuario'];
            } else {
                return 'NOT_FOUND';
                mysqli_close($conexion);
                exit();
            }
        }

        function obtenerUsuario($usuario){

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            $usuario = mysqli_real_escape_string($conexion, $usuario);

            mysqli_select_db($conexion, 'LegendaryMotorsport');
            $consulta1 = mysqli_prepare($conexion, "SELECT Usuario.NombreUsuario AS Usuario, Usuario.Clave AS Clave, Usuario.Saldo AS Saldo, Usuario.TipoDeUsuario AS TipoUsuario, Usuario.Activo as Activo, DatosPersonales.Nombre AS Nombre, DatosPersonales.Apellidos AS Apellidos, DatosPersonales.FechaNacimiento AS FechaNacimiento, DatosPersonales.Direccion AS Direccion, DatosPersonales.DNI AS DNI, DatosContacto.Telefono AS Telefono, DatosContacto.Email AS Email, DatosContacto.Otro AS Otro, Usuario.IdDatosContacto as IdDatosContacto, Usuario.IdDatosPersonales as IdDatosPersonales FROM Usuario INNER JOIN DatosPersonales ON Usuario.IdDatosPersonales = DatosPersonales.Id INNER JOIN DatosContacto ON Usuario.IdDatosContacto = DatosContacto.Id WHERE Usuario.NombreUsuario like (?);");
            $consulta1->bind_param("s", $usuario);
            $consulta1->execute();
            $result = $consulta1->get_result();

            $usuarios =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($usuarios,$myrow);
    
            }

            return $usuarios;
            mysqli_close($conexion);
            exit();
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

            mysqli_close($conexion);

            exit();
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


            echo "<script type='text/javascript'>alert('Se ha efectuado la actualizacion con exito.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Area_Personal_Datos_Usuario_Vista.php';</script>";

            return $res;

            mysqli_close($conexion);

            exit();
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

            echo "<script type='text/javascript'>alert('Se ha efectuado la transaccion con exito.');</script>";

            return $res;

            mysqli_close($conexion);

            exit();

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

            echo "<script type='text/javascript'>alert('Se ha suspendido con exito.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'loginVista.php';</script>";

            return $res;

            mysqli_close($conexion);

            exit();
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

            echo "<script type='text/javascript'>alert('Se ha suspendido con exito.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Administrador_Usuarios.php';</script>";

            mysqli_close($conexion);
            exit();

        }

    function deslogearse() {
        session_unset();
        session_destroy();
        echo "<script type='text/javascript'>alert('Ha cerrado sesion con exito.');</script>";

        echo "<script type='text/javascript'>window.location.href = 'loginVista.php';</script>";
        exit();
    }

    function actualizarUsuarioComoAdmin($usuarioOriginal, $usuario, $saldo, $clave, $tipoDeUsuario, $activo, $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI, $telefono, $email, $otro, $IdDatosContacto, $IdDatosPersonales) {
        $conexion = mysqli_connect('localhost','root','');

        if (mysqli_connect_errno()) {
            echo "Error al conectar a MySQL: ". mysqli_connect_error();
        }
        
        mysqli_select_db($conexion, 'LegendaryMotorsport');

        $IdDatosContacto = mysqli_real_escape_string($conexion, (int)$IdDatosContacto);
        $IdDatosPersonales = mysqli_real_escape_string($conexion, (int)$IdDatosPersonales);

        if ($usuario !== null && $usuario !== '') {

            $usuario = mysqli_real_escape_string($conexion, $usuario);

            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=0;");

            $consulta2 = mysqli_prepare($conexion,"UPDATE Usuario SET NombreUsuario = ? WHERE NombreUsuario = ?;");
            $consulta2->bind_param("ss",$usuario,$usuarioOriginal);
            $consulta2->execute();

            $consulta1 = mysqli_prepare($conexion,"UPDATE Alquiler SET IdUser = ? WHERE IdUser = ?;");
            $consulta1->bind_param("ss",$usuario,$usuarioOriginal);
            $consulta1->execute();

            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=1;");

        }

        if ($clave !== null && $clave !== '') {
            $clave = mysqli_real_escape_string($conexion, $clave);
            $consulta3 = mysqli_prepare($conexion,"UPDATE Usuario SET Clave = ? WHERE NombreUsuario = ?;");
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            $consulta3->bind_param("ss",$hash,$usuarioOriginal);
            $consulta3->execute();
        }

        if ($tipoDeUsuario !== null && $tipoDeUsuario !== '') {
            $tipoDeUsuario = mysqli_real_escape_string($conexion, $tipoDeUsuario);
            $consulta4 = mysqli_prepare($conexion,"UPDATE Usuario SET TipoDeUsuario = ? WHERE NombreUsuario = ?;");
            $consulta4->bind_param("ss",$tipoDeUsuario,$usuarioOriginal);
            $consulta4->execute();
        }

        if ($saldo !== null && $saldo !== '') {
            $saldo = mysqli_real_escape_string($conexion, $saldo);
            $saldo = intval($saldo);
            $consulta5 = mysqli_prepare($conexion,"UPDATE Usuario SET Saldo = Saldo + ? WHERE NombreUsuario = ?;");
            $consulta5->bind_param("is", $saldo, $usuarioOriginal);
            $consulta5->execute();
        }
        
        if ($activo !== null && $activo !== '') {
            $activo = mysqli_real_escape_string($conexion, $activo);
            $consulta6 = mysqli_prepare($conexion,"UPDATE Usuario SET Activo = ? WHERE NombreUsuario = ?;");
            $consulta6->bind_param("is",$activo,$usuarioOriginal);
            $consulta6->execute();
        }
          
        if ($nombre !== null && $nombre !== '') {
            $nombre = mysqli_real_escape_string($conexion, $nombre);
            $consulta7 = mysqli_prepare($conexion,"UPDATE DatosPersonales SET Nombre = ? WHERE Id IN (SELECT IdDatosPersonales FROM Usuario WHERE IdDatosPersonales = ?);");
            $consulta7->bind_param("ss",$nombre,$IdDatosPersonales);
            $consulta7->execute();
        }
        
        if ($apellidos !== null && $apellidos !== '') {
            $apellidos = mysqli_real_escape_string($conexion, $apellidos);
            $consulta8 = mysqli_prepare($conexion,"UPDATE DatosPersonales SET Apellidos = ? WHERE Id IN (SELECT IdDatosPersonales FROM Usuario WHERE IdDatosPersonales = ?);");
            $consulta8->bind_param("ss",$apellidos,$IdDatosPersonales);
            $consulta8->execute();
        }
        
        if ($fechaNacimiento !== null && $fechaNacimiento !== '' && strtotime($fechaNacimiento) !== false) {
            $fechaNacimiento = mysqli_real_escape_string($conexion, $fechaNacimiento);
            $consulta9 = mysqli_prepare($conexion,"UPDATE DatosPersonales SET FechaNacimiento = ? WHERE Id IN (SELECT IdDatosPersonales FROM Usuario WHERE IdDatosPersonales = ?);");
            $consulta9->bind_param("ss",$fechaNacimiento,$IdDatosPersonales);
            $consulta9->execute();
        }
        
        if ($direccion !== null && $direccion !== '') {
            $direccion = mysqli_real_escape_string($conexion, $direccion);
            $consulta10 = mysqli_prepare($conexion,"UPDATE DatosPersonales SET Direccion = ? WHERE Id IN (SELECT IdDatosPersonales FROM Usuario WHERE IdDatosPersonales = ?);");
            $consulta10->bind_param("ss",$direccion,$IdDatosPersonales);
            $consulta10->execute();
        }
        
        if ($DNI !== null && $DNI !== '') {
            $DNI = mysqli_real_escape_string($conexion, $DNI);
            $consulta11 = mysqli_prepare($conexion,"UPDATE DatosPersonales SET DNI = ? WHERE Id IN (SELECT IdDatosPersonales FROM Usuario WHERE IdDatosPersonales = ?);");
            $consulta11->bind_param("ss",$DNI,$IdDatosPersonales);
            $consulta11->execute();
        }
        
        if ($telefono !== null && $telefono !== '') {
            $telefono = mysqli_real_escape_string($conexion, $telefono);
            $consulta12 = mysqli_prepare($conexion,"UPDATE DatosContacto SET Telefono = ? WHERE Id IN (SELECT IdDatosContacto FROM Usuario WHERE IdDatosContacto = ?);");
            $consulta12->bind_param("ii",$telefono,$IdDatosContacto);
            $consulta12->execute();
        }

        if ($email !== null && $email !== '') {
            $email = mysqli_real_escape_string($conexion, $email);
            $consulta13 = mysqli_prepare($conexion,"UPDATE DatosContacto SET Email = ? WHERE Id IN (SELECT IdDatosContacto FROM Usuario WHERE IdDatosContacto = ?);");
            $consulta13->bind_param("si",$email,$IdDatosContacto);
            $consulta13->execute();
        }

        if ($otro !== null && $otro !== '') {
            $otro = mysqli_real_escape_string($conexion, $otro);
            $consulta14 = mysqli_prepare($conexion,"UPDATE DatosContacto SET Otro = ? WHERE Id IN (SELECT IdDatosContacto FROM Usuario WHERE IdDatosContacto = ?);");
            $consulta14->bind_param("si",$otro,$IdDatosContacto);
            $consulta14->execute();
        }

        echo "<script type='text/javascript'>alert('Se ha actualizado los datos con exito.');</script>";

        echo "<script type='text/javascript'>window.location.href = 'Administrador_Usuarios.php';</script>";

        mysqli_close($conexion);

        exit();

    }

    function insertarAdmin($usuario, $saldo, $clave, $tipoDeUsuario, $activo, $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI, $telefono, $email, $otro) {
        $conexion = mysqli_connect('localhost','root','');

        if (mysqli_connect_errno()) {
            echo "Error al conectar a MySQL: ". mysqli_connect_error();
        }
        
        mysqli_select_db($conexion, 'LegendaryMotorsport');

        $consulta1 = mysqli_prepare($conexion, "INSERT INTO DatosPersonales(Nombre, Apellidos, FechaNacimiento, Direccion, DNI) VALUES (?,?,?,?,?);");
        $consulta1->bind_param("sssss", $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI);
        $consulta1->execute();

        $DatosPersonales_id = $conexion->insert_id;

        $consulta2 = mysqli_prepare($conexion, "INSERT INTO DatosContacto(Telefono, Email, Otro) VALUES (?,?,?);");
        $consulta2->bind_param("iss", $telefono, $email, $otro);
        $consulta2->execute();

        $DatosContacto_id = $conexion->insert_id;

        $consulta3 = mysqli_prepare($conexion, "INSERT INTO Usuario(NombreUsuario, IdDatosContacto, IdDatosPersonales, Saldo, Clave, TipoDeUsuario, Activo) VALUES (?,?,?,?,?,?,?);");
        $hash = password_hash($clave, PASSWORD_DEFAULT);
        $consulta3->bind_param("siiissi", $usuario, $DatosPersonales_id, $DatosContacto_id, $saldo, $hash, $tipoDeUsuario, $activo);
        $res = $consulta3->execute();

        echo "<script type='text/javascript'>alert('Se ha insertado los datos con exito.');</script>";

        echo "<script type='text/javascript'>window.location.href = 'Administrador_Usuarios.php';</script>";
        
        mysqli_close($conexion);
        exit();
    }
    
}