<?php

    session_start();

    require ("../Negocio/usuarioReglasNegocio.php");
    require('../Negocio/gestionAlquileresNegocio.php');

    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $idDecodificado = urldecode($id);
    } else {
        header("Location: Area_Personal_Historial_Alquileres_Usuario_Vista.php");
    }

    $usuarioOriginal = $_SESSION['usuario'];

    if (!isset($_SESSION['usuario'])) {
        header("Location: loginVista.php");
    }

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        if(isset($_POST['eliminar'])) {

            $usuarioBL = new UsuarioReglasNegocio();
            $datosUsuario = $usuarioBL->suspenderUsuario($usuarioOriginal); 

        }elseif(isset($_POST['deslogearse'])) {  

            $usuarioBL = new UsuarioReglasNegocio();
    
            $perfil =  $usuarioBL->deslogearse();

        }elseif(isset($_POST['añadirDias'])) {  

            $usuarioBL = new GestionAlquileresNegocio();

            $IdAlquiler = intval($_POST['IdAlquiler']);
            $TotalDias = intval($_POST['TotalDias']);
            $TotalPago = intval($_POST['TotalPago']);
            $diaFinalizacionDelAlquiler = $_POST['diaFinalizacionDelAlquiler'];

            if ($_POST['TotalDias'] === "" || !is_numeric($_POST['TotalDias'])) {
                echo '<script>alert("El valor de introducido no es válido. Por favor, ingrese un número entero.");</script>';
            }else{

                $FechaFinal = date('Y-m-d', strtotime($diaFinalizacionDelAlquiler . ' + '.$TotalDias.' days'));

                $perfil =  $usuarioBL->actualizarAlquiler($usuarioOriginal, $IdAlquiler, $FechaFinal, $TotalPago);
            }

        }elseif(isset($_POST['pagarCargo'])) {  

            $usuarioBL = new GestionAlquileresNegocio();

            $permiso = $_POST['permisoParaPagar'];
            $idAlquiler = $_POST['IdAlquiler'];
            $idCargo = $_POST['IdCargo'];
            $totalPago = $_POST['TotalCargo'];

            if ($permiso == "1") {
                $perfil =  $usuarioBL->actualizarCargo($usuarioOriginal, $idAlquiler, $idCargo, $totalPago);
            } else {
                echo '<script>alert("Error.");</script>';
            }  
        }elseif(isset($_POST['factura'])) { 

            $idAlquiler = $_POST['IdAlquiler'];

            header("Location: Factura_Alquiler_Usuario.php?idAlquiler=".urlencode($idAlquiler));

        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legendary MOTORSPORT</title>
    <style>
        *{
            padding: 0%;
            margin: 0%;
        }

        body{
            background-color: rgb(77, 5, 5);
        } 

        .divPrincipal{
            width: 1910px;
            height: 925px;
        }

        .divCabezera{
            width: 100%;
            height: 480px;
            padding: 0%;
            margin: 0%;
            border-bottom: 5px solid rgb(173, 32, 32);
        }

        .divCuerpo{
            width: 100%;
            height: 100%;
            padding: 10px;    
        }

        .divCabezeraCuerpo{
            padding: 20px;
            margin-top: 50px;
            width: 80%;
            margin: 25px auto;
        }

        .divRestoCuerpo{
            margin: auto;
            margin-top: 20px;
            width: 80%;
            height: 100%;
        }

        .caja_area_personal{
            width: 100%;
            height: 90%;
            border: 5px solid rgb(173, 32, 32);
            display: flex;
        }

        .areas{
            height: 100%;
            width: 20%;
            float: left;
            border-right: 5px solid rgb(173, 32, 32); 
            background-color: rgb(61, 9, 9);
        }

        .contenido{
            height: 100%;
            width: 80%;
            float: left;
            margin: 0 auto;
            background-color: rgb(77, 5, 5);
            overflow: auto;
        }

        h1{
            text-align: center;
            color: white;
            margin-top: 100px;
            margin-bottom: 60px;
            font-size: 40px;
        }

        .boton_area{
            text-align: center;
            text-decoration: none;
            width: 100%;
            color: white;
            font-size: 25px;
            padding: 50px 0;
            border-bottom: 5px solid rgb(173, 32, 32); 
            background-color: rgb(117, 13, 13);
            display: block;  
            background-color: rgb(61, 9, 9);
        }

        .logo_area{
            width: 100%;
            height: 19%;
            display: block;  
            background-color: rgb(61, 9, 9); 
        }

        .divPie{
            width: 100%;
            height: 10%;
        }

        .volver{
            background-color: rgb(61, 9, 9);
            text-decoration: none;
            color: white;
            padding: 22px;
            border: 3px solid rgb(173, 32, 32);
            font-size: 25px;
        }

        table{
            border: 2px solid rgb(173, 32, 32);
            margin: auto;
            border-collapse: collapse;
            margin-bottom: 200px;
            width: 99%;
        }

        tr{
            border: 2px solid rgb(173, 32, 32);
        }

        th{
            border: 2px solid rgb(173, 32, 32);
            background-color: rgb(77, 5, 5);
            color: white;
            height: 35px;
            width: 7.5%;
        }

        td{
            border: 2px solid rgb(173, 32, 32);
            color: white;
            height: 35px;
            width: 7.5%;
        }

        .accion{
            text-decoration: none;
            text-align: center;
        }

        .verde{
            color: green;
        }

        .rojo{
            color: red;
        }

        .acciones{
            height: 100%;
            width: 30%;
            text-align: center;
            background-color: rgb(61, 9, 9);
            display: inline;
            font-size: 15px;
        }

        .divDinero {
            position: fixed;
            top: 0;
            right: 0;
            height: 100px;
            z-index: 1;
        }

        .dinero{
            color: green;
            text-align: center;
            font-size: 35px;
            font-weight: 1000;
            margin: 25px auto;
            font-family: 'Orbitron', sans-serif;
            background-color: rgb(77, 5, 5);
            border: 5px solid rgb(173, 32, 32);
            padding-left: 10px;
            padding-right: 10px;
        }

    </style>
</head>
<body>
    <div class="divPrincipal">
        <div class="divDinero">
            <?php
                ini_set('display_errors', 'On');
                ini_set('html_errors', 0);
                $usuarioBL = new UsuarioReglasNegocio();
                $datosUsuario = $usuarioBL->obtenerUsuario($usuarioOriginal);               
                echo'<p class="dinero">'.$datosUsuario[0]->getSaldo().'€</p>';               
            ?>
        </div>
        <div class="divCabezera">
            <img class="portada" src="imagenes/Portada.png"> 
        </div>
        <div class="divCuerpo">
            <div class="divCabezeraCuerpo">
                <a href="Inicio_Con_Loggin.php" class="volver">Pagina Principal</a>
            </div>
            <div class="divRestoCuerpo">
                <div class="caja_area_personal">
                    <div class="areas">
                                    <a href="Area_Personal_Datos_Usuario_Vista.php" class="boton_area">Datos Personales</a>
                                    <a href="Area_Personal_Saldo_Usuario_Vista.php" class="boton_area">Saldo</a>
                                    <a href="Area_Personal_Historial_Alquileres_Usuario_Vista.php" class="boton_area">Historial de compras</a>
                                    <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <?php
                                            ini_set('display_errors', 'On');
                                            ini_set('html_errors', 0);
  
                                            echo'
                                                <input type="submit" name="eliminar" class="boton_area" value="Eliminar Cuenta">
                                            ';
                                        ?>
                                        <input type="submit" name="deslogearse" class="boton_area" value="Cerrar Sesion">

                                    </form>
                                    <img class="logo_area" src="imagenes/Logo.png"> 

                    </div>
                    <div class="contenido">

                    <h1>Gestion Alquiler</h1>
                    <table>
                                <tr>
                                    <th><p class="clase">Id</p></th>
                                    <th><p class="clase">Vehiculo</p></th>
                                    <th><p class="clase">Fecha Inicio </p></th>
                                    <th><p class="clase">Fecha Final</p></th> 
                                    <th><p class="clase">Fecha Devuelto</p></th> 
                                    <th><p class="clase">Seguros</p></th> 
                                    <th><p class="clase">Extras</p></th>
                                    <th><p class="clase">Precio Total</p></th>
                                    <th><p class="clase">Total del cargo</p></th>
                                    <th><p class="clase">Estado del Alquiler</p></th> 
                                    <th><p class="clase">Estado del Cargo</p></th> 
                                    <th><p class="clase">Cargo pagado?</p></th>
                                    <th><p class="clase">Acciones</p></th> 
                                </tr>
                                <?php
                                    ini_set('display_errors', 'On');
                                     ini_set('html_errors', 0);
         
                                     $alquilerBL = new GestionAlquileresNegocio();
                                              
                                     $datosAlquiler = $alquilerBL->obtenerAlquiler($idDecodificado);

                                     for ($i = 0; $i < count($datosAlquiler); $i++) {

                                        $Alquiler = $datosAlquiler[$i];

                                        $seguros = $Alquiler->getSeguros();
                                        $extras = $Alquiler->getExtras();
                                
                                        $seguros_separados = is_array($seguros) ? implode(", ", $seguros) : $seguros;
                                        $extras_separados = is_array($extras) ? implode(", ", $extras) : $extras;

                                        echo'
                                            <tr>
                                                <td ><p class="dato">'.$Alquiler->getIdAlquiler().'</p></td>
                                                <td ><p class="dato">'.$Alquiler->getNombreVehiculo().'</p></td>
                                                <td ><p class="dato">'.$Alquiler->getFechaInicio().'</p></td>
                                                <td ><p class="dato">'.$Alquiler->getFechaFinal().'</p></td>
                                                ';
                                                if($Alquiler->getFechaDevuelto() == null){

                                                    echo'
                                                        <td ><p class="dato">No ha terminado el alquier.</p></td>
                                                    ';                                                
                                                }else{
                                                    echo'
                                                        <td ><p class="dato">'.$Alquiler->getFechaDevuelto().'</p></td>
                                                    ';
                                                }
                                                echo'
                                                <td ><p class="dato">'.$seguros_separados.'</p></td>
                                                <td ><p class="dato">'.$extras_separados.'</p></td>
                                                <td ><p class="dato">'.$Alquiler->getTotalDelPrecio().'</p></td>
                                                ';
                                                if($Alquiler->getTotalCargo() == null){

                                                    echo'
                                                        <td ><p class="dato">No hay cargo por ahora.</p></td>
                                                    ';                                                
                                                }else{
                                                    echo'
                                                        <td ><p class="dato rojo">'.$Alquiler->getTotalCargo().'</p></td>
                                                    ';
                                                }

                                                if($Alquiler->getActivoAlquiler() == 1){

                                                    echo'
                                                        <td ><p class="dato verde">Activo</p></td>
                                                    ';                                                
                                                }else if($Alquiler->getActivoCargo() == ""){
                                                    echo'
                                                        <td ><p class="dato">Cancelado</p></td>
                                                    ';
                                                }else if($Alquiler->getActivoAlquiler() == 0){
                                                    echo'
                                                        <td ><p class="dato">Finalizado</p></td>
                                                    ';
                                                }

                                                if($Alquiler->getActivoCargo() == 1){

                                                    echo'
                                                        <td ><p class="dato rojo">Tiene</p></td>
                                                    ';                                                
                                                }else if($Alquiler->getActivoCargo() == ""){
                                                    echo'
                                                        <td ><p class="dato verde">No hay por ahora.</p></td>
                                                    ';
                                                }else if($Alquiler->getActivoCargo() == 0){
                                                    echo'
                                                        <td ><p class="dato verde">No tiene</p></td>
                                                    ';
                                                }

                                                if($Alquiler->getPagado() == 1){
                                                    echo'
                                                        <td ><p class="dato verde">Si</p></td>
                                                    ';                                                
                                                }else if($Alquiler->getPagado() === 0){
                                                    echo'
                                                        <td ><p class="dato rojo">No</p></td>
                                                    ';
                                                }else if($Alquiler->getPagado() === null){
                                                    echo'
                                                        <td ><p class="dato">No hay por ahora.</p></td>
                                                    ';
                                                }
                                                echo'
                                                <td>
                                                    <p class="accion">

                                                        <form method = "POST" action = "'.htmlspecialchars($_SERVER["PHP_SELF"]).'">

                                                            <input id="IdAlquiler" name="IdAlquiler" value="'.$Alquiler->getIdAlquiler().'" type="hidden">
                                                            <input id="diaFinalizacionDelAlquiler" name="diaFinalizacionDelAlquiler" value="'.$Alquiler->getFechaFinal().'" type="hidden">
                                                            <input id="TotalDias" name="TotalDias" value="" type="hidden">
                                                            <input id="TotalPago" name="TotalPago" value="" type="hidden">

                                                            <input id="botonAnadirDias" type="submit" name="añadirDias" class="acciones" value="➕" onclick="actualizarDias()">

                                                            <input id="permisoParaPagar" name="permisoParaPagar" value="" type="hidden">
                                                            <input id="IdCargo" name="IdCargo" value="'.$Alquiler->getIdCarg().'" type="hidden">
                                                            <input id="TotalCargo" name="TotalCargo" value="'.$Alquiler->getTotalCargo().'" type="hidden">

                                                            <input id="pagarCargo" type="submit" name="pagarCargo" class="acciones" value="💲" onclick="pagarCargos()">
                                                            <input id="factura" type="submit" name="factura" class="acciones" value="🧾">
                                                        </form>
                                                    </p>
                                                </td>
                                            </tr>
                                        ';
                                     }
                                ?>

                            </table>
                                    
                    </div>
                </div>
            </div>
        </div>
        <div class="divPie"></div>
        </div>
    </div>
    <script>
        var fechaFinalPhp = new Date("<?php echo $Alquiler->getFechaFinal(); ?>");
        var fechaDevueltoPhp = "<?php echo $Alquiler->getFechaDevuelto(); ?>";
        var precioVehiculoDiaPhp = "<?php echo $Alquiler->getPrecioVehiculo(); ?>";
        var fechaActualPhp = new Date("<?php echo date('Y-m-d'); ?>");

        var cargoActivoPhp = Boolean("<?php echo $Alquiler->getActivoCargo(); ?>");
        var valorCargoPhp = "<?php echo $Alquiler->getTotalCargo(); ?>";
        var fechaDevueltoPhp = "<?php echo $Alquiler->getFechaDevuelto(); ?>";

    </script>
    <script src="js/JS_Alquiler.js"></script>
</body>
</html>