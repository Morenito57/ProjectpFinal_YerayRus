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

            $consulta = mysqli_prepare($conexion, "INSERT INTO Alquiler (IdUser, IdVehiculo, FechaInicio, FechaFinal, TotalDelPrecio, Estado) VALUES (?,?,?,?,?,?);");
            $consulta->bind_param("sissii", $IdUser, $IdVehiculo, $FechaInicio, $FechaFinal, $TotalDelPrecio, $estado);
            $consulta->execute();

            $alquiler_id = $conexion->insert_id;
            
            $consulta2 = mysqli_prepare($conexion, "INSERT INTO Cargo (Alquiler_id, FechaDevuelto, TotalCargo, Pagado, Activo) VALUES (?, NULL, NULL, NULL, NULL)");
            $consulta2->bind_param("i", $alquiler_id);
            $consulta2->execute();

            $consulta3 = mysqli_prepare($conexion, "INSERT INTO Alquiler_Seguro (Alquiler_id, Seguro_id) VALUES (?, ?)");
                foreach ($IdSeguro as $Seguro) {
                    $consulta3->bind_param("ii", $alquiler_id, $Seguro);
                    $consulta3->execute();
                }

            $consulta4 = mysqli_prepare($conexion, "INSERT INTO Alquiler_Extra (Alquiler_id, Extra_id) VALUES (?, ?)");
                foreach ($IdExtra as $Extra) {          
                    $consulta4->bind_param("ii", $alquiler_id, $Extra);
                    $consulta4->execute();
                }
            

            $consulta5 = mysqli_prepare($conexion, "UPDATE Vehiculo set Estado = false WHERE Id = (?);");
            $consulta5->bind_param("i", $IdVehiculo);
            $consulta5->execute();

            $consulta6 = mysqli_prepare($conexion, "UPDATE Usuario set Saldo = Saldo - (?) WHERE NombreUsuario = (?);");
            $consulta6->bind_param("is", $TotalDelPrecio, $IdUser);
            $consulta6->execute();

            $result = $consulta->get_result();
            return $result;
        }
    }
?>