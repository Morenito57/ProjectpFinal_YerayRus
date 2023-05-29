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
        if(isset($_POST['eliminar'])) {

            $usuariosBL = new UsuarioReglasNegocio();
            $datosUsuario = $usuariosBL->suspenderUsuario($usuarioOriginal); 
            header("Location: loginVista.php");

        }elseif(isset($_POST['actualizar_dinero'])) {
            $Dinero = intval($_POST['saldo']);
    
            $usuarioBL = new UsuarioReglasNegocio();
    
            $perfil =  $usuarioBL->actualizarSalsoUsuario($usuarioOriginal, $Dinero);

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
    <title>Document</title>
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
        }

        .tabla_datos{
            text-align: center;
            width: 100%;
        }

        .td_datos{
            width: 50%;
        }

        h1{
            text-align: center;
            color: white;
            margin-top: 50px;
            margin-bottom: 30px;
            font-size: 40px;
        }

        .datos_guardados{
            margin-left: 70px;
            color: white;
            font-size: 40px;
            margin-bottom:35px;
            margin-top:150px;
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

        .boton{
            color: rgb(255, 255, 255);
            background-color: rgb(61, 9, 9);
            border: 5px solid rgb(173, 32, 32);
            padding: 10px 35px;
            font-size: 30px;
            margin-top: 50px;
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

        .saldo{
            font-size: 25px;
            font: oblique bold 20px cursive;
            border: 5px solid rgb(173, 32, 32);
            background-color: rgb(94, 23, 23);
            color: white;
            height: 50px;
            margin-bottom:35px;
            margin-top:150px;
        }

        form{
            text-align: center;
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
                                        <input type="submit" name="deslogearse" class="boton_area" value="Deslogearse">
                                    </form>
                                    <img class="logo_area" src="imagenes/Logo.png"> 
                    </div>
                    <div class="contenido">
                        <h1>Saldo Personales</h1>
                            <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <?php
                                        ini_set('display_errors', 'On');
                                        ini_set('html_errors', 0);
                                        $usuariosBL = new UsuarioReglasNegocio();
                                        $datosUsuario = $usuariosBL->obtenerUsuario($usuarioOriginal);   
                                        echo'
                                        <table class="tabla_datos">
                                            <tr class="tr_datos">
                                                <td class="td_datos">
                                                    <p class="datos_guardados">Saldo actual: '.$datosUsuario[0]->getSaldo().'</p> 
                                                </td>
                                                <td class="td_datos">
                                                    <input type="number" class="saldo" id="saldo" name="saldo" placeholder="Saldo" min="1" max="10000"required>
                                                </td>
                                            </tr>
                                        </table>
                                        ';
                            ?>
                            <input type="submit"  name="actualizar_dinero" class="boton" value="Enviar">
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