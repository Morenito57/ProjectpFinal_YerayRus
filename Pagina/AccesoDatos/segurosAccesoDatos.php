<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class SegurosAccesoDatos{
    
        function __construct(){
        }

        function obtener(){
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "select Id, Seguro, Precio from Seguros;");
            
            $consulta->execute();
            $result = $consulta->get_result();
    
            $seguros =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($seguros,$myrow);
    
            }
            return $seguros;
        }

        function obtenerSeguro($id){

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');
            
            $id = mysqli_real_escape_string($conexion, $id);

            $consulta = mysqli_prepare($conexion, "select Id, Seguro, Precio from Seguros where Id = ?;");
            $consulta->bind_param("i",$id);
            $consulta->execute();
            $result = $consulta->get_result();
    
            $seguros =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($seguros,$myrow);
    
            }
            return $seguros;
        }

        function eliminarSeguro($id){

            $conexion = mysqli_connect('localhost','root','');
    
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
    
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);
    
            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=0;");
    
            $consulta1 = mysqli_prepare($conexion, "DELETE FROM Seguros WHERE Id = ?");
            $consulta1->bind_param('i', $id);
            $consulta1->execute();
    
            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=1;");

            header("Location: Administrador_Seguros.php");

            mysqli_close($conexion);
            exit();
        }

    }
?>