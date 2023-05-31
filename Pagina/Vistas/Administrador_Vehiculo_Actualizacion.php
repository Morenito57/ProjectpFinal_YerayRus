<?php
    session_start();

    require ("../Negocio/vehiculoReglasNegocio.php");

    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);

    if (!isset($_SESSION['usuario'])) {
        header("Location: loginVista.php");
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $idDecodificado = urldecode($id);
    } else {
        header("Location: Administrador_Vehiculos.php");
    }

    if($_SERVER["REQUEST_METHOD"]=="POST") {

        $usuarioBL = new VehiculosReglasNegocio();

        $perfil =  $usuarioBL->actualizarVehiculoAdmin( $_POST['idVehiculo'] ,$_POST['nombre'], $_POST['imagen'], $_POST['marca'], $_POST['matricula'], $_POST['año'], $_POST['caballos'], $_POST['kilometros'], $_POST['plazas'], $_POST['estado'], $_POST['precio'], $_POST['descripcion'], $_POST['idTipoVehiculo']);

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
                        <h1>Actualizar Vehiculo</h1>
                        <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <?php
                            ini_set('display_errors', 'On');
                            ini_set('html_errors', 0);

                            $vehiculoBL = new VehiculosReglasNegocio();
                                    
                            $datosVehiculo = $vehiculoBL->obtenerVehiculoConcreto($idDecodificado); 

                            echo'
                                <table class="tabla_datos">
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Nombre: <span class="datosUser">'.$datosVehiculo[0]->getNombre().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="nombre" name="nombre" placeholder="Nombre" pattern="[A-Za-z0-25áéíóúÁÉÍÓÚñÑ\s]+" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Imagen: <span class="datosUser">'.$datosVehiculo[0]->getImagen().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="imagen" name="imagen" placeholder="Imagen" pattern="^[A-Za-z0-9]{1,25}$" >
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Marca: <span class="datosUser">'.$datosVehiculo[0]->getMarca().'</span></p> 
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="marca" name="marca" placeholder="Marca" pattern="^[A-Za-z0-9]{1,25}$">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Matricula: <span class="datosUser">'.$datosVehiculo[0]->getMatricula().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="matricula" name="matricula" placeholder="Matricula" pattern="^[A-Za-z0-9]{1,25}$">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Año: <span class="datosUser">'.$datosVehiculo[0]->getAño().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="number" class="inputs" id="año" name="año" placeholder="Año" max="'.date('Y-m-d').'">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Caballos: <span class="datosUser">'.$datosVehiculo[0]->getCaballos().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="number" class="inputs" id="caballos" name="caballos" placeholder="Caballos" min="1" max="2000">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Kilometros: <span class="datosUser">'.$datosVehiculo[0]->getKilometros().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="number" class="inputs" id="kilometros" name="kilometros" placeholder="Kilometros" min="1" max="99999999999">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Plazas: <span class="datosUser">'.$datosVehiculo[0]->getPlazas().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="number" class="inputs" id="plazas" name="plazas" placeholder="Plazas" min="1" max="40">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">;

                                            ';
                                                if($datosVehiculo[0]->getEstado() == 1){
                                                    echo'<p class="datos_guardados">Activo: <span class="datosUser">True</span></p>';
                                                }else{
                                                    echo'<p class="datos_guardados">Activo: <span class="datosUser">False</span></p>';
                                                }
                                        echo'
                                        </td>
                                        <td class="td_datos_input">
                                            <p class="datos_guardados">True <input type="radio" class="inputs" id="estado" name="estado" value="1"></p>
                                            <p class="datos_guardados">False <input type="radio" class="inputs" id="estadoFalse" name="estado" value="0"></p>
                                        </td>

                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Precio: <span class="datosUser">'.$datosVehiculo[0]->getPrecio().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="number" class="inputs" id="precio" name="precio" placeholder="Precio" min="1" max="9999999">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Descripcion: <span class="datosUser">'.$datosVehiculo[0]->getDescripcion().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="text" class="inputs" id="descripcion" name="descripcion" placeholder="Descripcion" min="1" max="500">
                                        </td>
                                    </tr>
                                    <tr class="tr_datos">
                                        <td class="td_datos_texto">
                                            <p class="datos_guardados">Id Tipo Vehiculo: <span class="datosUser">'.$datosVehiculo[0]->getTipoVehiculo().' que es : '.$datosVehiculo[0]->getIdTipoVehiculo().'</span></p>
                                        </td>
                                        <td class="td_datos_input">
                                            <input type="number" class="inputs" id="idTipoVehiculo" name="idTipoVehiculo" placeholder="Id Tipo Vehiculo" min="1" max="9999">
                                        </td>
                                    </tr>
                                    <input id="idVehiculo" name="idVehiculo" value="'.$datosVehiculo[0]->getId().'" type="hidden">

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