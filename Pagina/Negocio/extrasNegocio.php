<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    require("../AccesoDatos/extrasAccesoDatos.php");
    
    class ExtrasNegocioNegocio{
        private $_Id;
        private $_Extra;
        private $_Precio;

        function __construct(){
        }

        function init($id, $extra, $precio){
            $this->_Id = $id;
            $this->_Extra = $extra;
            $this->_Precio = $precio;
        }

        function getId(){
            return $this->_Id;
        }

        function getExtra(){
            return $this->_Extra;
        }

        function getPrecio(){
            return $this->_Precio;
        }

        function obtener() {
            $extrasDAL = new ExtrasAccesoDatos();
            $results = $extrasDAL->obtener();
            $listaExtras =  array();

            foreach ($results as $extra) {
                $oExtrasReglasNegocio = new ExtrasNegocioNegocio();
                $oExtrasReglasNegocio->init($extra['Id'], $extra['Extra'], $extra['Precio']);
                array_push($listaExtras,$oExtrasReglasNegocio);            
            }            
            return $listaExtras;
        }

        function obtenerExtra($id) {
            $extrasDAL = new ExtrasAccesoDatos();
            $results = $extrasDAL->obtenerExtra($id);
            $listaExtras =  array();

            foreach ($results as $extra) {
                $oExtrasReglasNegocio = new ExtrasNegocioNegocio();
                $oExtrasReglasNegocio->init($extra['Id'], $extra['Extra'], $extra['Precio']);
                array_push($listaExtras,$oExtrasReglasNegocio);            
            }            
            return $listaExtras;
        }

        function eliminarExtra($id) {
            $extrasDAL = new ExtrasAccesoDatos();
            $results = $extrasDAL->eliminarExtra($id);
            return $results;
        }

        function actualizarExtra($id, $extra, $precio) {
            $extrasDAL = new ExtrasAccesoDatos();
            $results = $extrasDAL->actualizarExtra($id, $extra, $precio);
            return $results;
        }

    }

?>