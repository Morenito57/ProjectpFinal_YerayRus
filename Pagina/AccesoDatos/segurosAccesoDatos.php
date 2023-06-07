<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class SegurosAccesoDatos{
    
        function __construct(){
        }

        function obtener(){
            $conexion = mysqli_connect('localhost','root','1234');
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
            mysqli_close($conexion);
            exit();
        }

        function obtenerSeguro($id){

            $conexion = mysqli_connect('localhost','root','1234');

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
            mysqli_close($conexion);
            exit();
        }

        function eliminarSeguro($id){

            $conexion = mysqli_connect('localhost','root','1234');
    
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

            echo "<script type='text/javascript'>alert('Se ha eliminado con exito.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Administrador_Seguros.php';</script>";

            mysqli_close($conexion);
            exit();
        }

        function actualizarSeguro($id, $seguro, $precio) {

            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);

            if ($seguro !== null && $seguro !== '') {
                $seguro = mysqli_real_escape_string($conexion, $seguro);
                $consulta1 = mysqli_prepare($conexion,"UPDATE Seguros SET Seguro = ? WHERE Id = ?;");
                $consulta1->bind_param("si",$seguro,$id);
                $consulta1->execute();
            }

            if ($precio !== null && $precio !== '') {
                $precio = mysqli_real_escape_string($conexion, $precio);
                $consulta2 = mysqli_prepare($conexion,"UPDATE Seguros SET Precio = ? WHERE Id = ?;");
                $consulta2->bind_param("ii",$precio,$id);
                $consulta2->execute();
            }

            echo "<script type='text/javascript'>alert('Se ha actualizado con exito con exito.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Administrador_Seguros.php';</script>";

            mysqli_close($conexion);
            exit();
        }

        function crearSeguro($seguro, $precio) {
        
            $conexion = mysqli_connect('localhost','root','1234');
        
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
        
            mysqli_select_db($conexion, 'LegendaryMotorsport');
    
            $seguro = mysqli_real_escape_string($conexion, $seguro);
            $precio = mysqli_real_escape_string($conexion, $precio);

            $consulta1 = mysqli_prepare($conexion, "INSERT INTO Seguros(Seguro, Precio) VALUES (?,?);");
            $consulta1->bind_param("si", $seguro, $precio);
            $consulta1->execute();    

            echo "<script type='text/javascript'>alert('Se ha actualizado con exito con exito.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Administrador_Seguros.php';</script>";

            mysqli_close($conexion);
            exit();
        }

    }
?>