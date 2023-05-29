<?php
    session_start();

    require ("../Negocio/usuarioReglasNegocio.php");

    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);

    if (!isset($_SESSION['usuario'])) {
        header("Location: loginVista.php");
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $idDecodificado = urldecode($id);
    } else {
        header("Location: Administrador_Usuarios.php");
    }

    if($_SERVER["REQUEST_METHOD"]=="POST") {

        $usuarioBL = new UsuarioReglasNegocio();

        $perfil =  $usuarioBL->actualizarUsuarioComoAdmin( $_POST['IdUsuario'] ,$_POST['usuario'], $_POST['saldo'], $_POST['clave'], $_POST['tipoUser'], $_POST['activoUser'], $_POST['nombre'], $_POST['apellidos'], $_POST['fechaNacimiento'], $_POST['direccion'], $_POST['DNI'], $_POST['telefono'], $_POST['email'], $_POST['otro'], $_POST['IdDatosContacto'], $_POST['IdDatosPersonales']);

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

        html, body {
        }

        body{
            background-color: rgb(77, 5, 5);
        } 
        .divPrincipal{
            width: 100%;
        }
        .divCabezera{
            width: 100%;
        }

        .divCuerpo{
            width: 100%;
        }

        .divPie{
            width: 100%;
            padding-top: 50px;
        }

        .portada{
            width: 100%;
            border-bottom: 5px solid rgb(173, 32, 32);
        }

        .divCabezeraCuerpo{
            width: 100%;
            text-align: center;
            padding-bottom: 50px;
        }

        .divRestoCuerpo{
            width: 100%;
        }

        .menu{
            margin: 0 auto;
            width: 95%;
        }

        .pestaña{
            margin-top: 26px;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 10px;
            padding-left: 10px;
            font-size: 25px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            color: white;
        }


        .caja_area_personal{
            margin: auto;
            width: 95%;
            background-color: rgb(61, 9, 9);
            border: 5px solid rgb(173, 32, 32);
        }

        .contenido{
            width: 100%;
            overflow: auto;
            text-align: center;
        }

        h1{
            text-align: center;
            color: white;
            width: 90%;
            margin-top: 30px;
            margin-bottom: 30px;
            margin-left: 90px;
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

    </style>
</head>
<body>
    <div class="divPrincipal">
        <div class="divCabezera">
            <img class="portada" src="imagenes/Portada.png"> 
        </div>
        <div class="divCuerpo">
            <div class="divCabezeraCuerpo">
                <div class="menu">

                </div>
            </div>
            <div class="divRestoCuerpo">
                <div class="caja_area_personal">
                    <div class="contenido">
                        <h1>Actualizar Usuario</h1>
                        <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <?php
                            ini_set('display_errors', 'On');
                            ini_set('html_errors', 0);
                            $usuariosBL = new UsuarioReglasNegocio();
                            $datosUsuario = $usuariosBL->obtenerUsuario($idDecodificado);   
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
                                            <input type="password" class="inputs" id="clave" name="clave" placeholder="Contraseña" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Salso: <span class="datosUser">'.$datosUsuario[0]->getSaldo().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="number" class="inputs" id="saldo" name="saldo" placeholder="Saldo" min="1" max="100000">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Tipo de usuario: <span class="datosUser">'.$datosUsuario[0]->getTipoDeUsuario().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="tipoUser" name="tipoUser" placeholder="tipoUser" pattern="(Administrador|Normal)">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">;

                                            ';
                                                if($datosUsuario[0]->getActivo() == 1){
                                                    echo'<p class="datos_guardados">Activo: <span class="datosUser">True</span></p>';
                                                }else{
                                                    echo'<p class="datos_guardados">Activo: <span class="datosUser">False</span></p>';
                                                }
                                        echo'
                                        </td>
                                        <td class="td_datos_input">
                                            <p class="datos_guardados">True <input type="radio" class="inputs" id="activoUser" name="activoUser" value="1"></p>
                                            <p class="datos_guardados">False <input type="radio" class="inputs" id="activoUserFalse" name="activoUser" value="0"></p>
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
                                    <input id="IdUsuario" name="IdUsuario" value="'.$datosUsuario[0]->getNombreUsuario().'" type="hidden">
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
        <div class="divPie">
        </div>
        </div>
    </div>
    <script src="Inicio_Con_Admin.js"></script>
</body>
</html>