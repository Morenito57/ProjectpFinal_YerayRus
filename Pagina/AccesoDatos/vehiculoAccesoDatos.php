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
            $tipoVehiculo = urldecode(intval($tipoVehiculo));
                 
            $orden = filter_input(INPUT_GET, 'orden', FILTER_SANITIZE_NUMBER_INT);
            $orden = urldecode(intval($orden));
       
            if($tipoVehiculo && $orden){
                $consultaCount = mysqli_prepare($conexion, "SELECT COUNT(*) as total FROM TipoVehiculo");
                mysqli_stmt_execute($consultaCount);
                $result = mysqli_stmt_get_result($consultaCount);
                $columna = $result->fetch_assoc();
                $total = $columna['total'];

                if($tipoVehiculo >= 1 && $tipoVehiculo <= $total){
                    if($orden == 1){
                        $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id where IdTipoVehiculo = ? order by Precio DESC;");
                        mysqli_stmt_bind_param($consulta, 'i', $tipoVehiculo);
                    }else if($orden == 2){
                        $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id where IdTipoVehiculo = ? order by Precio;");
                        mysqli_stmt_bind_param($consulta, 'i', $tipoVehiculo);
                    }else{
                        $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id;");
                    }
                }else{
                    $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id;");
                }
            }else if($tipoVehiculo){
           
                    $consultaCount = mysqli_prepare($conexion, "SELECT COUNT(*) as total FROM TipoVehiculo");
                    mysqli_stmt_execute($consultaCount);
                    $result = mysqli_stmt_get_result($consultaCount);
                    $columna = $result->fetch_assoc();
                    $total = $columna['total'];
           
                    if($tipoVehiculo >= 1 && $tipoVehiculo <= $total){
                        $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id WHERE IdTipoVehiculo = ?");
                        mysqli_stmt_bind_param($consulta, 'i', $tipoVehiculo);
                    } else {
                        $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id");
                    }  


            }else if($orden){
                    if($orden == 1){
                        $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id order by Precio DESC;");
                    }else if($orden == 2){
                        $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id order by Precio;");
                    }else{
                        $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id;");
                    }
            }else{
                    $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id;");
            }
           
                mysqli_stmt_execute($consulta);
                $result = mysqli_stmt_get_result($consulta);
               
                $vehiculos =  array();
               
                while ($myrow = mysqli_fetch_assoc($result))
                {
                    array_push($vehiculos,$myrow);
                }
                return $vehiculos;
                mysqli_close($conexion);
                exit();
        }

        function obtenerVehiculoConcreto($id){
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);

            $consulta = mysqli_prepare($conexion, "SELECT Vehiculo.Id as Id, IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion, TipoVehiculo.TipoVehiculo as TipoVehiculo FROM Vehiculo LEFT JOIN TipoVehiculo ON Vehiculo.IdTipoVehiculo = TipoVehiculo.Id where Vehiculo.Id = (?);");
            $consulta->bind_param("i",$id);
            $consulta->execute();
            $result = $consulta->get_result();

            $vehiculos =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($vehiculos,$myrow);
    
            }
            return $vehiculos;
            mysqli_close($conexion);
            exit();
        }

        function eliminarVehiculo($Vehiculo){

            $conexion = mysqli_connect('localhost','root','');
    
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
    
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $Vehiculo = mysqli_real_escape_string($conexion, $Vehiculo);
    
            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=0;");
    
            $consulta1 = mysqli_prepare($conexion, "DELETE FROM Vehiculo WHERE Id = ?");
            $consulta1->bind_param('i', $Vehiculo);
            $consulta1->execute();
    
            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=1;");

            echo "<script type='text/javascript'>alert('El vehiculo a sido eliminado.');</script>";
            echo "<script type='text/javascript'>window.location.href = 'Administrador_Vehiculos.php';</script>";

            mysqli_close($conexion);

            exit();

        }

        function actualizarVehiculoAdmin($idVehiculo, $nombre, $imagen, $marca, $matricula, $año, $caballos, $kilometros, $plazas, $estado, $precio, $descripcion, $idTipoVehiculo) {
        
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            if ($nombre !== null && $nombre !== '') {
                $nombre = mysqli_real_escape_string($conexion, $nombre);
                $consulta1 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Nombre = ? WHERE Id = ?;");
                $consulta1->bind_param("si",$nombre,$idVehiculo);
                $consulta1->execute();
            }

            if ($imagen !== null && $imagen !== '') {
                $imagen = mysqli_real_escape_string($conexion, $imagen);
                $consulta2 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Imagen = ? WHERE Id = ?;");
                $consulta2->bind_param("si",$imagen,$idVehiculo);
                $consulta2->execute();
            }

            if ($marca !== null && $marca !== '') {
                $marca = mysqli_real_escape_string($conexion, $marca);
                $consulta3 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Marca = ? WHERE Id = ?;");
                $consulta3->bind_param("si",$marca,$idVehiculo);
                $consulta3->execute();
            }

            if ($matricula !== null && $matricula !== '') {
                $matricula = mysqli_real_escape_string($conexion, $matricula);
                $consulta4 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Matricula = ? WHERE Id = ?;");
                $consulta4->bind_param("si",$matricula,$idVehiculo);
                $consulta4->execute();
            }
            if ($año !== null && $año !== '') {
                $año = mysqli_real_escape_string($conexion, $año);
                $consulta5 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Año = ? WHERE Id = ?;");
                $consulta5->bind_param("ii",$año,$idVehiculo);
                $consulta5->execute();
            }

            if ($caballos !== null && $caballos !== '') {
                $caballos = mysqli_real_escape_string($conexion, $caballos);
                $consulta6 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Caballos = ? WHERE Id = ?;");
                $consulta6->bind_param("ii",$caballos,$idVehiculo);
                $consulta6->execute();
            }
            if ($kilometros !== null && $kilometros !== '') {
                $kilometros = mysqli_real_escape_string($conexion, $kilometros);
                $consulta7 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Kilometros = ? WHERE Id = ?;");
                $consulta7->bind_param("ii",$kilometros,$idVehiculo);
                $consulta7->execute();
            }
            if ($plazas !== null && $plazas !== '') {
                $plazas = mysqli_real_escape_string($conexion, $plazas);
                $consulta8 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Plazas = ? WHERE Id = ?;");
                $consulta8->bind_param("ii",$plazas,$idVehiculo);
                $consulta8->execute();
            }
            if ($estado !== null && $estado !== '') {
                $estado = mysqli_real_escape_string($conexion, $estado);
                $consulta9 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Estado = ? WHERE Id = ?;");
                $consulta9->bind_param("ii",$estado,$idVehiculo);
                $consulta9->execute();
            }
            if ($precio !== null && $precio !== '') {
                $precio = mysqli_real_escape_string($conexion, $precio);
                $consulta10 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Precio = ? WHERE Id = ?;");
                $consulta10->bind_param("ii",$precio,$idVehiculo);
                $consulta10->execute();
            }
            
            if ($descripcion !== null && $descripcion !== '') {
                $descripcion = mysqli_real_escape_string($conexion, $descripcion);
                $consulta11 = mysqli_prepare($conexion,"UPDATE Vehiculo SET Descripcion = ? WHERE Id = ?;");
                $consulta11->bind_param("si",$descripcion,$idVehiculo);
                $consulta11->execute();
            }
            
            if ($idTipoVehiculo !== null && $idTipoVehiculo !== '') {
                $idTipoVehiculo = mysqli_real_escape_string($conexion, $idTipoVehiculo);
                $consulta12 = mysqli_prepare($conexion,"UPDATE Vehiculo SET IdTipoVehiculo = ? WHERE Id = ?;");
                $consulta12->bind_param("ii",$idTipoVehiculo,$idVehiculo);
                $consulta12->execute();
            }
            
            echo "<script type='text/javascript'>alert('El vehiculo a sido actualizado.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Administrador_Vehiculos.php';</script>";

            mysqli_close($conexion);

            exit();
        }

        function insertarVehiculoAdmin($nombre, $imagen, $marca, $matricula, $año, $caballos, $kilometros, $plazas, $estado, $precio, $descripcion, $idTipoVehiculo) {

            $conexion = mysqli_connect('localhost','root','');
    
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
    
            mysqli_select_db($conexion, 'LegendaryMotorsport');
    
    
            $nombre = mysqli_real_escape_string($conexion, $nombre);
            $imagen = mysqli_real_escape_string($conexion, $imagen);
            $marca = mysqli_real_escape_string($conexion, $marca);
            $matricula = mysqli_real_escape_string($conexion, $matricula);
            $año = mysqli_real_escape_string($conexion, $año);
            $caballos = mysqli_real_escape_string($conexion, $caballos);
            $kilometros = mysqli_real_escape_string($conexion, $kilometros);
            $plazas = mysqli_real_escape_string($conexion, $plazas);
            $estado = mysqli_real_escape_string($conexion, $estado);
            $precio = mysqli_real_escape_string($conexion, $precio);
            $descripcion = mysqli_real_escape_string($conexion, $descripcion);
            $idTipoVehiculo = mysqli_real_escape_string($conexion, $idTipoVehiculo);


            $consulta = mysqli_prepare($conexion,"INSERT INTO Vehiculo (IdTipoVehiculo, Imagen, Marca, Nombre, Matricula, Caballos, Kilometros, Plazas, Año, Precio, Estado, Descripcion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            $consulta->bind_param("issssiiiiiis", $idTipoVehiculo, $imagen, $marca, $nombre, $matricula, $caballos, $kilometros, $plazas, $año, $precio, $estado, $descripcion);
            $consulta->execute();

            echo "<script type='text/javascript'>alert('El vehiculo a sido insertado correctamente.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Administrador_Vehiculos.php';</script>";

            mysqli_close($conexion);

            exit();
        }
    }
    
?>