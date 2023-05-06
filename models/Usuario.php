<?php

namespace Model;

 class Usuario extends ActiveRecord {
    
    //base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];
 
    // crear atributo por cada dato de la base de datos
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? "";
        $this->apellido = $args['apellido'] ?? "";
        $this->email = $args['email'] ?? "";
        $this->password = $args['password'] ?? "";
        $this->telefono = $args['telefono'] ?? "";
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? "";

    }

    //mensajes para validacion de creacion de cuentas
    public function validarCuenta(){

            if (!$this->nombre) {
                self::$alertas['error'][] = 'Nombre es obligatorio';
            }
            if (!$this->apellido) {
                self::$alertas['error'][] = 'Apellido es obligatorio';
            }
            if (!$this->telefono) {
                self::$alertas['error'][] = 'Telefono es obligatorio';
            }
            if (!$this->email) {
                self::$alertas['error'][] = 'Email es obligatorio';
            }
            if (!$this->password) {
                self::$alertas['error'][] = 'Password es obligatorio';
            }
            if (strlen($this->password) < 6) {
                self::$alertas['error'][] = 'Password es invalido';
            }
            return self::$alertas;
        }

        public function validarLogin(){
            
            if (!$this->email) {
                self::$alertas['error'][] = 'Email es obligatorio';

            }
            if (!$this->password) {
                self::$alertas['error'][] = 'Password es obligatorio';

            }
            return self::$alertas;

        }
        public function validarEmail(){

            if (!$this->email) {
                self::$alertas['error'][] = 'Email es obligatorio';
            }

            return self::$alertas;

        }
        public function validarPassword(){

            if (!$this->password) {
                self::$alertas['error'][] = 'Password es obligatorio';

            }
            if (strlen($this->password) < 6) {

                self::$alertas['error'][] = 'Password es invalido';
            }

            return self::$alertas;
        }

        //verifica si el usuario existe 
        public function usuarioExistente(){

            $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
            $resultado = self::$db->query($query);

            if ($resultado->num_rows) {
                self::$alertas['error'][] = 'El usuario ya se encuentra registrado';
            }
             return $resultado;
        } 
        // funcion para encryptar password
        public function hashPassword(){

            $this->password = password_hash($this->password,  PASSWORD_BCRYPT);
        }
    // funcion para crear un token
        public function crearToken(){

            $this->token = uniqid();
        }
        public function comprobarPV($password) {
            
            $resultado = password_verify($password, $this->password);

            if (!$resultado || !$this->confirmado) {
                self::$alertas['error'][] = 'Password Incorrecto o tu cuenta no existe';
            }else{
                return true;
            }
            
        }

       
 }