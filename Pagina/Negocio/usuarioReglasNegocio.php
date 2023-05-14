<?php
    require("../AccesoDatos/usuarioAccesoDatos.php");

    class UsuarioReglasNegocio {
        function __construct() {
        }
        function verificar($usuario, $clave) {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->verificar($usuario,$clave);           
            return $res;            
        }
}