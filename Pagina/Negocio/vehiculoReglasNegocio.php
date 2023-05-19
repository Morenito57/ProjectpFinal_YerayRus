<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
require("../AccesoDatos/vehiculoAccesoDatos.php");
    class VehiculosReglasNegocio{
        private $_Id;
        private $_IdTipoVehiculo;
        private $_Imagen;
        private $_Marca;
        private $_Nombre;
        private $_Matricula;
        private $_Caballos;
        private $_Kilometros;
        private $_Plazas;
        private $_Año;
        private $_Precio;
        private $_Estado;
        private $_Descripcion;

        function __construct(){
        }

        function init($id, $idtipovehiculo, $imagen, $marca, $nombre, $matricula, $caballos, $kilometros, $plazas, $año, $precio, $estado, $descripcion,){
            $this->_Id = $id;
            $this->_IdTipoVehiculo = $idtipovehiculo;
            $this->_Imagen = $imagen;
            $this->_Marca = $marca;
            $this->_Nombre = $nombre;
            $this->_Matricula = $matricula;
            $this->_Caballos = $caballos;
            $this->_Kilometros = $kilometros;
            $this->_Plazas = $plazas;
            $this->_Año = $año;
            $this->_Precio = $precio;
            $this->_Estado = $estado;
            $this->_Descripcion = $descripcion;
        }

        function getId(){
            return $this->_Id;
        }

        function getIdTipoVehiculo(){
            return $this->_IdTipoVehiculo;
        }

        function getImagen(){
            return $this->_Imagen;
        }

        function getMarca(){
            return $this->_Marca;
        }

        function getNombre(){
            return $this->_Nombre;
        }

        function getMatricula(){
            return $this->_Matricula;
        }

        function getCaballos(){
            return $this->_Caballos;
        }

        function getKilometros(){
            return $this->_Kilometros;
        }

        function getPlazas(){
            return $this->_Plazas;
        }

        function getAño(){
            return $this->_Año;
        }

        function getPrecio(){
            return $this->_Precio;
        }

        function getEstado(){
            return $this->_Estado;
        }

        function getDescripcion(){
            return $this->_Descripcion;
        }

        function obtener() {
            $vehiculosDAL = new VehiculosAccesoDatos();
            $results = $vehiculosDAL->obtener();
            $listaVehiculos =  array();

            foreach ($results as $vehiculos) {
                $oVehiculosReglasNegocio = new VehiculosReglasNegocio();
                $oVehiculosReglasNegocio->init($vehiculos['Id'], $vehiculos['IdTipoVehiculo'], $vehiculos['Imagen'], $vehiculos['Marca'], $vehiculos['Nombre'], $vehiculos['Matricula'], $vehiculos['Caballos'], $vehiculos['Kilometros'], $vehiculos['Plazas'], $vehiculos['Año'], $vehiculos['Precio'], $vehiculos['Estado'], $vehiculos['Descripcion']);
                array_push($listaVehiculos,$oVehiculosReglasNegocio);            
            }            
            return $listaVehiculos;
        }

    }

?>