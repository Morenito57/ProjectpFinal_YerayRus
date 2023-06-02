<?php
    session_start();

    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);

    $usuario = $_SESSION['usuario'];

    if (!isset($_SESSION['usuario'])) {
        header("Location: loginVista.php");
    }

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        if(isset($_POST['Gestionar'])) {

            $id = $_POST['idSeguro'];

            header("Location: Administrador_Sugros_Gestion.php?id=".urlencode($id));
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

        .opcionesOrden{
            margin-top: 26px;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 10px;
            padding-left: 10px;
            font-size: 25px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            color: white;
            float: right;
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
            margin-top: 30px;
            width: 90%;
            margin-left: 90px;
        }

        .añadir{
            margin-bottom: 30px;
            text-decoration: none;
            float: right;
            margin-right: 25px;
            font-size: 40px;
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
            padding: 0%;
            margin: 0%;
        }

        .Gestionar{
            height: 100%;
            width: 100%;
            padding: 15px;
            background-color: rgb(61, 9, 9);
            color: white;
        }

        .clase{
        }

        .dato{
            padding-left: 5px;
        }

        .imagenVehiculo{
            height: 100px;
            width: 100%;
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

                    <select class="opcionesOrden" id="opcionesOrden" name="opcionesOrden" onchange="redirigirPagina()">
                        <option value="" >Ordenar</option>
                        <option value="" >Edad</option>
                        <option value="" >Ordenar</option>
                    </select>

                </div>
            </div>
            <div class="divRestoCuerpo">
                <div class="caja_area_personal">
                    <div class="contenido">
                            <h1>Seguros</h1>
                            <a class="añadir" href="Administrador_Seguros_Crear.php">➕</a>
                            <table>
                                <tr>
                                    <th><p class="clase">Id</p></th>
                                    <th><p class="clase">Seguro</p></th>
                                    <th><p class="clase">Precio</p></th>
                                    <th><p class="clase">Acciones</p></th>
                                </tr>

                                <?php
                                    require ("../Negocio/segurosNegocio.php");

                                    ini_set('display_errors', 'On');
                                    ini_set('html_errors', 0);

                                    $seguroBL = new SegurosNegocio();
                                             
                                    $seguros = $seguroBL->obtener();

                                    for ($i = 0; $i < count($seguros); $i++) {

                                        $seguro = $seguros[$i];

                                        echo'
                                            <tr>
                                                <td ><p class="dato">'.$seguro->getId().'</p></td>
                                                <td ><p class="dato">'.$seguro->getSeguro().'</p></td>
                                                <td ><p class="dato">'.$seguro->getPrecio().'</p></td>
                                                <td >
                                                    <p class="accion">
                                                        <form method = "POST">
                                                            <input id="idSeguro" name="idSeguro" value="'.$seguro->getId().'" type="hidden">
                                                            <input type="submit" name="Gestionar" class="Gestionar" value="Gestionar">
                                                        </form>
                                                    </p>
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