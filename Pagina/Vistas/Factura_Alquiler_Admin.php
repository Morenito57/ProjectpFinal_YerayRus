<?php
    session_start();

    require ("../Negocio/facturaNegocio.php");

    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);

    if (!isset($_SESSION['usuario'])) {
        vheader("Location: loginVista.php");
    }
    $usuarioOriginal = $_SESSION['usuario'];

    if (isset($_GET['idAlquiler']) && isset($_GET['idUser'])) {

        $idAlquiler = $_GET['idAlquiler'];
        $idUser = $_GET['idUser'];

        $idAlquilerDecodificado = urldecode($idAlquiler);
        $idUserDecodificado = urldecode($idUser);
    } else {
        header("Location: loginVista.php");
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

        .divCabezeraCuerpo{
            width: 100%;
            padding-bottom: 50px;
        }

        .divRestoCuerpo{
            width: 100%;
        }

        .menu{
            margin: 0 auto;
            width: 95%;
        }

        .caja_area_personal{
            margin: auto;
            width: 80%;
            background-color: rgb(61, 9, 9);
            border: 5px solid rgb(173, 32, 32);
        }

        .contenido{
            width: 100%;
            overflow: auto;
        }

        h1{
            text-align: center;
            color: white;
            width: 90%;
            font-size: 40px;
            margin-top: 30px;
            margin-bottom: 30px;
            margin-left: 90px;
        }

        .infoCoche{
            width: 55%;
            height: 80%;
            float: left;
        }

        .imagenCoche{
            width: 45%;
            height: 80%;
            float: left;
        }

        .infoAlquiler{
            height: 20%;
            width: 100%;
        }

        .imagenVehiculo{
            width: 80%;
            height: 100%;
            margin-right: 100px;
            float: right;
            margin-top: 10px;
            margin-bottom: 10px;
            border: solid 5px rgb(173, 32, 32);
        }

        p{
            font-size: 25px;
            color: white;
        }

        .fila{
            margin-left: 100px;
            margin-bottom: 20px;
            font-weight: 1000;
        }

        .volver{
            padding: 20px;
            background-color: rgb(61, 9, 9);
            border: solid 5px rgb(173, 32, 32);
            color: white;
            font-size: 25px;
            margin-top: 2.9%;
            margin-right: 7.6%;
            float: right;
            text-decoration: none;
            font-weight: 1000;

        }
    </style>
</head>
<body>
    <div class="divPrincipal">
        <div class="divCabezera">
        </div>
        <div class="divCuerpo">
            <div class="divCabezeraCuerpo">
                <div class="menu">

                    <a href="Administrador_Alquileres.php" class="volver">Volver a alquileres</a>

                </div>
            </div>
            <div class="divRestoCuerpo">
                <div class="caja_area_personal">
                    <div class="contenido">
                        <h1>Factura</h1>

                        <?php

                            ini_set('display_errors', 'On');
                            ini_set('html_errors', 0);

                            $facturaBL = new FacturaNegocio();

                            $datosfactura = $facturaBL->obtener($idUserDecodificado, $idAlquilerDecodificado);   
                            echo'

                                <div class="datosCoche">
                                    <div class="infoCoche">
                                        <p class="fila">Nombre del Vehiculo: '.$datosfactura[0]->getVehiculoNombre().'</p>
                                        <p class="fila">Marca: '.$datosfactura[0]->getMarca().'</p>
                                        <p class="fila">Tipo de Vehiculo: '.$datosfactura[0]->getTipoVehiculo().'</p>
                                        <p class="fila">Matricula: '.$datosfactura[0]->getMatricula().'</p>
                                        <p class="fila">Caballos: '.$datosfactura[0]->getCaballos().'</p>
                                        <p class="fila">Plazas: '.$datosfactura[0]->getPlazas().'</p>
                                        <p class="fila">Año: '.$datosfactura[0]->getVehiculoAño().'</p>
                                        <p class="fila">Kilometros: '.$datosfactura[0]->getKilometros().'</p>
                                        <p class="fila">Precio por dia: '.$datosfactura[0]->getVehiculoPrecio().'</p>
                                        <p class="fila">Descripcion: '.$datosfactura[0]->getVehiculoDescripcion().'</p>
                                    </div>
                                    <div class="imagenCoche">
                                        <img class="imagenVehiculo" src="imagenes/FotosVehiculos/'.$datosfactura[0]->getVehiculoImagen().'.webp">
                                    </div>
                                </div>
                                <div class="infoAlquiler">
                                    <p class="fila">Id del Alquiler: '.$datosfactura[0]->getAlquilerId().'</p>
                                    <p class="fila">Fecha de inicio del Alquiler: '.$datosfactura[0]->getFechaInicio().'</p>
                                    <p class="fila">Fecha Final del Alquiler: '.$datosfactura[0]->getFechaFinal().'</p>
                                ';
                                $fechaInicio = new DateTime($datosfactura[0]->getFechaInicio());
                                $fechaFinal = new DateTime($datosfactura[0]->getFechaFinal());
                                $diferencia = $fechaInicio->diff($fechaFinal);
                                $numeroDias = $diferencia->days;

                                $precioVehiculo = $datosfactura[0]->getVehiculoPrecio();
                                $precioTotalDelVehiculo = $precioVehiculo*$numeroDias;

                                echo'
                                    <p class="fila">Total de dias Alquilados: '.$numeroDias.'</p>
                                    <p class="fila">Precio del alquiler del vehiculo: '.$precioTotalDelVehiculo.'</p>
                                    <p class="fila">Seguros y su precio:
                                ';
                                    foreach ($datosfactura as $factura) {
                                        echo $factura->getSegurosNombre().' '.$factura->getSegurosPrecio().'€';
                                    }
                                    
                                echo'
                                    </p>    
                                    <p class="fila">Extras y su precio: ';
                                    foreach ($datosfactura as $factura) {
                                        echo $factura->getExtrasNombre().' '.$factura->getExtrasPrecio().'€';
                                    }
                                echo'
                                    </p>
                                    <p class="fila">Total del alquiler: '.$datosfactura[0]->getTotalDelPrecio().'</p>
                                </div>

                            ';
                        ?>  
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
                        