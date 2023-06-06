<?php
    session_start();

    require ("../Negocio/extrasNegocio.php");

    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);

    if (!isset($_SESSION['usuario'])) {
        vheader("Location: loginVista.php");
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $idDecodificado = urldecode($id);
    } else {
        header("Location: Administrador_Extras.php");
    }

    if($_SERVER["REQUEST_METHOD"]=="POST") {

        $TipoVehiculoBL = new ExtrasNegocio();

        $perfil =  $TipoVehiculoBL->actualizarExtra( $_POST['idExtra'], $_POST['extra'], $_POST['precio']);

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
                        <h1>Actualizar Extra</h1>
                        <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <?php
                            ini_set('display_errors', 'On');
                            ini_set('html_errors', 0);

                            $extraBL = new ExtrasNegocio();
                                    
                            $extras = $extraBL->obtenerExtra($idDecodificado);

                            for ($i = 0; $i < count($extras); $i++) {

                                $extra = $extras[$i];
                            echo'
                                <table class="tabla_datos">
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Extra: <span class="datosUser">'.$extra->getExtra().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="extra" name="extra" placeholder="Extra" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s\-,.]+">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Nombre: <span class="datosUser">'.$extra->getPrecio().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="number" class="inputs" id="precio" name="precio" placeholder="Precio" min="0" max="9999">
                                        </td>
                                    </tr>

                                    <input id="idExtra" name="idExtra" value="'.$extra->getId().'" type="hidden">

                                ';
                            }
                            ?>  
                            </table>
                            <input type="submit" name="actualizarTipoVehiculo" class="boton" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="divPie">
        </div>
        </div>
    </div>
</body>
</html>