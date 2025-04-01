<?php

  class ModelCategoria{    
        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=distrubuidora;charset=utf8', 'root', '');
         }
        
         function getBynombre($nombre) {
           
            $query =$this->db->prepare('SELECT*FROM categoria WHERE TipoProducto = ?');
            $query->execute([$nombre]);
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        }

}