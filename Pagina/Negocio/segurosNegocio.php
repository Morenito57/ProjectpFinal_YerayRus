<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    require("../AccesoDatos/segurosAccesoDatos.php");
    class SegurosNegocio{
        private $_Id;
        private $_Seguro;
        private $_Precio;

        function __construct(){
        }

        function init($id, $seguro, $precio){
            $this->_Id = $id;
            $this->_Seguro = $seguro;
            $this->_Precio = $precio;
        }

        function getId(){
            return $this->_Id;
        }

        function getSeguro(){
            return $this->_Seguro;
        }

        function getPrecio(){
            return $this->_Precio;
        }

        function obtener() {
            $seguroDAL = new SegurosAccesoDatos();
            $results = $seguroDAL->obtener();
            $listaSeguro =  array();

            foreach ($results as $seguro) {
                $oSeguroReglasNegocio = new SegurosNegocio();
                $oSeguroReglasNegocio->init($seguro['Id'], $seguro['Seguro'], $seguro['Precio']);
                array_push($listaSeguro,$oSeguroReglasNegocio);            
            }            
            return $listaSeguro;
        }

        function obtenerSeguro($id) {
            $seguroDAL = new SegurosAccesoDatos();
            $results = $seguroDAL->obtenerSeguro($id);
            $listaSeguro =  array();

            foreach ($results as $seguro) {
                $oSeguroReglasNegocio = new SegurosNegocio();
                $oSeguroReglasNegocio->init($seguro['Id'], $seguro['Seguro'], $seguro['Precio']);
                array_push($listaSeguro,$oSeguroReglasNegocio);            
            }            
            return $listaSeguro;
        }
        function eliminarSeguro($id){
            $seguroDAL = new SegurosAccesoDatos();
            $results = $seguroDAL->eliminarSeguro($id);
            return $results;
        }

    }

?>