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

            $id = $_POST['idUsuario'];

            header("Location: Administrador_Usuario_Gestion.php?id=".urlencode($id));
        }elseif(isset($_POST['deslogearse'])) {  

            require ("../Negocio/usuarioReglasNegocio.php");

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

        .boton_area{
            text-decoration: none;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 10px;
            padding-left: 10px;
            float: right;
            color: white;
            font-size: 25px;
            border: 5px solid rgb(173, 32, 32); 
            background-color: rgb(61, 9, 9); 
            margin-bottom: 50px;
        }

    </style>
</head>
<body>
    <div class="divPrincipal">
        <div class="divCabezera">
            <img class="portada" src="imagenes/Portada.png"> 
        </div>
        <div class="divCuerpo">
            <form class="cerrarSesion" method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="submit" name="deslogearse" class="boton_area" value="Cerrar Sesion">
            </form>
            <div class="divCabezeraCuerpo">
                <div class="menu">
                    <label for="busqueda" class="lupa">🔎</label>
                    <select class="opcionesBuscador" id="opcionesTablaBuscador">
                        <option value=""></option>
                        <option value="Usuario.NombreUsuario">Usuario</option>
                        <option value="Usuario.Clave">Clave</option>
                        <option value="Usuario.Saldo">Saldo</option>
                        <option value="Usuario.TipoDeUsuario">Tipo</option>
                        <option value="Usuario.Activo">Activo</option>
                        <option value="Usuario.IdDatosContacto">Id Contacto</option>
                        <option value="DatosContacto.Telefono">Telefono</option>
                        <option value="DatosContacto.Email">Email</option>
                        <option value="DatosContacto.Otro">Otro</option>
                        <option value="Usuario.IdDatosPersonales">Id Datos Per</option>
                        <option value="DatosPersonales.Nombre">Nombre</option>
                        <option value="DatosPersonales.Apellidos">Apellidos</option>
                        <option value="DatosPersonales.FechaNacimiento">Nacimiento</option>
                        <option value="DatosPersonales.Direccion">Direccio</option>
                        <option value="DatosPersonales.DNI">DNI</option>
                    </select>
                    <input type="text" id="busqueda" onkeyup="obtenerUsuario()" placeholder="Busca">
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
                            <h1>Usuarios</h1>
                            <a class="añadir" href="Administrador_Usuario_Crear.php">➕</a>
                            <table>
                                <tr>
                                    <th><p class="clase">Usuario </p></th>
                                    <th><p class="clase">Clave</p></th>
                                    <th><p class="clase">Saldo</p></th>
                                    <th><p class="clase">Tipo</p></th>
                                    <th><p class="clase">Activo</p></th>
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

                                <?php
                                    require ("../Negocio/usuarioReglasNegocio.php");

                                    ini_set('display_errors', 'On');
                                    ini_set('html_errors', 0);
        
                                    $alquilerBL = new UsuarioReglasNegocio();
                                             
                                    $datosUsuario = $alquilerBL->obtenerAllUsuario();

                                    for ($i = 0; $i < count($datosUsuario); $i++) {

                                        $Usuario = $datosUsuario[$i];

                                        echo'
                                            <tr>
                                                <td ><p class="dato">'.$Usuario->getNombreUsuario().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getClave().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getSaldo().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getTipoDeUsuario().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getActivo().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getIdDatosContacto().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getTelefono().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getEmail().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getOtro().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getIdDatosPersonales().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getNombre().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getApellidos().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getFechaNacimiento().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getDireccion().'</p></td>
                                                <td ><p class="dato">'.$Usuario->getDNI().'</p></td>
                                                <td>
                                                    <p class="accion">

                                                        <form method = "POST">
                                                            <input id="idUsuario" name="idUsuario" value="'.$Usuario->getNombreUsuario().'" type="hidden">
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
    <script src="js/JS_Admin.js"></script>
</body>
</html>