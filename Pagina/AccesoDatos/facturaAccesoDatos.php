<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class FacturaAccesoDatos{
    
        function __construct(){
        }

        function obtener($idUsuario, $idAlquiler){

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $idAlquiler = mysqli_real_escape_string($conexion, $idAlquiler);
            $idUsuario = mysqli_real_escape_string($conexion, $idUsuario);

            $consulta = mysqli_prepare($conexion, "SELECT Alquiler.Id AS AlquilerId, Alquiler.IdUser AS UserId, Alquiler.IdVehiculo AS VehiculoId, Alquiler.FechaInicio AS FechaInicio, Alquiler.FechaFinal AS FechaFinal, Alquiler.TotalDelPrecio AS TotalDelPrecio, TipoVehiculo.TipoVehiculo AS TipoVehiculo, Vehiculo.Imagen AS VehiculoImagen, Vehiculo.Marca AS Marca, Vehiculo.Nombre AS VehiculoNombre, Vehiculo.Matricula AS Matricula, Vehiculo.Caballos AS Caballos, Vehiculo.Kilometros AS Kilometros, Vehiculo.Plazas AS Plazas, Vehiculo.Año AS VehiculoAño, Vehiculo.Precio AS VehiculoPrecio, Vehiculo.Estado AS VehiculoEstado, Vehiculo.Descripcion AS VehiculoDescripcion, GROUP_CONCAT(DISTINCT Extras.Extra SEPARATOR ', ') AS ExtrasNombre, GROUP_CONCAT(DISTINCT Extras.Precio SEPARATOR ', ') AS ExtrasPrecio, GROUP_CONCAT(DISTINCT Seguros.Seguro SEPARATOR ', ') AS SegurosNombre, GROUP_CONCAT(DISTINCT Seguros.Precio SEPARATOR ', ') AS SegurosPrecio FROM Alquiler JOIN Vehiculo ON Alquiler.IdVehiculo = Vehiculo.Id JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id LEFT JOIN Alquiler_Extra ON Alquiler.Id = Alquiler_Extra.Alquiler_id LEFT JOIN Extras ON Alquiler_Extra.Extra_id = Extras.Id LEFT JOIN Alquiler_Seguro ON Alquiler.Id = Alquiler_Seguro.Alquiler_id LEFT JOIN Seguros ON Alquiler_Seguro.Seguro_id = Seguros.Id WHERE Alquiler.Id = ? AND Alquiler.IdUser = ? GROUP BY Alquiler.Id;");
            $consulta->bind_param("is",$idAlquiler,$idUsuario);
            $consulta->execute();
            $result = $consulta->get_result();
    
            $facturas =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($facturas,$myrow);
    
            }
            return $facturas;
            mysqli_close($conexion);
            exit();
        }
    }
?>