<?php
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $letra = $_GET['letra'];
            $campo = $_GET['campo'];

            $columnas_permitidas = ["Id", "Seguro", "Precio"];
            if (!in_array($campo, $columnas_permitidas)) {
                die('Nombre de la columna no permitido');
            }

            $letra = mysqli_real_escape_string($conexion, $letra);

             if($letra != ""){
                $consulta = mysqli_prepare($conexion, "SELECT Id, Seguro as campo FROM Seguros where ($campo LIKE ?);");
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