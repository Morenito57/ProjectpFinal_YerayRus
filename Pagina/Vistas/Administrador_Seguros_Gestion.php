<?php
    session_start();

    require ("../Negocio/segurosNegocio.php");

    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);

    if (!isset($_SESSION['usuario'])) {
        header("Location: loginVista.php");
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $idDecodificado = urldecode($id);
    } else {
        header("Location: Administrador_Seguros.php");
    }

    if($_SERVER["REQUEST_METHOD"]=="POST") {

        if (isset($_POST['eliminar'])) {

            $permiso = $_POST['permiso'];

            if ($permiso == "1") {
                $id = $_POST['idSeguro'];

                $seguroBL = new SegurosNegocio();

                $coche =  $seguroBL->eliminarSeguro($id);
            }else{
                echo '<script>alert("Error.");</script>';
            }
        }elseif (isset($_POST['actualizar'])){

            $Usuario = $_POST['idSeguro'];
            
            header("Location: Administrador_Seguros_Actualizacion.php?id=".urlencode($Usuario));
            
            exit();
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

        html, body {
            height: 100%;
        }

        body{
            background-color: rgb(77, 5, 5);
        } 
        .divPrincipal{
            width: 100%;
            height: 100%;
        }
        .divCabezera{
            width: 100%;
            height: 45%;
        }

        .divCuerpo{
            width: 100%;
            height: 50%;
        }

        .divPie{
            width: 100%;
            height: 5%;
        }

        .portada{
            width: 100%;
            height: 100%;
            border-bottom: 5px solid rgb(173, 32, 32);
        }

        .divCabezeraCuerpo{
            width: 100%;
            height: 25%;
            text-align: center;
        }

        .divRestoCuerpo{
            width: 100%;
            height: 73%;
        }

        .menu{
            margin: 0 auto;
            width: 95%;
            height: 100%;
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

        .lupa{
            font-size: 25px;
            float: left;
            margin-top: 35px;
        }

        #busqueda{
            margin-top: 26px;
            padding-left: 40px;
            padding-right: 40px;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 25px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            color: white;
            float: left;
        }

        .opcionesBuscador{
            margin-top: 26px;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 25px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            color: white;
            float: left;
        }

        .caja_area_personal{
            margin: auto;
            width: 95%;
            height: 100%;
            background-color: rgb(61, 9, 9);
            border: 5px solid rgb(173, 32, 32);
        }

        .contenido{
            width: 100%;
            height: 100%;
            overflow: auto;
        }

        h1{
            text-align: center;
            color: white;
            width: 90%;
            margin-top: 30px;
            margin-bottom: 30px;
            margin-left: 90px;
        }

        table{
            width: 99%;
            border: 2px solid rgb(173, 32, 32);
            margin: auto;
            border-collapse: collapse;
            margin-bottom: 200px;
        }

        tr{
            border: 2px solid rgb(173, 32, 32);
        }

        th{
            width: 6%;
            height: 35px;
            border: 2px solid rgb(173, 32, 32);
            background-color: rgb(77, 5, 5);
            color: white;
        }

        td{
            width: 6%;
            height: 30px;
            border: 2px solid rgb(173, 32, 32);
            color: white;
        }

        .accion{
            text-decoration: none;
            text-align: center;
        }

        .Gestionar{
            height: 100%;
            width: 100%;
            padding: 15px;
            background-color: rgb(61, 9, 9);
            color: white;
        }
        .Eliminar{
            background-color: rgb(61, 9, 9);
        }

        .Actualizar{
            background-color: rgb(61, 9, 9);
        }

        .imagenVehiculo{
            height: 100px;
            width: 100%;
        }

        .clase{
        }

        .dato{
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

                <label for="busqueda" class="lupa">🔎</label>
                    <select class="opcionesBuscador" id="opcionesTablaBuscador">
                        <option value=""></option>
                        <option value="Id">Id</option>
                        <option value="Seguro">Seguro</option>
                        <option value="Precio">Precio</option>
                    </select>
                    <input type="text" id="busqueda" onkeyup="obtenerDatosSeguros()" placeholder="Busca">
                    <select class="opcionesBuscador" id="opcionesBuscador" onchange="redirigirPagina()">
                        <option value=""></option>
                    </select>

                    <select class="pestaña" id="pestañaUsuarios" name="pestañaUsuarios" onchange="redirigirPagina()">
                        <option value="">Usuarios</option>
                        <option value="Administrador_Usuarios.php">Usuarios All</option>
                    </select>
                    <select class="pestaña" id="pestañaAlquileres" name="pestañaAlquileres" onchange="redirigirPagina()">
                        <option value="">Alquileres</option>
                        <option value="">Alquileres All</option>
                        <option value="Administrador_Extras.php">Extras</option>
                        <option value="Administrador_Seguros.php">Seguros</option>
                        <option value="">Cargos</option>
                    </select>
                    <select class="pestaña" id="pestañaVehiculos" name="pestañaVehiculos" onchange="redirigirPagina()">
                        <option value="">Vehiculos</option>
                        <option value="Administrador_Vehiculos.php">Vehiculos All</option>
                        <option value="Administrador_TipoVehiculo.php">Tipo Vehiculo</option>
                    </select>

                </div>
            </div>
            <div class="divRestoCuerpo">
                <div class="caja_area_personal">
                    <div class="contenido">
                            <h1>Gestion Seguro</h1>
                            <table>
                                <tr>
                                <th><p class="clase">Id</p></th>
                                    <th><p class="clase">Seguro</p></th>
                                    <th><p class="clase">Precio</p></th>
                                    <th><p class="clase">Acciones</p></th>
                                </tr>

                                <?php

                                    ini_set('display_errors', 'On');
                                    ini_set('html_errors', 0);

                                    $seguroBL = new SegurosNegocio();
                                             
                                    $seguros = $seguroBL->obtenerSeguro($idDecodificado);

                                    for ($i = 0; $i < count($seguros); $i++) {

                                        $seguro = $seguros[$i];

                                        echo'
                                            <tr>
                                            <td ><p class="dato">'.$seguro->getId().'</p></td>
                                            <td ><p class="dato">'.$seguro->getSeguro().'</p></td>
                                            <td ><p class="dato">'.$seguro->getPrecio().'</p></td>
                                            <td class="accion">
                                                <p class="accion">
                                                    <form method = "POST" action = "'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                                                        <input id="permiso" name="permiso" value="" type="hidden">

                                                        <input type="submit" id="actualizar" name="actualizar" class="Actualizar" value="🔁">

                                                        <input id="idSeguro" name="idSeguro" value="'.$seguro->getId().'" type="hidden">

                                                        <input type="submit" id="eliminar" name="eliminar" class="Eliminar" value="➖" onclick="eliminarSeguro()">
                                                    </form>
                                                <p>
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
        <div class="divPie">
        </div>
        </div>
    </div>
    <script src="JS_Admin_Seguros.js"></script>
</body>
</html>