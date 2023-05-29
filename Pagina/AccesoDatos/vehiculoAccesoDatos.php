<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class VehiculosAccesoDatos{
    
        function __construct(){
        }

        function obtener(){

            $conexion = mysqli_connect('localhost','root','');
           
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
       
            mysqli_select_db($conexion, 'LegendaryMotorsport');
           
            $tipoVehiculo = filter_input(INPUT_GET, 'tipoVehiculo', FILTER_SANITIZE_NUMBER_INT);
            $tipoVehiculo = intval($tipoVehiculo);
                 
            $orden = filter_input(INPUT_GET, 'orden', FILTER_SANITIZE_NUMBER_INT);
            $orden = intval($orden);
       
            if($tipoVehiculo && $orden){
                $consultaCount = mysqli_prepare($conexion, "SELECT COUNT(*) as total FROM TipoVehiculo");
                mysqli_stmt_execute($consultaCount);
                $result = mysqli_stmt_get_result($consultaCount);
                $columna = $result->fetch_assoc();
                $total = $columna['total'];

                if($tipoVehiculo >= 1 && $tipoVehiculo <= $total){
                    if($orden == 1){
                        $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo where IdTipoVehiculo = ? order by Precio DESC;");
                        mysqli_stmt_bind_param($consulta, 'i', $tipoVehiculo);
                    }else if($orden == 2){
                        $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo where IdTipoVehiculo = ? order by Precio;");
                        mysqli_stmt_bind_param($consulta, 'i', $tipoVehiculo);
                    }else{
                        $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo;");
                    }
                }else{
                    $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo;");
                }
            }else if($tipoVehiculo){
           
                    $consultaCount = mysqli_prepare($conexion, "SELECT COUNT(*) as total FROM TipoVehiculo");
                    mysqli_stmt_execute($consultaCount);
                    $result = mysqli_stmt_get_result($consultaCount);
                    $columna = $result->fetch_assoc();
                    $total = $columna['total'];
           
                    if($tipoVehiculo >= 1 && $tipoVehiculo <= $total){
                        $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo WHERE IdTipoVehiculo = ?");
                        mysqli_stmt_bind_param($consulta, 'i', $tipoVehiculo);
                    } else {
                        $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo");
                    }  


            }else if($orden){
                    if($orden == 1){
                        $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo order by Precio DESC;");
                    }else if($orden == 2){
                        $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo order by Precio;");
                    }else{
                        $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo;");
                    }
            }else{
                    $consulta = mysqli_prepare($conexion, "SELECT Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion FROM Vehiculo;");
            }
           
                mysqli_stmt_execute($consulta);
                $result = mysqli_stmt_get_result($consulta);
               
                $vehiculos =  array();
               
                while ($myrow = mysqli_fetch_assoc($result))
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