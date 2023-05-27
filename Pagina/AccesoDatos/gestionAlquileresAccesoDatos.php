<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class gestionAlquileresAccesoDatos{
    
        function __construct(){
        }

        function insertarAlquiler($IdUser, array $IdSeguro, array $IdExtra, $IdVehiculo, $FechaInicio, $FechaFinal, $TotalDelPrecio){

            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $estado = true;

            $IdVehiculo = mysqli_real_escape_string($conexion, $IdVehiculo);
            $FechaInicio = mysqli_real_escape_string($conexion, $FechaInicio);
            $FechaFinal = mysqli_real_escape_string($conexion, $FechaFinal);
            $TotalDelPrecio = mysqli_real_escape_string($conexion, $TotalDelPrecio);

            $consultaSaldo = mysqli_prepare($conexion, "SELECT Saldo FROM Usuario WHERE NombreUsuario = ?;");
            $consultaSaldo->bind_param("s", $IdUser);
            $consultaSaldo->execute();

            $resSaldo = $consultaSaldo->get_result();
            $filaSaldo = $resSaldo->fetch_assoc();
            $saldoActual = $filaSaldo['Saldo'];

            if ($saldoActual < $TotalDelPrecio) {
                $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                $url = "$protocolo://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                header("Location: Area_Personal_Saldo_Usuario_Vista.php");
                exit();
            }

            $consulta = mysqli_prepare($conexion, "INSERT INTO Alquiler (IdUser, IdVehiculo, FechaInicio, FechaFinal, TotalDelPrecio, Estado) VALUES (?,?,?,?,?,?);");
            $consulta->bind_param("sissii", $IdUser, $IdVehiculo, $FechaInicio, $FechaFinal, $TotalDelPrecio, $estado);
            $consulta->execute();

            $alquiler_id = $conexion->insert_id;
            
            $consulta2 = mysqli_prepare($conexion, "INSERT INTO Cargo (Alquiler_id, FechaDevuelto, TotalCargo, Pagado, Activo) VALUES (?, NULL, NULL, NULL, NULL)");
            $consulta2->bind_param("i", $alquiler_id);
            $consulta2->execute();

            $consulta3 = mysqli_prepare($conexion, "INSERT INTO Alquiler_Seguro (Alquiler_id, Seguro_id) VALUES (?, ?)");
                foreach ($IdSeguro as $Seguro) {
                    $Seguro = mysqli_real_escape_string($conexion, $Seguro);
                    $consulta3->bind_param("ii", $alquiler_id, $Seguro);
                    $consulta3->execute();
                }

            $consulta4 = mysqli_prepare($conexion, "INSERT INTO Alquiler_Extra (Alquiler_id, Extra_id) VALUES (?, ?)");
                foreach ($IdExtra as $Extra) {  
                    $Extra = mysqli_real_escape_string($conexion, $Extra);        
                    $consulta4->bind_param("ii", $alquiler_id, $Extra);
                    $consulta4->execute();
                }
            

            $consulta5 = mysqli_prepare($conexion, "UPDATE Vehiculo set Estado = false WHERE Id = (?);");
            $consulta5->bind_param("i", $IdVehiculo);
            $consulta5->execute();

            $consulta6 = mysqli_prepare($conexion, "UPDATE Usuario set Saldo = Saldo - (?) WHERE NombreUsuario = (?);");
            $consulta6->bind_param("is", $TotalDelPrecio, $IdUser);
            $consulta6->execute();

            return header("Location: Inicio_Con_Loggin.php");
        }

        function obtener(){

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $usuarioOriginal = $_SESSION['usuario'];

            $consulta = mysqli_prepare($conexion, "SELECT Alquiler.Id AS IdAlquiler, Vehiculo.Nombre AS NombreVehiculo, Vehiculo.Precio AS PrecioVehiculo, Alquiler.FechaInicio, Alquiler.FechaFinal, Cargo.FechaDevuelto, GROUP_CONCAT(DISTINCT Seguros.Seguro) AS Seguros, GROUP_CONCAT(DISTINCT Extras.Extra) AS Extras, Alquiler.TotalDelPrecio, Cargo.Id AS IdCargo, Cargo.TotalCargo, Alquiler.Estado AS ActivoAlquiler, Cargo.Pagado, Cargo.Activo AS ActivoCargo FROM Alquiler LEFT JOIN Vehiculo ON Alquiler.IdVehiculo = Vehiculo.Id LEFT JOIN Cargo ON Alquiler.Id = Cargo.Alquiler_id LEFT JOIN Alquiler_Seguro ON Alquiler.Id = Alquiler_Seguro.Alquiler_id LEFT JOIN Seguros ON Alquiler_Seguro.Seguro_id = Seguros.Id LEFT JOIN Alquiler_Extra ON Alquiler.Id = Alquiler_Extra.Alquiler_id LEFT JOIN Extras ON Alquiler_Extra.Extra_id = Extras.Id WHERE Alquiler.IdUser = ? GROUP BY Alquiler.Id;");
            
            $consulta->bind_param("s", $usuarioOriginal);
            $consulta->execute();
            $result = $consulta->get_result();
    
            $alquileres =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($alquileres,$myrow);
    
            }
            return $alquileres;
        }

        function actualizarAlquiler($usuario, $IdAlquiler, $FechaFinal, $TotalPago) {

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $IdAlquiler = mysqli_real_escape_string($conexion, $IdAlquiler);
            $FechaFinal = mysqli_real_escape_string($conexion, $FechaFinal);
            $TotalPago = mysqli_real_escape_string($conexion, $TotalPago);

            $consultaSaldo = mysqli_prepare($conexion, "SELECT Saldo FROM Usuario WHERE NombreUsuario = ?;");
            $consultaSaldo->bind_param("s", $usuario);
            $consultaSaldo->execute();

            $resSaldo = $consultaSaldo->get_result();
            $filaSaldo = $resSaldo->fetch_assoc();
            $saldoActual = $filaSaldo['Saldo'];

            if ($saldoActual < $TotalPago) {
                $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                $url = "$protocolo://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                header("Location: Area_Personal_Saldo_Usuario_Vista.php");
                exit();
            }

            $consulta2 = mysqli_prepare($conexion, "UPDATE Usuario set Saldo = Saldo - (?) WHERE NombreUsuario = (?);");
            $consulta2->bind_param("is", $TotalPago, $usuario);
            $consulta2->execute();

            $consulta3 = mysqli_prepare($conexion, "UPDATE Alquiler set FechaFinal = ? WHERE Id = (?);");
            $consulta3->bind_param("si", $FechaFinal, $IdAlquiler);
            $consulta3->execute();

            $consulta4 = mysqli_prepare($conexion, "UPDATE Alquiler set TotalDelPrecio = TotalDelPrecio + ? WHERE Id = (?);");
            $consulta4->bind_param("ii", $TotalPago, $IdAlquiler);
            $consulta4->execute();

            header("Location: Area_Personal_Gestion_Alquiler_Usuario_Vista.php?id=".urlencode($IdAlquiler));

        }

        function obtenerAlquiler($id) {

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "SELECT Alquiler.Id AS IdAlquiler, Vehiculo.Nombre AS NombreVehiculo, Vehiculo.Precio AS PrecioVehiculo, Alquiler.FechaInicio, Alquiler.FechaFinal, Cargo.FechaDevuelto, GROUP_CONCAT(DISTINCT Seguros.Seguro) AS Seguros, GROUP_CONCAT(DISTINCT Extras.Extra) AS Extras, Alquiler.TotalDelPrecio, Cargo.Id AS IdCargo, Cargo.TotalCargo, Alquiler.Estado AS ActivoAlquiler, Cargo.Pagado, Cargo.Activo AS ActivoCargo FROM Alquiler LEFT JOIN Vehiculo ON Alquiler.IdVehiculo = Vehiculo.Id LEFT JOIN Cargo ON Alquiler.Id = Cargo.Alquiler_id LEFT JOIN Alquiler_Seguro ON Alquiler.Id = Alquiler_Seguro.Alquiler_id LEFT JOIN Seguros ON Alquiler_Seguro.Seguro_id = Seguros.Id LEFT JOIN Alquiler_Extra ON Alquiler.Id = Alquiler_Extra.Alquiler_id LEFT JOIN Extras ON Alquiler_Extra.Extra_id = Extras.Id WHERE Alquiler.Id = ? GROUP BY Alquiler.Id;");
            
            $consulta->bind_param("s", $id);
            $consulta->execute();
            $result = $consulta->get_result();
    
            $alquileres =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($alquileres,$myrow);
    
            }
            return $alquileres;
            exit();
        }

        function actualizacion(){

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "SELECT Alquiler.Id AS IdAlquiler, Vehiculo.Nombre AS NombreVehiculo, Vehiculo.Precio AS PrecioVehiculo, Alquiler.FechaInicio, Alquiler.FechaFinal, Cargo.FechaDevuelto, GROUP_CONCAT(DISTINCT Seguros.Seguro) AS Seguros, GROUP_CONCAT(DISTINCT Extras.Extra) AS Extras, Alquiler.TotalDelPrecio, Cargo.Id AS IdCargo, Cargo.TotalCargo, Alquiler.Estado AS ActivoAlquiler, Cargo.Pagado, Cargo.Activo AS ActivoCargo FROM Alquiler LEFT JOIN Vehiculo ON Alquiler.IdVehiculo = Vehiculo.Id LEFT JOIN Cargo ON Alquiler.Id = Cargo.Alquiler_id LEFT JOIN Alquiler_Seguro ON Alquiler.Id = Alquiler_Seguro.Alquiler_id LEFT JOIN Seguros ON Alquiler_Seguro.Seguro_id = Seguros.Id LEFT JOIN Alquiler_Extra ON Alquiler.Id = Alquiler_Extra.Alquiler_id LEFT JOIN Extras ON Alquiler_Extra.Extra_id = Extras.Id;");
            $consulta->execute();
            $result = $consulta->get_result();
    
            $alquileres =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($alquileres,$myrow);
    
            }
            return $alquileres;
        }


    }
?>