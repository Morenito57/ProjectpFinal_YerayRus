<?php
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $letra = urldecode($_GET['letra']);
            $campo = urldecode($_GET['campo']);

            $columnas_permitidas = ["Alquiler.Id", "Alquiler.IdUser", "Alquiler.IdVehiculo", "Cargo.Id", "Seguros.Id", "Extras.Id", "Alquiler.FechaInicio", "Alquiler.FechaFinal", "Alquiler.TotalDelPrecio", "Alquiler.Estado"];
            if (!in_array($campo, $columnas_permitidas)) {
                die('Nombre de la columna no permitido');
            }

            $letra = mysqli_real_escape_string($conexion, $letra);

             if($letra != ""){
                $consulta = mysqli_prepare($conexion, "SELECT Alquiler.Id AS IdAlquiler FROM Alquiler LEFT JOIN Alquiler_Seguro ON Alquiler.Id = Alquiler_Seguro.Alquiler_id LEFT JOIN Cargo ON Alquiler.Id = Cargo.Alquiler_id LEFT JOIN Seguros ON Alquiler_Seguro.Seguro_id = Seguros.Id LEFT JOIN Alquiler_Extra ON Alquiler.Id = Alquiler_Extra.Alquiler_id LEFT JOIN Extras ON Alquiler_Extra.Extra_id = Extras.Id where ($campo LIKE ?) GROUP BY Alquiler.Id;");
                $letra = $letra . '%';
                $consulta->bind_param("s", $letra);
                $consulta->execute();
                $result = $consulta->get_result();
       
               $usuarios =  array();
       
               while ($myrow = $result->fetch_assoc()){
                   array_push($usuarios,$myrow);
               }
               echo json_encode($usuarios);
             }else{
                echo json_encode("");
             }
?>