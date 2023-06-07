<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    class CargosAccesoDatos{
    
        function __construct(){
        }

        function obtener(){

            $conexion = mysqli_connect('localhost','root','1234');

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
            mysqli_close($conexion);
            exit();
        }

        function obtenerCargo($id){

            $conexion = mysqli_connect('localhost','root','1234');

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
            mysqli_close($conexion);
            exit();
        }

        function eliminarCargo($id) {

            $conexion = mysqli_connect('localhost','root','1234');
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

            echo "<script type='text/javascript'>alert('Se ha eliminado con exito.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Administrador_cargos.php';</script>";

            mysqli_close($conexion);
            exit();

        }

        function entregaCocghe($idCargo, $idAlquiler, $fecha) {

            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $idCargo = mysqli_real_escape_string($conexion, $idCargo);
            $idAlquiler = mysqli_real_escape_string($conexion, $idAlquiler);
            $fecha = mysqli_real_escape_string($conexion, $fecha);
            $fecha = date('Y-m-d', strtotime($fecha));

            $consulta1 = mysqli_prepare($conexion, "UPDATE Cargo SET Activo = 1, Pagado = 0 WHERE Id = ?;");
            $consulta1->bind_param('i', $idCargo);
            $consulta1->execute();

            $consulta2 = mysqli_prepare($conexion, "UPDATE Cargo SET FechaDevuelto = ? WHERE Alquiler_id = ?;");
            $consulta2->bind_param('si', $fecha, $idAlquiler);
            $consulta2->execute();

            $consulta3 = mysqli_prepare($conexion, "SELECT FechaFinal FROM Alquiler WHERE Id = ?;");
            $consulta3->bind_param('i', $idAlquiler);
            $consulta3->execute();

            $resultado = mysqli_stmt_get_result($consulta3);
            $registro = mysqli_fetch_assoc($resultado);
            $fechaFinal = $registro['FechaFinal'];

            if ($fecha > $fechaFinal){
                $consulta4 = mysqli_prepare($conexion, "UPDATE Cargo JOIN (SELECT Alquiler.Id, Cargo.FechaDevuelto, (DATEDIFF(Cargo.FechaDevuelto, Alquiler.FechaFinal) * 2) * (Vehiculo.Precio + (IFNULL(SUM(Seguros.Precio), 0) + IFNULL(SUM(Extras.Precio), 0))) AS Total FROM Alquiler JOIN Vehiculo ON Alquiler.IdVehiculo = Vehiculo.Id LEFT JOIN Alquiler_Seguro ON Alquiler.Id = Alquiler_Seguro.Alquiler_id LEFT JOIN Seguros ON Alquiler_Seguro.Seguro_id = Seguros.Id LEFT JOIN Alquiler_Extra ON Alquiler.Id = Alquiler_Extra.Alquiler_id LEFT JOIN Extras ON Alquiler_Extra.Extra_id = Extras.Id JOIN Cargo ON Cargo.Alquiler_id = Alquiler.Id WHERE Alquiler.Id = ? GROUP BY Alquiler.Id, Cargo.FechaDevuelto) subquery ON Cargo.Alquiler_id = subquery.Id SET Cargo.TotalCargo = subquery.Total WHERE Cargo.Alquiler_id = ?;");
                $consulta4->bind_param('ii', $idAlquiler, $idAlquiler);
                $consulta4->execute();
            }else{
                $consulta4 = mysqli_prepare($conexion, "UPDATE Cargo SET TotalCargo = 0, Pagado = 1, Activo = 0 WHERE Id = ?");
                $consulta4->bind_param('i', $idCargo);
                $consulta4->execute();
            }
        
            $consulta5 = mysqli_prepare($conexion, "UPDATE Alquiler SET Estado = 0 WHERE Id = ?;");
            $consulta5->bind_param('i', $idAlquiler);
            $consulta5->execute();

            $consulta6 = mysqli_prepare($conexion, "SELECT IdVehiculo FROM Alquiler WHERE Id = ?;");
            $consulta6->bind_param('i', $idAlquiler);
            $consulta6->execute();

            $resultado2 = mysqli_stmt_get_result($consulta6);
            $registro2 = mysqli_fetch_assoc($resultado2);
            $vehiculo = $registro2['IdVehiculo'];

            $consulta7 = mysqli_prepare($conexion, "UPDATE Vehiculo SET Estado = 1 WHERE Id = ?;");
            $consulta7->bind_param('i', $vehiculo);
            $consulta7->execute();

            echo "<script type='text/javascript'>alert('Se ha entregado con exito.');</script>";

            echo "<script type='text/javascript'>window.location.href = 'Administrador_cargos.php';</script>";

            mysqli_close($conexion);
            exit();
        }
    }
?>