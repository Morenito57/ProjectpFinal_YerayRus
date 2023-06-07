<?php
$conexion = mysqli_connect('localhost','root','1234');

            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
             mysqli_select_db($conexion, 'LegendaryMotorsport');

             $letra = $_GET['letra'];

             if($letra != ""){
                $consulta = mysqli_prepare($conexion, "SELECT Id, Nombre FROM Vehiculo where Estado = 1 and (Nombre LIKE ?);");
                $letra = $letra . '%';
                $consulta->bind_param("s", $letra);
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