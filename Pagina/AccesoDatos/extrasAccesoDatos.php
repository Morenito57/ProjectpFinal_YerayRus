<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class ExtrasAccesoDatos{
    
        function __construct(){
        }

        function obtener(){
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "select Id, Extra, Precio from Extras;");
            
            $consulta->execute();
            $result = $consulta->get_result();
    
            $extras =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($extras,$myrow);
    
            }
            return $extras;
        }

    }
?>