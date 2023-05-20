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
            height: 1000px;
        }
        .divCabezera{
            width: 101%;
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
            margin-bottom: 50px;
        }
        .portada{
            width: 100%;
            height: 100%;
        }
        .botonCategoria{
            margin-right: 40px;
            padding: 20px;
            padding-left: 40px;
            padding-right: 40px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            text-decoration: none;
            color: white;
        }
        .divRestoCuerpo{
            margin: auto;
            margin-top: 20px;
            width: 80%;
            height: 100%;
        }
        
        .cuadroAnuncios{
            background-color: rgb(61, 9, 9);
            width: 100%;
            height: 100%;
            border: 5px solid rgb(173, 32, 32);
            padding-top: 25px;
            padding-bottom: 100px;
            padding-left: 25px;
            margin-top: 25px;
        }

        .divOrdenar{
            width: 100%;
            height: 5%;
        }
        .botonOrdenar{
            float: right;
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 40px;
            padding-right: 40px;
            margin-right: 50px;
            background-color: rgb(61, 9, 9);
            text-decoration: none;
            color: white;
            border: 3px solid rgb(173, 32, 32);
        }
        .anuncio{
            width: 29%;
            height: 30%;
            float: left;
            margin: 25px;
            border: 4px solid black;
        }
        .fotoAnuncio{
            width: 100%;
            height: 85%;
        }

        .imagenVehiculo{
            width: 100%; 
            height: 182%;
            clip-path: inset(0 0 45% 0);
        }

        .detallesAnuncio{
            width: 100%;
            height: 15%;
        }
        .nombre{
            float: left;
            width: 70%;
            height: 100%;
            color: white;
            background-color: black;
        }
        .precio{
            float: left;
            width: 30%;
            height: 88%;
            background-color: rgb(173, 32, 32);
            text-align: center;
            color: white;
            border-top: 5px black solid; 
        }

        .texto_descripcion{
            margin-left: 25px;
            margin-top: 15px;
        }

        .enlace_compra{
            text-decoration: underline;
            color: white;
        }

        .texto_precio{
            margin: 0 auto;
            margin-top: 10px;
        }

        .divPie{
            width: 100%;
            height: 10%;
        }
        .pestanas{
            margin-top: 400px;
            text-align: center;
        }
        .botonPestanas{
            padding: 20px;
            background-color: rgb(61, 9, 9);
            text-decoration: none;
            color: white;
            border: 3px solid rgb(173, 32, 32);
            border-radius: 50px;
        }

        .inicioSesion{
            color: white;
            font-size: 25px;
            float: right;
            margin-right: 220px;
        }

        #busqueda{
            padding-left: 40px;
            padding-right: 40px;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 25px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            color: white;
        
        }

        .lupa{
            font-size: 25px;
        }

        .opcionesBuscador{
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 25px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            color: white;
        }

        .opcionesOrden{
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 25px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            color: white;
            float: right;
        }

        .opcionesTipoVehiculo{
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 25px;
            background-color: rgb(61, 9, 9);
            border: 3px solid rgb(173, 32, 32);
            color: white;
            float: left;
            margin-left: 11.2%;
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
                <select class="opcionesTipoVehiculo" id="opcionesTipoVehiculo" onchange="redirigirPagina()">
                <option value="">Categoria</option>
                <?php
                      require("../Negocio/tipoVehiculoNegocio.php");
                      ini_set('display_errors', 'On');
                      ini_set('html_errors', 0);
                      $tipoVehiculosBL = new TipoVehiculoReglasNegocio();
                      $datosTipoVehiculos = $tipoVehiculosBL->obtener();
                      echo "<option value=Inicio_Con_Loggin.php>Todos</option>";
                      foreach($datosTipoVehiculos as $datosTipoVehiculo){
                        echo "<option value=Inicio_Con_Loggin.php?tipoVehiculo=".$datosTipoVehiculo->getId().">".$datosTipoVehiculo->getTipoVehiculo()."</option>";
                      }
                ?>
                </select>
                <a class="inicioSesion" href="Area_Personal_Datos_Personales.html">Zona Socio</a>
            </div>
            <div class="divRestoCuerpo">
                <div class="divOrdenar">
                    <label for="busqueda" class="lupa">🔎</label>
                    <input type="text" id="busqueda" onkeyup="obtenerDatos()" placeholder="Busca">
                    <select class="opcionesBuscador" id="opcionesBuscador" onchange="redirigirPagina()">
                        <option value=""></option>
                    </select>
                    <select class="opcionesOrden" id="opcionesOrden" onchange="redirigirPagina()">
                        <option value="" >Ordenar</option>
                        <?php
                            $fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                            $url_parts = parse_url($fullUrl);

                            parse_str($url_parts['query'], $query_params);

                            if(!array_key_exists('orden', $query_params)) {
                                if(empty($query_params)){

                                    echo('
                                        <option value="Inicio_Con_Loggin.php">Por defecto</option>
                                        <option value="Inicio_Con_Loggin.php?orden=1">Ordenar por precio + a -</option>
                                        <option value="Inicio_Con_Loggin.php?orden=2">Ordenar por precio - a +</option>                            
                                    ');
                                } else {
                                    echo('
                                        <option value="Inicio_Con_Loggin.php">Por defecto</option>
                                        <option value="'.$fullUrl.'&orden=1">Ordenar por precio + a -</option>
                                        <option value="'.$fullUrl.'&orden=2">Ordenar por precio - a +</option>                            
                                    ');
                                }
                            } else {
                                $query_params['orden'] = 1; 

                                $new_query_str = http_build_query($query_params);

                                $new_url = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?' . $new_query_str;

                                echo('
                                    <option value="Inicio_Con_Loggin.php">Por defecto</option>
                                    <option value="'.$new_url.'">Ordenar por precio + a -</option>');

                                $query_params['orden'] = 2; 

                                $new_query_str = http_build_query($query_params);
                                $new_url = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?' . $new_query_str;

                                echo('<option value="'.$new_url.'">Ordenar por precio - a +</option>'); 
                            }
                        ?>
                    </select>
                </div>
                <div class="cuadroAnuncios">

                    <?php
                        require("../Negocio/vehiculoReglasNegocio.php");
                        ini_set('display_errors', 'On');
                        ini_set('html_errors', 0);
                        $vehiculosBL = new VehiculosReglasNegocio();
                        $datosVehiculos = $vehiculosBL->obtener();
                        $pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : 1;
                        $datosPagina = ($pagina * 9 - 9);
                            for ($i = 0 ; $i < 9; $i++) { 
                                if(!isset($datosVehiculos[$datosPagina])){
                                    break;
                                }else{
                                echo "
                                    <div class='anuncio'>
                                        <div class='fotoAnuncio'>
                                            <img class='imagenVehiculo' src='imagenes/FotosVehiculos/".$datosVehiculos[$datosPagina]->getImagen().".webp'>
                                        </div>
                                        <div class='detallesAnuncio'>
                                            <div class='nombre'>
                                                <a class='enlace_compra' href='pantallaCompra_Loggin.php?id=".$datosVehiculos[$datosPagina]->getId()."'>
                                                    <p class='texto_descripcion'>".$datosVehiculos[$datosPagina]->getNombre()."</p>
                                                </a>
                                            </div>
                                            <div class='precio'>
                                                <p class='texto_precio'>".$datosVehiculos[$datosPagina]->getPrecio()."€</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                ";
                                $datosPagina++;
                                }
                        }
                        
                    ?>

                </div>
            </div>
        </div>
        <div class="divPie">

            <div class="pestanas">
                <a class="botonPestanas" id="anterior" href=""><--</a>
                <a class="botonPestanas" id="siguiente" href="">--></a>

                <script>

                    var urlActual = window.location.href;

                    var paginaActual = parseInt(getQueryStringValue("pagina"));

                    var totalDatosVehiculos = <?php echo count($datosVehiculos); ?>;

                    if (isNaN(paginaActual)) {
                        paginaActual = 1;
                    }

                    if (paginaActual > 1) {
                        document.getElementById("anterior").href = updateQueryStringParameter(urlActual, "pagina", paginaActual - 1);
                    }
                    
                    if(paginaActual < totalDatosVehiculos/9){
                    document.getElementById("siguiente").href = updateQueryStringParameter(urlActual, "pagina", paginaActual + 1);
                    }
                    
                    function getQueryStringValue(key) {
                        var urlParams = new URLSearchParams(window.location.search);
                        return urlParams.get(key);
                    }

                    function updateQueryStringParameter(uri, key, value) {
                        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                        var separator = uri.indexOf("?") !== -1 ? "&" : "?";
                        if (uri.match(re)) {
                        return uri.replace(re, "$1" + key + "=" + value + "$2");
                        } else {
                        return uri + separator + key + "=" + value;
                        }
                    }
                </script>

            </div>
        </div>
    </div>
    <script src="Inicio_Con_Loggin.js"></script>
</body>
</html> 