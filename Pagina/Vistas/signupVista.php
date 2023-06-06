<?php
    require ("../Negocio/usuarioReglasNegocio.php");

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $usuarioBL = new UsuarioReglasNegocio();

        $perfil =  $usuarioBL->insertar($_POST['usuario'], $_POST['clave'], $_POST['nombre'], $_POST['apellidos'], $_POST['fechaNacimiento'], $_POST['direccion'], $_POST['DNI'], $_POST['telefono'], $_POST['email'], $_POST['otro']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
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
            border-bottom: 5px solid rgb(173, 32, 32);
        }
        .divCuerpo{
            width: 100%;
            height: 100%;
        }
        .divCabezeraCuerpo{
            padding: 20px;
            margin-top: 50px;
        }

        .divRestoCuerpo{
            margin: auto;
            margin-top: 20px;
            width: 80%;
            height: 100%;
        }

        .caja_inicio_sesion{
            width: 80%;
            height: 100%;
            background-color: rgb(61, 9, 9);
            margin: 0 auto;
            border: 5px solid rgb(173, 32, 32);
            text-align: center;
        }

        h1{
            font: oblique bold 35px cursive;
            padding-bottom: 20px;
            margin-top: 50px;
            color: white;
            text-align: center;
        }

        form input {
            width: 70%;
            height: 55px;
            margin: 10px;
            text-align: center;
            font: oblique bold 20px cursive;
            border: 2px solid rgb(173, 32, 32);
            background-color: rgb(94, 23, 23);
            border-radius: 60px 20px 5px;
            color: white;

        }
        ::placeholder { 
            color: rgb(255, 255, 255); 
        }

        .crear_cuenta{
            text-decoration: underline;
            text-align: center;
            margin-right: 500px;
        }

        .boton{
            width: 25%;
            border-radius: 60px;
            color: rgb(255, 255, 255);
            margin-top: 30px;
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
            border-radius: 60px 20px 5px;
            color: white;
            width: 80%;
            margin-top: 25px;
        }

        .tabla_datos{
            width: 100%;
            height: 100%;
        }

        .tr_datos{
            height: 9%;
            width: 100%;
        }

        .td_datos_nombre{
            width: 20%;
            font: oblique bold 20px cursive;

        }

        .td_datos_input{
            width: 80%;
        }

        .datos_guardados{
            color:white;
            font-size: 25px;
            margin-left: 100px;
        }

    </style>
</head>
<body>
    <title>Legendary MOTORSPORT</title>
    <div class="divPrincipal">
        <div class="divCabezera">
            <img class="portada" src="imagenes/Portada.png"> 
        </div>
        <div class="divCuerpo">
            <div class="divCabezeraCuerpo"></div>
            <div class="divRestoCuerpo">
                <div class="caja_inicio_sesion">
                    <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <h1>Crear Cuenta</h1>
                        <table class="tabla_datos">
                            <tr class="tr_datos">
                                <td class="td_datos_nombre">
                                    <p class="datos_guardados">Nombre:</p> 
                                </td>
                                <td class="td_datos_input">
                                    <input type="text" class="inputs" id="nombre" name="nombre" placeholder="Nombre" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s]+" required>
                                </td>
                            </tr>
                            <tr class="tr_datos">
                                <td class="td_datos_nombre">
                                    <p class="datos_guardados">Apellidos:</p>
                                </td>
                                <td class="td_datos_input">
                                    <input type="text" class="inputs" id="apellidos" name="apellidos" placeholder="Apellidos" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s]+" required>
                                </td>
                            </tr>
                            <tr class="tr_datos">
                                <td class="td_datos_nombre">
                                    <p class="datos_guardados">Fecha de Nacimiento:</p> 
                                </td>
                                <td class="td_datos_input">
                                    <input type="date" class="inputs" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha de Nacimiento" max="<?php echo date('Y-m-d'); ?>" required>
                                </td>
                            </tr>
                            <tr class="tr_datos">
                                <td class="td_datos_nombre">
                                    <p class="datos_guardados">Direccion:</p>
                                </td>
                                <td class="td_datos_input">
                                    <input type="text" class="inputs" id="direccion" name="direccion" placeholder="Direccion" required>
                                </td>
                            </tr>
                            <tr class="tr_datos">
                                <td class="td_datos_nombre">
                                    <p class="datos_guardados">DNI: </p>
                                </td>
                                <td class="td_datos_input">
                                    <input type="text" class="inputs" id="DNI" name="DNI" placeholder="DNI" size="10" maxlength="9" pattern="^(\d{8}|\d{8}[A-Z])$" required>
                                </td>
                            </tr>
                            <tr class="tr_datos">
                                <td class="td_datos_nombre">
                                    <p class="datos_guardados">Nombre de Usuario: </p>
                                </td>
                                <td class="td_datos_input">
                                    <input type="text" class="inputs" id="usuario" name="usuario" placeholder="Nombre de Usuario" pattern="[A-Za-z0-9\s]+" required>
                                </td>
                            </tr>
                            <tr class="tr_datos">
                                <td class="td_datos_nombre">
                                    <p class="datos_guardados">Contraseña: </p>
                                </td>
                                <td class="td_datos_input">
                                    <input type="password" class="inputs" id="clave" name="clave" placeholder="Contraseña" maxlength="10" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$" required>
                                </td>
                            </tr>
                            <tr class="tr_datos">
                                <td class="td_datos_nombre">
                                    <p class="datos_guardados">Telefono: </p>
                                </td>
                                <td class="td_datos_input">
                                    <input type="tel" class="inputs" id="telefono" name="telefono" placeholder="Telefono" size="12" pattern="[0-9]{9}" required>
                                </td>
                            </tr>
                            <tr class="tr_datos">
                                <td class="td_datos_nombre">
                                    <p class="datos_guardados">Email: </p>
                                </td>
                                <td class="td_datos_input">
                                    <input type="email" class="inputs" id="email" name="email" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                                </td>
                            </tr>
                            <tr class="tr_datos">
                                <td class="td_datos_nombre">
                                    <p class="datos_guardados">Otro dato de contacto: </p>
                                </td>
                                <td class="td_datos_input">
                                    <input type="text" class="inputs" id="otro" name="otro" placeholder="Otro dato de contacto" pattern="[A-Za-z0-9\s]+" required>
                                </td>
                            </tr>
                        </table>

                        <input type="submit" class="boton" value="Enviar">
                    </form>
                    <?php
                        if (isset($error))
                        {
                            print("<div> No tienes acceso </div>");
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="divPie"></div>
        </div>
    </div>
</body>
</html>