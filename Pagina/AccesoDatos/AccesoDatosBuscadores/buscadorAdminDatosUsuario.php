<?php
            $conexion = mysqli_connect('localhost','root','');
            if (mysqli_connect_errno())
            {
                    echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            mysqli_select_db($conexion, 'LegendaryMotorsport');

            $letra = $_GET['letra'];
            $campo = $_GET['campo'];

            $columnas_permitidas = ["Usuario.NombreUsuario", "Usuario.Clave", "Usuario.Saldo", "Usuario.TipoDeUsuario", "Usuario.Activo", "Usuario.IdDatosContacto", "DatosContacto.Telefono", "DatosContacto.Email", "DatosContacto.Otro", "Usuario.IdDatosPersonales", "DatosPersonales.Nombre", "DatosPersonales.Apellidos", "DatosPersonales.FechaNacimiento", "DatosPersonales.Direccion", "DatosPersonales.DNI"];
            if (!in_array($campo, $columnas_permitidas)) {
                die('Nombre de la columna no permitido');
            }

            $letra = mysqli_real_escape_string($conexion, $letra);

             if($letra != ""){
                $consulta = mysqli_prepare($conexion, "SELECT NombreUsuario, NombreUsuario as campo FROM Usuario INNER JOIN DatosPersonales ON Usuario.IdDatosPersonales = DatosPersonales.Id INNER JOIN DatosContacto ON Usuario.IdDatosContacto = DatosContacto.Id where ($campo LIKE ?);");
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