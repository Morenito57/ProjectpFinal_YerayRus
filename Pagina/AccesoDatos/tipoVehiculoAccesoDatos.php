<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class TipoVehiculoAccesoDatos{
    
        function __construct(){
        }

        function obtener(){
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "select Id, TipoVehiculo from TipoVehiculo;");
            
            $consulta->execute();
            $result = $consulta->get_result();
    
            $tipos =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($tipos,$myrow);
    
            }
            return $tipos;
        }

        function obtenerTipoVehiculo($idDecodificado){

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            $idDecodificado = mysqli_real_escape_string($conexion, $idDecodificado);

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "select Id, TipoVehiculo from TipoVehiculo where id = ?;");
            $consulta->bind_param("i",$idDecodificado);
            $consulta->execute();
            $result = $consulta->get_result();
    
            $tipos =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($tipos,$myrow);
    
            }
            return $tipos;
        }

        function eliminarTipoVehiculo($idDecodificado){

            $conexion = mysqli_connect('localhost','root','');
    
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
    
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $idDecodificado = mysqli_real_escape_string($conexion, $idDecodificado);
    
            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=0;");
    
            $consulta1 = mysqli_prepare($conexion, "DELETE FROM TipoVehiculo WHERE Id = ?");
            $consulta1->bind_param('i', $idDecodificado);
            $consulta1->execute();
    
            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=1;");

            header("Location: Administrador_TipoVehiculos.php");

            mysqli_close($conexion);

            exit();

        }

    }
?>