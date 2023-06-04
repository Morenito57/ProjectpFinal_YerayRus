<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class CargosAccesoDatos{
    
        function __construct(){
        }

        function obtener(){

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $consulta = mysqli_prepare($conexion, "SELECT Id, Alquiler_id, FechaDevuelto, TotalCargo, Pagado, Activo from Cargo;");
            $consulta->execute();
            $result = $consulta->get_result();
    
            $cargos =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($cargos,$myrow);
    
            }
            return $cargos;
        }

        function obtenerCargo($id){

            $conexion = mysqli_connect('localhost','root','');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);

            $consulta = mysqli_prepare($conexion, "SELECT Id, Alquiler_id, FechaDevuelto, TotalCargo, Pagado, Activo from Cargo where Id = ?;");
            $consulta->bind_param('i', $id);
            $consulta->execute();
            $result = $consulta->get_result();
    
            $cargos =  array();
    
            while ($myrow = $result->fetch_assoc()) 
            {
                array_push($cargos,$myrow);
    
            }
            return $cargos;
        }

        function eliminarCargo($id) {

            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);

            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=0;");
    
            $consulta1 = mysqli_prepare($conexion, "DELETE FROM Cargo WHERE Id = ?");
            $consulta1->bind_param('i', $id);
            $consulta1->execute();
    
            mysqli_query($conexion, "SET FOREIGN_KEY_CHECKS=1;");

            header("Location: Administrador_cargos.php");

            mysqli_close($conexion);
            exit();

        }

        function actualizarcargo($id, $estado) {

            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $id = mysqli_real_escape_string($conexion, $id);

            if ($estado !== '') {
                if ($estado === Null || $estado == "Null" || $estado == "null" || $estado === null) {
                    $estado = mysqli_real_escape_string($conexion, $estado);
                    $consulta1 = mysqli_prepare($conexion,"UPDATE cargo SET Estado = Null WHERE Id = ?;");
                    $consulta1->bind_param("i",$id);
                    $consulta1->execute();
                }else{
                    $estado = mysqli_real_escape_string($conexion, $estado);
                    $consulta1 = mysqli_prepare($conexion,"UPDATE cargo SET Estado = ? WHERE Id = ?;");
                    $consulta1->bind_param("si",$estado,$id);
                    $consulta1->execute();
                }

            }

        }


    }
?>