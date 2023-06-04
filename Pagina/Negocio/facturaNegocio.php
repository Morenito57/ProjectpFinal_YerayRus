<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    require("../AccesoDatos/facturaAccesoDatos.php");

    class FacturaNegocio {
        private $_alquilerId;
        private $_userId;
        private $_vehiculoId;
        private $_fechaInicio;
        private $_fechaFinal;
        private $_totalDelPrecio;
        private $_tipoVehiculo;
        private $_vehiculoImagen;
        private $_marca;
        private $_vehiculoNombre;
        private $_matricula;
        private $_caballos;
        private $_kilometros;
        private $_plazas;
        private $_vehiculoAño;
        private $_vehiculoPrecio;
        private $_vehiculoEstado;
        private $_vehiculoDescripcion;
        private $_extrasNombre;
        private $_extrasPrecio;
        private $_segurosNombre;
        private $_segurosPrecio;

        function __construct() {
        }
    
        function init($alquilerId, $userId, $vehiculoId, $fechaInicio, $fechaFinal, $totalDelPrecio, $tipoVehiculo, $vehiculoImagen, $marca, $vehiculoNombre, $matricula, $caballos, $kilometros, $plazas, $vehiculoAño, $vehiculoPrecio, $vehiculoEstado, $vehiculoDescripcion, $extrasNombre, $extrasPrecio, $segurosNombre, $segurosPrecio) {
            $this->_alquilerId = $alquilerId;
            $this->_userId = $userId;
            $this->_vehiculoId = $vehiculoId;
            $this->_fechaInicio = $fechaInicio;
            $this->_fechaFinal = $fechaFinal;
            $this->_totalDelPrecio = $totalDelPrecio;
            $this->_tipoVehiculo = $tipoVehiculo;
            $this->_vehiculoImagen = $vehiculoImagen;
            $this->_marca = $marca;
            $this->_vehiculoNombre = $vehiculoNombre;
            $this->_matricula = $matricula;
            $this->_caballos = $caballos;
            $this->_kilometros = $kilometros;
            $this->_plazas = $plazas;
            $this->_vehiculoAño = $vehiculoAño;
            $this->_vehiculoPrecio = $vehiculoPrecio;
            $this->_vehiculoEstado = $vehiculoEstado;
            $this->_vehiculoDescripcion = $vehiculoDescripcion;
            $this->_extrasNombre = $extrasNombre;
            $this->_extrasPrecio = $extrasPrecio;
            $this->_segurosNombre = $segurosNombre;
            $this->_segurosPrecio = $segurosPrecio;
        }
        
        function getAlquilerId() {
            return $this->_alquilerId;
        }
    
        function getUserId() {
            return $this->_userId;
        }

        function getVehiculoId() {
            return $this->_vehiculoId;
        }

        function getFechaInicio() {
            return $this->_fechaInicio;
        }
    
        function getFechaFinal() {
            return $this->_fechaFinal;
        }
    
        function getTotalDelPrecio() {
            return $this->_totalDelPrecio;
        }
        
        function getTipoVehiculo() {
            return $this->_tipoVehiculo;
        }
        
        function getVehiculoImagen() {
            return $this->_vehiculoImagen;
        }
        
        function getMarca() {
            return $this->_marca;
        }
        
        function getVehiculoNombre() {
            return $this->_vehiculoNombre;
        }

        function getMatricula() {
            return $this->_matricula;
        }
    
        function getCaballos() {
            return $this->_caballos;
        }
    
        function getKilometros() {
            return $this->_kilometros;
        }
    
        function getPlazas() {
            return $this->_plazas;
        }
    
        function getVehiculoAño() {
            return $this->_vehiculoAño;
        }
    
        function getVehiculoPrecio() {
            return $this->_vehiculoPrecio;
        }
    
        function getVehiculoEstado() {
            return $this->_vehiculoEstado;
        }
    
        function getVehiculoDescripcion() {
            return $this->_vehiculoDescripcion;
        }
    
        function getExtrasNombre() {
            return $this->_extrasNombre;
        }
    
        function getExtrasPrecio() {
            return $this->_extrasPrecio;
        }
    
        function getSegurosNombre() {
            return $this->_segurosNombre;
        }
    
        function getSegurosPrecio() {
            return $this->_segurosPrecio;
        }
    
        function obtener($idUserDecodificado, $idAlquilerDecodificado) {
            $facturaDAL = new FacturaAccesoDatos();
            $results = $facturaDAL->obtener($idUserDecodificado, $idAlquilerDecodificado);
            $listafacturas = array();
        
            foreach ($results as $factura) {
                $ofacturaReglasNegocio = new FacturaNegocio();
                $ofacturaReglasNegocio->init($factura['AlquilerId'], $factura['UserId'], $factura['VehiculoId'], $factura['FechaInicio'], $factura['FechaFinal'], $factura['TotalDelPrecio'], $factura['TipoVehiculo'], $factura['VehiculoImagen'], $factura['Marca'], $factura['VehiculoNombre'], $factura['Matricula'], $factura['Caballos'], $factura['Kilometros'], $factura['Plazas'], $factura['VehiculoAño'], $factura['VehiculoPrecio'], $factura['VehiculoEstado'], $factura['VehiculoDescripcion'], $factura['ExtrasNombre'], $factura['ExtrasPrecio'], $factura['SegurosNombre'], $factura['SegurosPrecio']);
                array_push($listafacturas, $ofacturaReglasNegocio);
            }
            return $listafacturas;
        } 
    }
?>