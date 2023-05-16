<?php
    class VehiculosAccesoDatos{
    
        function __construct(){
        }

        function obtener(){
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
             mysqli_select_db($conexion, 'LegendaryMotorsport');

             if(array_key_exists("orden", $_GET)){
                if($_GET["orden"] == 1){
                    $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo order by Precio DESC;");
                }if($_GET["orden"] == 2){
                    $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo order by Precio;");
                }
             }else{
             $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo;");
             }
             $consulta->execute();
            $result = $consulta->get_result();
    
            $vehiculos =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($vehiculos,$myrow);
    
            }
            return $vehiculos;
        }

    }
?>