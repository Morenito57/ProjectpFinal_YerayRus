<?php
    require ("../Negocio/usuarioReglasNegocio.php");

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $usuarioBL = new UsuarioReglasNegocio();
        $perfil =  $usuarioBL->insertar($_POST['usuario'],$_POST['clave'],'Normal');
        header("Location: loginVista.php");
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
        .divPrincipal{
            width: 1910px;
            height: 800px;
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
            text-align: center;
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
            height: 80%;
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
            color: white;
            
        }

        .usuario{

        }

        .boton{
            width: 25%;
            border-radius: 60px;
            color: rgb(255, 255, 255);
        }

        .contrasena{
        }

        .divPie{
            width: 100%;
            height: 10%;
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
                        <input type="text" class="usuario" id="usuario" name = "usuario" placeholder="Usuario">
                        <br>
                        <input type="password" class="contrasena" id = "clave" name = "clave" placeholder="Contraseña">
                        <br>
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