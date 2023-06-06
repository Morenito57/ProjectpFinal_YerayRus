<?php
    require_once('../Negocio/gestionAlquileresNegocio.php');
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    session_start();
    $usuario = $_SESSION['usuario'];
    if (!isset($_SESSION['usuario'])) {
        header("Location: loginVista.php");
    }

    if($_SERVER['REQUEST_METHOD']=='POST') {

        $gestionBL = new GestionAlquileresNegocio();

        $IdUser = $_POST['IdUser'];
        $IdVehiculo = intval($_POST['IdVehiculo']);
        $IdSeguros = $_POST['seguros'];
        $IdExtras = $_POST['extras'];
        $FechaInicio = $_POST['FechaInicio'];
        $diasAlquiler = $_POST['diasAlquiler'];
        $TotalDelPrecio = intval($_POST['TotalDelPrecio']);

        $seguro = is_array($IdSeguros) ? array_map('intval', $IdSeguros) : intval($IdSeguros);
        $extra = is_array($IdExtras) ? array_map('intval', $IdExtras) : intval($IdExtras);

        $FechaFinal = date('Y-m-d', strtotime($FechaInicio . ' + '.$diasAlquiler.' days'));
        $datosAlquiler = $gestionBL->insertarAlquiler($IdUser, $seguro, $extra, $IdVehiculo, $FechaInicio, $FechaFinal, $TotalDelPrecio);
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
            background-color: rgb(104, 11, 11);
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
        }
        .divCuerpo{
            width: 100%;
            height: 100%;
            border-top: 5px solid rgb(173, 32, 32);
        }

        .divCabezeraCuerpo{
            width: 100%;
            height: 5%;
        }
        .divRestoCuerpo{
            margin-top: 20px;
            width: 100%;
            height: 85%;
        }
        .anuncio{
            background-color: rgb(61, 9, 9);
            width: 65%;
            height: 100%;
            border: 5px solid rgb(173, 32, 32);
            margin: 0 auto;
            padding-left: 80px;
            padding-top: 75px;
            padding-bottom: 35px;

        }
        .fotoAnuncio{
            width: 60%;
            height: 100%;
            float: left;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .detallesAnuncio{
            float: left;
            width: 40%;
            height: 100%;
        }
        .fotoPrincipal{
            width: 80%;
            height: 80%;
            border: 5px solid rgb(173, 32, 32);
        }
        .descripcionVehiculo{
            color: aliceblue;
            font-size: 24px;
            margin-bottom: 15px;
        }
        h1{
            color: aliceblue;
            font-size: 50px;
            margin-bottom: 40px;
        }
        .transaccion{
            background-color: rgb(104, 11, 11);
            padding-left: 80px;
            padding-right: 80px;
            padding-top: 25px;
            padding-bottom: 15px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 25px;
            color: White;
            border: 5px solid rgb(173, 32, 32);
        }
        .divPie{
            width: 100%;
            height: 10%;
        }

        .boton{
            width: 25%;
            height: 50px;
            color: rgb(255, 255, 255);
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            font-size: 25px;
            float: right;
        }

        .diasAlquiler{
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 5px;
            padding-bottom: 5px;
            font-size: 25px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            color: white;
            width: 65px;
        }

        .selects{
            padding-top: 10px;
            padding-bottom: 25px;
            font-size: 15px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            color: white;
            float: right;
            height: 80px;
            float: left;
            width: 45%;
            margin-right: 20px;
            margin-bottom: 20px;
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
                require ("../Negocio/usuarioReglasNegocio.php");
                ini_set('display_errors', 'On');
                ini_set('html_errors', 0);
                $usuarioBL = new UsuarioReglasNegocio();
                $datosUsuario = $usuarioBL->obtenerUsuario($usuario);               
                echo'<p class="dinero">'.$datosUsuario[0]->getSaldo().'€</p>';               
            ?>
        </div>
        <div class="divCabezera">
            <img class="portada" src="imagenes/Portada.png"> 
        </div>
        <div class="divCuerpo">
            <div class="divCabezeraCuerpo"></div>
            <div class="divRestoCuerpo">
            <?php
                            require("../Negocio/vehiculoReglasNegocio.php");
                            ini_set('display_errors', 'On');
                            ini_set('html_errors', 0);

                            $vehiculosBL = new VehiculosReglasNegocio();
                            
                            $id = intval($_GET['id']);

                            $datosVehiculos = $vehiculosBL->obtenerVehiculoConcreto($id);
                            foreach($datosVehiculos as $vehiculo){ 

                                $precio = $vehiculo->getPrecio();

                                echo'
                                    <div class="anuncio">
                                        <div class="detallesAnuncio">
                                            <h1>'.$vehiculo->getNombre().'</h1>
                                            <p class="descripcionVehiculo">
                                                '.$vehiculo->getDescripcion().'
                                                <br>
                                                <br>
                                                Marca: '.$vehiculo->getMarca().'
                                                <br>
                                                Tipo de vehiculo: '.$vehiculo->getIdTipoVehiculo().'
                                                <br>
                                                Matricula: '.$vehiculo->getMatricula().'
                                                <br>
                                                Caballos: '.$vehiculo->getCaballos().'
                                                <br>
                                                Kilometros: '.$vehiculo->getKilometros().'
                                                <br>
                                                Nº Pasajeros: '.$vehiculo->getPlazas().'
                                                <br>
                                                Año de fabicacion: '.$vehiculo->getAño().'
                                            </p>

                                            <form class="formulario" method = "POST" action = "'.htmlspecialchars($_SERVER['PHP_SELF']).'">

                                                <p class="descripcionVehiculo">Precio por dia '.$precio. ' <input type="number" class="diasAlquiler" id="diasAlquiler" name="diasAlquiler" placeholder="Dias" min="1" step="1" required></p>
                                                
                                                <select class="selects" name="seguros[]" id="seguros" multiple required>
                                                    <option >Seguros</option>
                                ';

                                                    require("../Negocio/segurosNegocio.php");

                                                    $segurosBL = new SegurosNegocio();
                                                    $datosSeguros = $segurosBL->obtener();

                                                    foreach($datosSeguros as $datosSeguro){
                                                        echo "<option data-precio=".$datosSeguro->getPrecio()." value=".$datosSeguro->getId().">".$datosSeguro->getSeguro()." ".$datosSeguro->getPrecio()."€</option>";
                                                    }
                                echo' 
                                                </select>

                                                <select class="selects" name="extras[]" id="extras" multiple required>
                                                    <option >Extras</option>
                                ';
                                                require("../Negocio/extrasNegocio.php");

                                                $extrasBL = new ExtrasNegocio();
                                                $datosExtras = $extrasBL->obtener();

                                                foreach($datosExtras as $datosExtra){
                                                    echo "<option data-precio=".$datosExtra->getPrecio()." value=".$datosExtra->getId().">".$datosExtra->getExtra()." Precio: ".$datosExtra->getPrecio()."</option>";
                                                }
                                echo'
                                                </select>

                                                <br>

                                                <p value"" class="descripcionVehiculo" id="textoDinamico"></p>

                                                <input id="IdUser" name="IdUser" value="'.$usuario.'" type="hidden">

                                                <input id="IdVehiculo" name="IdVehiculo" value="'.$vehiculo->getId().'" type="hidden">

                                                <input id="FechaInicio" name="FechaInicio" value="'.date('Y-m-d').'" type="hidden">

                                                <input id="TotalDelPrecio" name="TotalDelPrecio" value="" type="hidden">


                                                <button class="boton" type="submit">Alquilar</button>

                                            </form>

                                        </div>
                                        <div class="fotoAnuncio">
                                            <img class="fotoPrincipal" src="imagenes/FotosVehiculos/'.$vehiculo->getImagen().'.webp">
                                        </div>
                                ';
                            }
                        ?>
                </div>
            </div>
        </div>
        <div class="divPie"></div>
        </div>
    </div>
    <script>
        var precioAlquiler = <?php echo $precio; ?>;
    </script>
    <script src="js/JS_CompraVehiculo.js"></script>
</body>
</html>