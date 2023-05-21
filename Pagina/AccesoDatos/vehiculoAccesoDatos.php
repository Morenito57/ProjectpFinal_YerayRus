<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
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

             if(array_key_exists("tipoVehiculo", $_GET) && array_key_exists("orden", $_GET)){
                if($_GET["orden"] == 1){
                    $tipoVehiculo = $_GET['tipoVehiculo'];
                    $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo where IdTipoVehiculo = ".$tipoVehiculo." order by Precio DESC;");
                }else if($_GET["orden"] == 2){
                    $tipoVehiculo = $_GET['tipoVehiculo'];
                    $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo where IdTipoVehiculo = ".$tipoVehiculo." order by Precio;");
                }
             }else if(array_key_exists("tipoVehiculo", $_GET)){
                $tipoVehiculo = $_GET['tipoVehiculo'];
                $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo where IdTipoVehiculo = ".$tipoVehiculo.";");
             }else if(array_key_exists("orden", $_GET)){
                if($_GET["orden"] == 1){
                    $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo order by Precio DESC;");
                }else if($_GET["orden"] == 2){
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

        function obtenerVehiculoConcreto($id){
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, TipoVehiculo.TipoVehiculo as IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo INNER JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id where Vehiculo.Id = (?);");
            $consulta->bind_param("i",$id);
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