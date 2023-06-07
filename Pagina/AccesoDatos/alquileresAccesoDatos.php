<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class AlquileresAccesoDatos{
    
        function __construct(){
        }

        function obtener(){

            $conexion = mysqli_connect('localhost','root','1234');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "SELECT Alquiler.Id AS IdAlquiler, Alquiler.IdUser as IdUser, Alquiler.IdVehiculo as IdVehiculo, Cargo.Id AS IdCargo, GROUP_CONCAT(DISTINCT Seguros.Id) AS IdSeguros, GROUP_CONCAT(DISTINCT Extras.Id) AS IdExtras, Alquiler.FechaInicio as FechaInicio, Alquiler.FechaFinal as FechaFinal, Alquiler.TotalDelPrecio as TotalDelPrecio, Alquiler.Estado AS Estado FROM Alquiler LEFT JOIN Alquiler_Seguro ON Alquiler.Id = Alquiler_Seguro.Alquiler_id LEFT JOIN Cargo ON Alquiler.Id = Cargo.Alquiler_id LEFT JOIN Seguros ON Alquiler_Seguro.Seguro_id = Seguros.Id LEFT JOIN Alquiler_Extra ON Alquiler.Id = Alquiler_Extra.Alquiler_id LEFT JOIN Extras ON Alquiler_Extra.Extra_id = Extras.Id GROUP BY Alquiler.Id, Cargo.Id;");
            $consulta->execute();
            $result = $consulta->get_result();
    
            $alquileres =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($alquileres,$myrow);
    
            }
            return $alquileres;
            mysqli_close($conexion);
            exit();
        }

        function obtenerAlquiler($id){

            $conexion = mysqli_connect('localhost','root','1234');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);

            $consulta = mysqli_prepare($conexion, "SELECT Alquiler.Id AS IdAlquiler, Alquiler.IdUser as IdUser, Alquiler.IdVehiculo as IdVehiculo, Cargo.Id AS IdCargo, GROUP_CONCAT(DISTINCT Seguros.Id) AS IdSeguros, GROUP_CONCAT(DISTINCT Extras.Id) AS IdExtras, Alquiler.FechaInicio as FechaInicio, Alquiler.FechaFinal as FechaFinal, Alquiler.TotalDelPrecio as TotalDelPrecio, Alquiler.Estado AS Estado FROM Alquiler LEFT JOIN Alquiler_Seguro ON Alquiler.Id = Alquiler_Seguro.Alquiler_id LEFT JOIN Cargo ON Alquiler.Id = Cargo.Alquiler_id LEFT JOIN Seguros ON Alquiler_Seguro.Seguro_id = Seguros.Id LEFT JOIN Alquiler_Extra ON Alquiler.Id = Alquiler_Extra.Alquiler_id LEFT JOIN Extras ON Alquiler_Extra.Extra_id = Extras.Id where Alquiler.Id = ? GROUP BY Alquiler.Id, Cargo.Id;");
            $consulta->bind_param('i', $id);
            $consulta->execute();
            $result = $consulta->get_result();
    
            $alquileres =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($alquileres,$myrow);
    
            }
            return $alquileres;
            mysqli_close($conexion);
            exit();
        }

        function eliminarAlquiler($id) {

            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);

            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=0;");
    
            $consulta1 = mysqli_prepare($conexion, "DELETE FROM Alquiler WHERE Id = ?");
            $consulta1->bind_param('i', $id);
            $consulta1->execute();
    
            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=1;");

            echo "<script type='text/javascript'>alert('Se ha eliminado con exito.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Administrador_Alquileres.php';</script>";

            mysqli_close($conexion);
            exit();

        }

        function actualizarAlquiler($id, $estado) {

            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);

            if ($estado !== '') {
                if ($estado === Null || $estado == "Null" || $estado == "null" || $estado === null) {
                    $estado = mysqli_real_escape_string($conexion, $estado);
                    $consulta1 = mysqli_prepare($conexion,"UPDATE Alquiler SET Estado = Null WHERE Id = ?;");
                    $consulta1->bind_param("i",$id);
                    $consulta1->execute();
                }else{
                    $estado = mysqli_real_escape_string($conexion, $estado);
                    $consulta1 = mysqli_prepare($conexion,"UPDATE Alquiler SET Estado = ? WHERE Id = ?;");
                    $consulta1->bind_param("si",$estado,$id);
                    $consulta1->execute();
                }

            }

            echo "<script type='text/javascript'>alert('El saldo actual es insuficiente.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Administrador_Alquileres.php';</script>";

            mysqli_close($conexion);
            exit();
        }


    }
?>