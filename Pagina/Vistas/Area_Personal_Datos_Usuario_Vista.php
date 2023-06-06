<?php

    require ("../Negocio/usuarioReglasNegocio.php");

    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);

    session_start();

    $usuarioOriginal = $_SESSION['usuario'];

    if (!isset($_SESSION['usuario'])) {
        header("Location: loginVista.php");
    }

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        if(isset($_POST['actualizarUsuario'])) {

            $usuarioBL = new UsuarioReglasNegocio();

            $perfil =  $usuarioBL->actualizarUsuario($usuarioOriginal, $_POST['usuario'], $_POST['clave'], $_POST['nombre'], $_POST['apellidos'], $_POST['fechaNacimiento'], $_POST['direccion'], $_POST['DNI'], $_POST['telefono'], $_POST['email'], $_POST['otro'], $_POST['IdDatosContacto'], $_POST['IdDatosPersonales']);

        }elseif(isset($_POST['eliminar'])) {

            $usuariosBL = new UsuarioReglasNegocio();
            $datosUsuario = $usuariosBL->suspenderUsuario($usuarioOriginal); 

        }elseif(isset($_POST['deslogearse'])) {  

            $usuarioBL = new UsuarioReglasNegocio();
    
            $perfil =  $usuarioBL->deslogearse();

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

        html, body {
            height: 100%;
        }

        .portada{
            width: 100%;
            height: 100%;
        }

        .divPrincipal{
            width: 100%;
            height: 100%;
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
        }

        .divCabezeraCuerpo{
            padding: 20px;
            margin-top: 50px;
            width: 80%;
            margin: 25px auto;
        }

        .volver{
            background-color: rgb(61, 9, 9);
            text-decoration: none;
            color: white;
            padding: 22px;
            border: 3px solid rgb(173, 32, 32);
            font-size: 25px;
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
            text-align: center;

        }

        .tabla_datos{
            width: 100%;
            height: 100%;
        }

        .tr_datos{
            height: 9%;
            width: 100%;
        }

        .td_datos_texto{
            width: 40%;
            text-align: left;
        }

        .td_datos_input{
            width: 60%;
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
            display: block;  
            background-color: rgb(61, 9, 9); 
        }

        .logo_area{
            width: 100%;
            height: 19%;
            display: block;  
            background-color: rgb(61, 9, 9); 
        }

        .boton{
            width: 25%;
            height: 40px;
            color: rgb(255, 255, 255);
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            font-size: 25px;
            margin-top: 50px;
            margin-bottom: 75px;
        }

        .divPie{
            width: 100%;
            height: 10%;
        }

        .inputs{
            font-size: 25px;
            font: oblique bold 20px cursive;
            border: 2px solid rgb(173, 32, 32);
            background-color: rgb(94, 23, 23);
            color: white;
            width: 80%;
            margin-top: 20px;
            margin-bottom:35px;
            height: 25px;
        }

        .datos_guardados{
            margin-left: 55px;
            color: white;
            font-size: 25px;
            margin-bottom:35px;
            font-weight: 1000;
            margin-top: 20px;
        }

        .datosUser{
            margin-left: 20px;
        }


    </style>
</head>
<body>
    <div class="divPrincipal">
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
                                        <input type="submit" id="deslogearse" name="deslogearse" class="boton_area" value="Cerrar Sesion">

                                    </form>
                                    <img class="logo_area" src="imagenes/Logo.png"> 
                    </div>
                    <div class="contenido">
                        <h1>Datos de Usuario</h1>
                        <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <?php
                            ini_set('display_errors', 'On');
                            ini_set('html_errors', 0);
                            $usuariosBL = new UsuarioReglasNegocio();
                            $datosUsuario = $usuariosBL->obtenerUsuario($usuarioOriginal);   
                            echo'
                                <table class="tabla_datos">
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Nombre: <span class="datosUser">'.$datosUsuario[0]->getNombre().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="nombre" name="nombre" placeholder="Nombre" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s]+" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Apellidos: <span class="datosUser">'.$datosUsuario[0]->getApellidos().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="apellidos" name="apellidos" placeholder="Apellidos" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s]+" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Fecha de Nacimiento: <span class="datosUser">'.$datosUsuario[0]->getFechaNacimiento().'</span></p> 
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="date" class="inputs" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha de Nacimiento" max="'.date('Y-m-d').'" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Direccion: <span class="datosUser">'.$datosUsuario[0]->getDireccion().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="direccion" name="direccion" placeholder="Direccion" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">DNI: <span class="datosUser">'.$datosUsuario[0]->getDNI().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="DNI" name="DNI" placeholder="DNI" size="10" maxlength="9" pattern="^(\d{8}|\d{8}[A-Z])$" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Nombre de Usuario: <span class="datosUser">'.$datosUsuario[0]->getNombreUsuario().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="usuario" name="usuario" placeholder="Nombre de Usuario" pattern="[A-Za-z0-9\s]+" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Contraseña: <span class="datosUser"></span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="password" class="inputs" id="clave" name="clave" placeholder="Contraseña" maxlength="10" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Telefono: <span class="datosUser">'.$datosUsuario[0]->getTelefono().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="tel" class="inputs" id="telefono" name="telefono" placeholder="Telefono" size="12" pattern="[0-9]{9}" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Email: <span class="datosUser">'.$datosUsuario[0]->getEmail().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="email" class="inputs" id="email" name="email" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Otro datos de contacto: <span class="datosUser">'.$datosUsuario[0]->getOtro().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="otro" name="otro" placeholder="Otro dato de contacto" pattern="[A-Za-z0-9\s]+" >
                                        </td>
                                    </tr>
                                    <input id="IdDatosContacto" name="IdDatosContacto" value="'.$datosUsuario[0]->getIdDatosContacto().'" type="hidden">
                                    <input id="IdDatosPersonales" name="IdDatosPersonales" value="'.$datosUsuario[0]->getIdDatosPersonales().'" type="hidden">

                                ';
                            ?>  
                            </table>
                            <input type="submit" name="actualizarUsuario" class="boton" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="divPie"></div>
        </div>
    </div>
</body>
</html>