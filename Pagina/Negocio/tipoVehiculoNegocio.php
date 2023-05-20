<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
require("../AccesoDatos/tipoVehiculoAccesoDatos.php");
    class TipoVehiculoReglasNegocio{
        private $_Id;
        private $_TipoVehiculo;

        
        function __construct(){
        }

        function init($id, $tipovehiculo){
            $this->_Id = $id;
            $this->_TipoVehiculo = $tipovehiculo;

        }

        function getId(){
            return $this->_Id;
        }

        function getTipoVehiculo(){
            return $this->_TipoVehiculo;
        }

        function obtener() {
            $tiposVehiculosDAL = new TipoVehiculoAccesoDatos();
            $results = $tiposVehiculosDAL->obtener();
            $listaTipoVehiculos =  array();

            foreach ($results as $tipoVehiculos) {
                $oTipoVehiculosReglasNegocio = new TipoVehiculoReglasNegocio();
                $oTipoVehiculosReglasNegocio->init($tipoVehiculos['Id'], $tipoVehiculos['TipoVehiculo']);
                array_push($listaTipoVehiculos,$oTipoVehiculosReglasNegocio);            
            }            
            return $listaTipoVehiculos;
        }

    }

?>