<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    require("../AccesoDatos/alquileresAcceso.php");
    class AlquileresNegocio {
        private $_idAlquiler;
        private $_idUser;
        private $_idVehiculo;
        private $_idCargo;
        private $_idSeguros;
        private $_idExtras;
        private $_fechaInicio;
        private $_fechaFinal;
        private $_totalDelPrecio;
        private $_estado;

        function __construct() {
        }
    
        function init($idAlquiler, $idUser, $idVehiculo, $idCargo, $idSeguros, $idExtras, $fechaInicio, $fechaFinal, $totalDelPrecio, $estado) {
            $this->_idAlquiler = $idAlquiler;
            $this->_idUser = $idUser;
            $this->_idVehiculo = $idVehiculo;
            $this->_idCargo = $idCargo;
            $this->_idSeguros = $idSeguros;
            $this->_idExtras = $idExtras;
            $this->_fechaInicio = $fechaInicio;
            $this->_fechaFinal = $fechaFinal;
            $this->_totalDelPrecio = $totalDelPrecio;
            $this->_estado = $estado;
        }

        function getIdAlquiler() {
            return $this->_idAlquiler;
        }
    
        function getIdUser() {
            return $this->_idUser;
        }

        function getIdVehiculo() {
            return $this->_idVehiculo;
        }

        function getIdCargo() {
            return $this->_idCargo;
        }

        function getIdSeguros() {
            return $this->_idSeguros;
        }
    
        function getIdExtras() {
            return $this->_idExtras;
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
    
        function getEstado() {
            return $this->_estado;
        }

        function obtener() {
            $alquilerDAL = new AlquileresAccesoDatos();
            $results = $alquilerDAL->obtener();
            $listaAlquileres = array();
        
            foreach ($results as $alquileres) {
                $oAlquilerReglasNegocio = new AlquileresNegocio();
                $oAlquilerReglasNegocio->init($alquileres['IdAlquiler'], $alquileres['IdUser'], $alquileres['IdVehiculo'],$alquileres['IdCargo'], $alquileres['IdSeguros'], $alquileres['IdExtras'], $alquileres['FechaInicio'], $alquileres['FechaFinal'], $alquileres['TotalDelPrecio'], $alquileres['Estado']);
                array_push($listaAlquileres, $oAlquilerReglasNegocio);
            }
            return $listaAlquileres;
        } 

    }
?>