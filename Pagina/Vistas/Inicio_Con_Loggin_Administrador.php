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
            height: 100%;
            border: 2px solid rgb(173, 32, 32);
            margin: auto;
            border-collapse: collapse;
            margin-bottom: 200px;
        }

        tr{
            width: 100%;
            height: 100%;
            border: 2px solid rgb(173, 32, 32);
        }

        th{
            width: 6%;
            height: 30px;
            border: 2px solid rgb(173, 32, 32);
            background-color: rgb(77, 5, 5);
            color: white;
        }

        td{
            width: 6%;
            height: 30px;
            border: 2px solid rgb(173, 32, 32);
            color: white;
            padding-left: 5px;
        }

        .accion{
            text-decoration: none;
            text-align: center;
        }

        .clase{
        }

        .dato{
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
                <div class="menu">
                    <label for="busqueda" class="lupa">🔎</label>
                    <input type="text" id="busqueda" onkeyup="obtenerDatos()" placeholder="Busca">
                    <select class="opcionesBuscador" id="opcionesBuscador" onchange="redirigirPagina()">
                        <option value=""></option>
                    </select>
                    <select class="pestaña" id="pestañaUsuarios" name="pestañaUsuarios" onchange="redirigirPagina()">
                        <option value="">Usuarios</option>
                    </select>
                    <select class="pestaña" id="pestañaAlquileres" name="pestañaAlquileres" onchange="redirigirPagina()">
                        <option value="">Alquileres</option>
                        <option value="">Extras</option>
                        <option value="">Seguros</option>
                        <option value="">Cargos</option>
                    </select>
                    <select class="pestaña" id="pestañaVehiculos" name="pestañaVehiculos" onchange="redirigirPagina()">
                        <option value="">Vehiculos</option>
                        <option value="">Tipo Vehiculo</option>
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
                        <form method = "POST" action = "'.htmlspecialchars($_SERVER['PHP_SELF']).'">
                            <h1>Usuarios</h1>
                            <a class="añadir" href="a">➕</a>
                            <table>
                                <tr>
                                    <th><p class="clase">Usuario </p></th>
                                    <th><p class="clase">Clave</p></th>
                                    <th><p class="clase">Saldo</p></th>
                                    <th><p class="clase">Tipo</p></th>
                                    <th><p class="clase">Id Contacto</p></th> 
                                    <th><p class="clase">Telefono</p></th> 
                                    <th><p class="clase">Email</p></th>
                                    <th><p class="clase">Otro</p></th>
                                    <th><p class="clase">Id Datos Per</p></th>
                                    <th><p class="clase">Nombre</p></th>
                                    <th><p class="clase">Apellidos</p></th>
                                    <th><p class="clase">Nacimiento</p></th>
                                    <th><p class="clase">Direccio</p></th>
                                    <th><p class="clase">DNI</p></th>
                                    <th><p class="clase">Acciones</p></th>
                                </tr>
                                <tr>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td ><p class="dato"></p></td>
                                    <td class="accion"><a class="accion" href="c">🔁</a><a class="accion" href="b">➖</a></td>
                                </tr>
                            </table>
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