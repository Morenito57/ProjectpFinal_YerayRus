<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    require("../AccesoDatos/gestionAlquileresAccesoDatos.php");
    class GestionAlquileresNegocio {

        function __construct(){
        }

        function insertarAlquiler($IdUser, $IdSeguros, $IdExtras, $IdVehiculo, $FechaInicio, $FechaFinal, $TotalDelPrecio) {
            $gestionDAL = new gestionAlquileresAccesoDatos();
            $res = $gestionDAL->insertarAlquiler($IdUser, $IdSeguros, $IdExtras, $IdVehiculo, $FechaInicio, $FechaFinal, $TotalDelPrecio);
            return $res;         
        }
    }
?>