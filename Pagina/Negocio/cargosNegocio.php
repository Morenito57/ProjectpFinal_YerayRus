<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    require("../AccesoDatos/cargosAccesoDatos.php");
    class CargosNegocio {
        private $_Id;
        private $_alquilerId;
        private $_FechaDevuelto;
        private $_TotalCargo;
        private $_Pagado;
        private $_Activo;

        function __construct() {
        }
    
        function init($id, $alquilerId, $fechaDevuelto, $totalCargo, $pagado, $activo) {
            $this->_Id = $id;
            $this->_alquilerId = $alquilerId;
            $this->_FechaDevuelto = $fechaDevuelto;
            $this->_TotalCargo = $totalCargo;
            $this->_Pagado = $pagado;
            $this->_Activo = $activo;
        }

        function getId() {
            return $this->_Id;
        }
    
        function getAlquilerId() {
            return $this->_alquilerId;
        }

        function getFechaDevuelto() {
            return $this->_FechaDevuelto;
        }

        function getTotalCargo() {
            return $this->_TotalCargo;
        }

        function getPagado() {
            return $this->_Pagado;
        }
    
        function getActivo() {
            return $this->_Activo;
        }

        function obtener() {
            $cargoDAL = new CargosAccesoDatos();
            $results = $cargoDAL->obtener();
            $listacargos = array();
        
            foreach ($results as $cargos) {
                $ocargoReglasNegocio = new CargosNegocio();
                $ocargoReglasNegocio->init($cargos['Id'], $cargos['Alquiler_id'], $cargos['FechaDevuelto'], $cargos['TotalCargo'], $cargos['Pagado'], $cargos['Activo']);
                array_push($listacargos, $ocargoReglasNegocio);
            }
            return $listacargos;
        } 

        function obtenerCargo($id) {
            $cargoDAL = new CargosAccesoDatos();
            $results = $cargoDAL->obtenercargo($id);
            $listacargos = array();
        
            foreach ($results as $cargos) {
                $ocargoReglasNegocio = new CargosNegocio();
                $ocargoReglasNegocio->init($cargos['Id'], $cargos['Alquiler_id'], $cargos['FechaDevuelto'], $cargos['TotalCargo'], $cargos['Pagado'], $cargos['Activo']);
                array_push($listacargos, $ocargoReglasNegocio);
            }
            return $listacargos;
        } 

        function eliminarcargo($id) {
            $cargoDAL = new CargosAccesoDatos();
            $results = $cargoDAL->eliminarcargo($id);
            return $results;
        }

        function entregaCocghe($idCargo, $idAlquiler, $fecha) {
            $cargoDAL = new CargosAccesoDatos();
            $results = $cargoDAL->entregaCocghe($idCargo, $idAlquiler, $fecha);
            return $results;
        }
    }
?>