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

    }
?>