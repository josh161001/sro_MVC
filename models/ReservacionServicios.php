<?php

namespace Model;

    class ReservacionServicios extends ActiveRecord {
   
        //base de datos  de servicios
        protected static $tabla = 'reservacionservicios';
        protected static $columnasDB = ['id', 'reservacionId', 'servicioId'];
       //instanciamos el arreglo
        public $id;
        public $reservacionId;
        public $servicioId;

       //  creamos construsctor
       public function __construct($args = []) {

           $this->id = $args['id'] ?? null;
           $this->reservacionId = $args['reservacionId'] ?? '';
           $this->servicioId = $args['servicioId'] ?? '';
    }
}