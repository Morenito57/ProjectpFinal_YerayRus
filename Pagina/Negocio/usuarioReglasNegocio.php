<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 0);
    require("../AccesoDatos/usuarioAccesoDatos.php");

    class UsuarioReglasNegocio {
        private $_NombreUsuario;
        private $_Clave;
        private $_Saldo;
        private $_TipoDeUsuario;
        private $_Nombre;
        private $_Apellidos;
        private $_FechaNacimiento;
        private $_Direccion;
        private $_DNI;
        private $_Telefono;
        private $_Email;
        private $_Otro;
        private $_IdDatosContacto;
        private $_IdDatosPersonales;
    
        function __construct(){
        }
    
        function init(
            $nombreUsuario, $clave, $saldo, $tipoDeUsuario, $nombre, $apellidos,$fechaNacimiento, $direccion, $dni, $telefono, $email, $otro, $idDatosContacto, $idDatosPersonales
        ) {
            $this->_NombreUsuario = $nombreUsuario;
            $this->_Clave = $clave;
            $this->_Saldo = $saldo;
            $this->_TipoDeUsuario = $tipoDeUsuario;
            $this->_Nombre = $nombre;
            $this->_Apellidos = $apellidos;
            $this->_FechaNacimiento = $fechaNacimiento;
            $this->_Direccion = $direccion;
            $this->_DNI = $dni;
            $this->_Telefono = $telefono;
            $this->_Email = $email;
            $this->_Otro = $otro;
            $this->_IdDatosContacto = $idDatosContacto;
            $this->_IdDatosPersonales = $idDatosPersonales;

        }

        function getNombreUsuario() {
            return $this->_NombreUsuario;
        }
    
        function getClave() {
            return $this->_Clave;
        }

        function getSaldo() {
            return $this->_Saldo;
        }
    
        function getTipoDeUsuario() {
            return $this->_TipoDeUsuario;
        }
    
        function getNombre() {
            return $this->_Nombre;
        }
    
        function getApellidos() {
            return $this->_Apellidos;
        }
    
        function getFechaNacimiento() {
            return $this->_FechaNacimiento;
        }
    
        function getDireccion() {
            return $this->_Direccion;
        }
    
        function getDNI() {
            return $this->_DNI;
        }
    
        function getTelefono() {
            return $this->_Telefono;
        }
    
        function getEmail() {
            return $this->_Email;
        }
    
        function getOtro() {
            return $this->_Otro;
        }

        function getIdDatosContacto() {
            return $this->_IdDatosContacto;
        }

        function getIdDatosPersonales() {
            return $this->_IdDatosPersonales;
        }

        function obtenerUsuario($usuario) {
            $usuarioDAL = new UsuarioAccesoDatos();
            $results = $usuarioDAL->obtenerUsuario($usuario);
            $listaUsuario = array();
        
            foreach ($results as $usuarios) {
                $oUsuarioReglasNegocio = new UsuarioReglasNegocio();
                $oUsuarioReglasNegocio->init($usuarios['Usuario'],$usuarios['Clave'],$usuarios['Saldo'],$usuarios['TipoUsuario'],$usuarios['Nombre'],$usuarios['Apellidos'],$usuarios['FechaNacimiento'],$usuarios['Direccion'],$usuarios['DNI'], $usuarios['Telefono'],$usuarios['Email'],$usuarios['Otro'],$usuarios['IdDatosContacto'],$usuarios['IdDatosPersonales']);
                array_push($listaUsuario, $oUsuarioReglasNegocio);
            }
        
            return $listaUsuario;
        }

        function verificar($usuario, $clave) {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->verificar($usuario,$clave);           
            return $res;            
        }
        function insertar($usuario, $clave, $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI, $telefono, $email, $otro) {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->insertar($usuario, $clave, $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI, $telefono, $email, $otro);           
            return $res;            
        }

        function actualizarUsuario($usuarioOriginal,$usuario, $clave, $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI, $telefono, $email, $otro, $IdDatosContacto, $IdDatosPersonales) {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->actualizarUsuario($usuarioOriginal,$usuario, $clave, $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI, $telefono, $email, $otro, $IdDatosContacto, $IdDatosPersonales);           
            return $res;            
        }

        function actualizarSalsoUsuario($usuarioOriginal, $saldo) {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->actualizarSalsoUsuario($usuarioOriginal, $saldo);           
            return $res;            
        }

        function eliminarUsuario($usuarioOriginal) {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->eliminarUsuario($usuarioOriginal);           
            return $res;
        }

        function deslogearse() {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->deslogearse();           
            return $res;
        }


}