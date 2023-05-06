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

        //  creamos construsctor
        public function __construct($args = []) {

            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->img = $args['img'] ?? '';


        }
    }