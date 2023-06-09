<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    require("../AccesoDatos/tipoVehiculoAccesoDatos.php");
    class TipoVehiculoNegocio{
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
            $listaTipoVehiculos = array();
            
            foreach ($results as $tipoVehiculos) {
                $oTipoVehiculosReglasNegocio = new TipoVehiculoNegocio();
                $oTipoVehiculosReglasNegocio->init($tipoVehiculos['Id'], $tipoVehiculos['TipoVehiculo']);
                array_push($listaTipoVehiculos, $oTipoVehiculosReglasNegocio);
            }
            
            return $listaTipoVehiculos;
        }

        function obtenerTipoVehiculo($idDecodificado) {
            $tiposVehiculosDAL = new TipoVehiculoAccesoDatos();
            $results = $tiposVehiculosDAL->obtenerTipoVehiculo($idDecodificado);
            $listaTipoVehiculos = array();

            foreach ($results as $tipoVehiculos) {
                $oTipoVehiculosReglasNegocio = new TipoVehiculoNegocio();
                $oTipoVehiculosReglasNegocio->init($tipoVehiculos['Id'], $tipoVehiculos['TipoVehiculo']);
                array_push($listaTipoVehiculos,$oTipoVehiculosReglasNegocio);            
            }            
            return $listaTipoVehiculos;
        }

        function eliminarTipoVehiculo($idDecodificado) {
            $vehiculosDAL = new TipoVehiculoAccesoDatos();
            $results = $vehiculosDAL->eliminarTipoVehiculo($idDecodificado);
            return $results;
        }

        function actualizarTipoVehiculoComoAdmin($id, $tipoVehiculo) {
            $vehiculosDAL = new TipoVehiculoAccesoDatos();
            $results = $vehiculosDAL->actualizarTipoVehiculoComoAdmin($id, $tipoVehiculo);
            return $results;
        }

        function creacionTipoVehiculo($tipoVehiculo){
            $vehiculosDAL = new TipoVehiculoAccesoDatos();
            $results = $vehiculosDAL->creacionTipoVehiculo($tipoVehiculo);
            return $results;
        }

    }

?>