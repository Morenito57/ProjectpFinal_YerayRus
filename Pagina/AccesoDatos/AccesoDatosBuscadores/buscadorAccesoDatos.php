<?php
$conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
             mysqli_select_db($conexion, 'LegendaryMotorsport');

             $letra = urldecode($_GET['letra']);

             if($letra != ""){
                $consulta = mysqli_prepare($conexion, "SELECT Id, Nombre FROM Vehiculo where (Nombre LIKE '" . $letra . "%');");
                mysqli_stmt_bind_param($consulta, "s", $letra);
                $consulta->execute();
               $result = $consulta->get_result();
       
               $vehiculos =  array();
       
               while ($myrow = $result->fetch_assoc()){
                   array_push($vehiculos,$myrow);
               }
               echo json_encode($vehiculos);
             }else{
                echo json_encode("");
             }

             mysqli_close($conexion);
             exit();
?>