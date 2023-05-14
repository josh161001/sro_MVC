<?php

namespace Model;

    class Servicio extends ActiveRecord {
    
        //base de datos  de servicios
         protected static $tabla = 'servicios';
         protected static $columnasDB = ['id', 'nombre', 'precio', 'img'];
        //instanciamos el arreglo
         public $id;
         public $nombre;
         public $precio;
         public $img;

        //  creamos construsctor
        public function __construct($args = []) {

            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->img = $args['img'] ?? '';
        }

        public function validar() {
            if(!$this->nombre) {
                self::$alertas['error'][] = 'El Nombre del Servicio es Obligatorio';
            }
            if(!$this->precio) {
                self::$alertas['error'][] = 'El Precio del Servicio es Obligatorio';
            }
            if(!is_numeric($this->precio)) {
                self::$alertas['error'][] = 'El precio no es válido';
            }
            if(!$this->img){
                self::$alertas['error'][] = 'Imagen obligatorio';
            }
            return self::$alertas;
        }
           


        }
    