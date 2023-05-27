<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    require("../AccesoDatos/gestionAlquileresAccesoDatos.php");
    class GestionAlquileresNegocio {
        private $_idAlquiler;
        private $_nombreVehiculo;
        private $_fechaInicio;
        private $_fechaFinal;
        private $_fechaDevuelto;
        private $_seguros;
        private $_extras;
        private $_totalDelPrecio;
        private $_totalCargo;
        private $_activoAlquiler;
        private $_pagado;
        private $_activoCargo;
        
        function __construct() {
        }
    
        function init($idAlquiler, $nombreVehiculo, $fechaInicio, $fechaFinal, $fechaDevuelto, $seguros, $extras, $totalDelPrecio, $totalCargo, $activoAlquiler, $pagado, $activoCargo) {
            $this->_idAlquiler = $idAlquiler;
            $this->_nombreVehiculo = $nombreVehiculo;
            $this->_fechaInicio = $fechaInicio;
            $this->_fechaFinal = $fechaFinal;
            $this->_fechaDevuelto = $fechaDevuelto;
            $this->_seguros = $seguros;
            $this->_extras = $extras;
            $this->_totalDelPrecio = $totalDelPrecio;
            $this->_totalCargo = $totalCargo;
            $this->_activoAlquiler = $activoAlquiler;
            $this->_pagado = $pagado;
            $this->_activoCargo = $activoCargo;
        }

        function getIdAlquiler() {
            return $this->_idAlquiler;
        }
    
        function getNombreVehiculo() {
            return $this->_nombreVehiculo;
        }
    
        function getFechaInicio() {
            return $this->_fechaInicio;
        }
    
        function getFechaFinal() {
            return $this->_fechaFinal;
        }
    
        function getFechaDevuelto() {
            return $this->_fechaDevuelto;
        }
    
        function getSeguros() {
            return $this->_seguros;
        }
    
        function getExtras() {
            return $this->_extras;
        }
    
        function getTotalDelPrecio() {
            return $this->_totalDelPrecio;
        }
    
        function getTotalCargo() {
            return $this->_totalCargo;
        }
    
        function getActivoAlquiler() {
            return $this->_activoAlquiler;
        }
    
        function getPagado() {
            return $this->_pagado;
        }
    
        function getActivoCargo() {
            return $this->_activoCargo;
        }

        function obtener() {
            $alquilerDAL = new gestionAlquileresAccesoDatos();
            $results = $alquilerDAL->obtener();
            $listaAlquileres = array();
        
            foreach ($results as $alquileres) {
                $oAlquilerReglasNegocio = new GestionAlquileresNegocio();
                $oAlquilerReglasNegocio->init($alquileres['IdAlquiler'], $alquileres['NombreVehiculo'], $alquileres['FechaInicio'], $alquileres['FechaFinal'], $alquileres['FechaDevuelto'], $alquileres['Seguros'], $alquileres['Extras'], $alquileres['TotalDelPrecio'], $alquileres['TotalCargo'], $alquileres['ActivoAlquiler'], $alquileres['Pagado'], $alquileres['ActivoCargo']);
                array_push($listaAlquileres, $oAlquilerReglasNegocio);
            }
        
            return $listaAlquileres;
        }
    
        function insertarAlquiler($IdUser, $IdSeguros, $IdExtras, $IdVehiculo, $FechaInicio, $FechaFinal, $TotalDelPrecio) {
            $gestionDAL = new gestionAlquileresAccesoDatos();
            $res = $gestionDAL->insertarAlquiler($IdUser, $IdSeguros, $IdExtras, $IdVehiculo, $FechaInicio, $FechaFinal, $TotalDelPrecio);
            return $res;         
        }

    }
?>