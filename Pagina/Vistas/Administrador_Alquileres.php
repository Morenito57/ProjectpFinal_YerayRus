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

            $id = $_POST['idAlquiler'];

            header("Location: Administrador_Alquileres_Gestion.php?id=".urlencode($id));
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
            width: 90%;
            margin-top: 30px;
            margin-bottom: 30px;
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
                        <option value="Alquiler.Id">IdAlquiler</option>
                        <option value="Alquiler.IdUser">IdUser</option>
                        <option value="Alquiler.IdVehiculo">IdVehiculo</option>
                        <option value="Cargo.Id">IdCargo</option>
                        <option value="Seguros.Id">IdSeguros</option>
                        <option value="Extras.Id">IdExtras</option>
                        <option value="Alquiler.FechaInicio">FechaInicio</option>
                        <option value="Alquiler.FechaFinal">FechaFinal</option>
                        <option value="Alquiler.TotalDelPrecio">TotalDelPrecio</option>
                        <option value="Alquiler.Estado">Estado</option>

                    </select>
                    <input type="text" id="busqueda" onkeyup="obtenerDatosAlquileres()" placeholder="Busca">
                    <select class="opcionesBuscador" id="opcionesBuscador" onchange="redirigirPagina()">
                        <option value=""></option>
                    </select>

                    <select class="pestaña" id="pestañaUsuarios" name="pestañaUsuarios" onchange="redirigirPagina()">
                        <option value="">Usuarios</option>
                        <option value="Administrador_Usuarios.php">Usuarios All</option>
                    </select>
                    <select class="pestaña" id="pestañaAlquileres" name="pestañaAlquileres" onchange="redirigirPagina()">
                        <option value="">Alquileres</option>
                        <option value="Administrador_Alquileres.php">Alquileres All</option>
                        <option value="Administrador_Extras.php">Extras</option>
                        <option value="Administrador_Seguros.php">Seguros</option>
<option value="Administrador_Cargos.php">Cargos</option>
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
                            <h1>Alquileres</h1>
                            <table>
                                <tr>
                                    <th><p class="clase">Id</p></th>
                                    <th><p class="clase">Id User</p></th>
                                    <th><p class="clase">Id Vehiculo</p></th>
                                    <th><p class="clase">Id Cargo</p></th>
                                    <th><p class="clase">Seguro Id </p></th> 
                                    <th><p class="clase">Extra Id </p></th> 
                                    <th><p class="clase">Fecha Inicio </p></th>
                                    <th><p class="clase">Fecha Final</p></th> 
                                    <th><p class="clase">Precio Total</p></th>
                                    <th><p class="clase">Activo</p></th> 
                                    <th><p class="clase">Acciones</p></th>
                                </tr>

                                <?php
                                    require ("../Negocio/alquileresNegocio.php");

                                    ini_set('display_errors', 'On');
                                    ini_set('html_errors', 0);

                                    $AlquilerBL = new AlquileresNegocio();
                                             
                                    $alquileres = $AlquilerBL->obtener();

                                    for ($i = 0; $i < count($alquileres); $i++) {

                                        $alquiler = $alquileres[$i];

                                        echo'
                                            <tr>
                                            <td ><p class="dato">'.$alquiler->getIdAlquiler().'</p></td>
                                            <td ><p class="dato">'.$alquiler->getIdUser().'</p></td>
                                            <td ><p class="dato">'.$alquiler->getIdVehiculo().'</p></td>
                                            <td ><p class="dato">'.$alquiler->getIdCargo().'</p></td>
                                            <td ><p class="dato">'.$alquiler->getIdSeguros().'</p></td>
                                            <td ><p class="dato">'.$alquiler->getIdExtras().'</p></td>
                                            <td ><p class="dato">'.$alquiler->getFechaInicio().'</p></td>
                                            <td ><p class="dato">'.$alquiler->getFechaFinal().'</p></td>
                                            <td ><p class="dato">'.$alquiler->getTotalDelPrecio().'</p></td>
                                            ';
                                            if($alquiler->getEstado() == 1){
                                                echo'<td ><p class="dato">Activo</p></td>';
                                            }else if($alquiler->getEstado() == ""){
                                                echo'<td ><p class="dato">Cancelado</p></td>';
                                            }
                                            else if($alquiler->getEstado() == 0){
                                                echo'<td ><p class="dato">No Activo</p></td>';
                                            }
                                            echo'
                                            <td >
                                                <p class="accion">
                                                    <form method = "POST">
                                                        <input id="idAlquiler" name="idAlquiler" value="'.$alquiler->getIdAlquiler().'" type="hidden">
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
    <script src="JS_Admin_Alquileres.js"></script>
</body>
</html>