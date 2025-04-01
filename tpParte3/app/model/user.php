<?php

class UserModel {
    private $db;

    function __construct() {
       
        $this->db = new PDO('mysql:host=localhost;dbname=distrubuidora;charset=utf8', 'root', '');
    }
 
    public function getUserByUsername($gmail) {    
        $query = $this->db->prepare("SELECT * FROM usuario WHERE gmail = ?");
        $query->execute([$gmail]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        if ($user) {
            // Si existe usuario, retornamos el user
            return $user;
        } else {
            // Si no se encontro el user, retornamos null
            return "el usuario no existe";
        }
    }
}