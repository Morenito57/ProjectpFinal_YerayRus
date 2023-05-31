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
        private $_TipoVehiculo;
        
        function __construct(){
        }

        function init($id, $idtipovehiculo, $imagen, $marca, $nombre, $matricula, $caballos, $kilometros, $plazas, $año, $precio, $estado, $descripcion, $tipovehiculo){
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
            $this->_TipoVehiculo = $tipovehiculo;
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

        function getTipoVehiculo(){
            return $this->_TipoVehiculo;
        }

        function obtener() {
            $vehiculosDAL = new VehiculosAccesoDatos();
            $results = $vehiculosDAL->obtener();
            $listaVehiculos =  array();

            foreach ($results as $vehiculos) {
                $oVehiculosReglasNegocio = new VehiculosReglasNegocio();
                $oVehiculosReglasNegocio->init($vehiculos['Id'], $vehiculos['IdTipoVehiculo'], $vehiculos['Imagen'], $vehiculos['Marca'], $vehiculos['Nombre'], $vehiculos['Matricula'], $vehiculos['Caballos'], $vehiculos['Kilometros'], $vehiculos['Plazas'], $vehiculos['Año'], $vehiculos['Precio'], $vehiculos['Estado'], $vehiculos['Descripcion'], $vehiculos['TipoVehiculo']);
                array_push($listaVehiculos,$oVehiculosReglasNegocio);            
            }            
            return $listaVehiculos;
        }

        function obtenerVehiculoConcreto($id) {
            $vehiculosDAL = new VehiculosAccesoDatos();
            $results = $vehiculosDAL->obtenerVehiculoConcreto($id);
            $listaVehiculos =  array();

            foreach ($results as $vehiculo) {
                $oVehiculosReglasNegocio = new VehiculosReglasNegocio();
                $oVehiculosReglasNegocio->init($vehiculo['Id'], $vehiculo['IdTipoVehiculo'], $vehiculo['Imagen'], $vehiculo['Marca'], $vehiculo['Nombre'], $vehiculo['Matricula'], $vehiculo['Caballos'], $vehiculo['Kilometros'], $vehiculo['Plazas'], $vehiculo['Año'], $vehiculo['Precio'], $vehiculo['Estado'], $vehiculo['Descripcion'], $vehiculo['TipoVehiculo']);
                array_push($listaVehiculos,$oVehiculosReglasNegocio);            
            }            
            return $listaVehiculos;
        }

        function eliminarVehiculo($Vehiculo){
            $vehiculosDAL = new VehiculosAccesoDatos();
            $results = $vehiculosDAL->eliminarVehiculo($Vehiculo);
            return $results;
        }

        function actualizarVehiculoAdmin($idVehiculo, $nombre, $imagen, $marca, $matricula, $año, $caballos, $kilometros, $plazas, $estado, $precio, $descripcion, $idTipoVehiculo) {
            $vehiculosDAL = new VehiculosAccesoDatos();
            $results = $vehiculosDAL->actualizarVehiculoAdmin($idVehiculo, $nombre, $imagen, $marca, $matricula, $año, $caballos, $kilometros, $plazas, $estado, $precio, $descripcion, $idTipoVehiculo);
            return $results;
        }

    }

?>