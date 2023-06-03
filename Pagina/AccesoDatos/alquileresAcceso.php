<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class AlquileresAccesoDatos{
    
        function __construct(){
        }

        function obtener(){

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "SELECT Alquiler.Id AS IdAlquiler, Alquiler.IdUser as IdUser, Alquiler.IdVehiculo as IdVehiculo, Cargo.Id AS IdCargo, GROUP_CONCAT(DISTINCT Seguros.Id) AS IdSeguros, GROUP_CONCAT(DISTINCT Extras.Id) AS IdExtras, Alquiler.FechaInicio as FechaInicio, Alquiler.FechaFinal as FechaFinal, Alquiler.TotalDelPrecio as TotalDelPrecio, Alquiler.Estado AS Estado FROM Alquiler LEFT JOIN Alquiler_Seguro ON Alquiler.Id = Alquiler_Seguro.Alquiler_id LEFT JOIN Cargo ON Alquiler.Id = Cargo.Alquiler_id LEFT JOIN Seguros ON Alquiler_Seguro.Seguro_id = Seguros.Id LEFT JOIN Alquiler_Extra ON Alquiler.Id = Alquiler_Extra.Alquiler_id LEFT JOIN Extras ON Alquiler_Extra.Extra_id = Extras.Id GROUP BY Alquiler.Id;");
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