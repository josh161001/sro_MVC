<?php

namespace Model;

    class ReservacionServicios extends ActiveRecord {
   
        //base de datos  de servicios
        protected static $tabla = 'reservacionservicios';
        protected static $columnasDB = ['id', 'citaId', 'servicioId'];
       //instanciamos el arreglo
        public $id;
        public $citaId;
        public $servicioId;

       //  creamos construsctor
       public function __construct($args = []) {

           $this->id = $args['id'] ?? null;
           $this->citaId = $args['citaId'] ?? '';
           $this->servicioId = $args['servicioId'] ?? '';
    }
}