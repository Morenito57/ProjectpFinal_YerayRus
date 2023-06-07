<?php
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $letra = $_GET['letra'];
            $campo = $_GET['campo'];

            $columnas_permitidas = ["Id", "Alquiler_id", "FechaDevuelto", "TotalCargo", "Pagado", "Activo"];
            if (!in_array($campo, $columnas_permitidas)) {
                die('Nombre de la columna no permitido');
            }

            $letra = mysqli_real_escape_string($conexion, $letra);

             if($letra != ""){
                $consulta = mysqli_prepare($conexion, "SELECT Id FROM Cargo where ($campo LIKE ?);");
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
             mysqli_close($conexion);
            exit();
?>