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

        function obtenerExtra($id){
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);

            $consulta = mysqli_prepare($conexion, "select Id, Extra, Precio from Extras where Id = ?;");
            $consulta->bind_param('i', $id);
            $consulta->execute();
            $result = $consulta->get_result();
    
            $extras =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($extras,$myrow);
    
            }
            return $extras;
            mysqli_close($conexion);
            exit();
        }

        function eliminarExtra($id) {

            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);

            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=0;");
    
            $consulta1 = mysqli_prepare($conexion, "DELETE FROM Extras WHERE Id = ?");
            $consulta1->bind_param('i', $id);
            $consulta1->execute();
    
            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=1;");

            header("Location: Administrador_Extras.php");

            mysqli_close($conexion);
            exit();

        }

    }
?>