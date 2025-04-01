<?php

  class Model{    
        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=distrubuidora;charset=utf8', 'root', '');
         }
        
  public function getItem($id){
    
        $sql = 'SELECT * FROM ordendecompra WHERE id = ?';
        $query = $this->db->prepare($sql);
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
        
   
        public function getAll($orderBy = false, $orderDirection = 'ASC', $nombre = null,$page=null,$limit=null,$apellido) {
            
            $sql = 'SELECT * FROM ordendecompra';
            $params = []; 
        
            
            if ($nombre != null) {
                $sql .= ' WHERE nombre = ?';
                $params[] = $nombre; 
            }
           
            if ($apellido != null) {
                $sql .= ' WHERE apellido = ?';
                $params[] = $apellido; 
            }
           
           
           
            if (strtoupper($orderDirection) === 'DESC') 
            {
                $orderDirection = 'DESC';
            } else {
                $orderDirection = 'ASC'; 
            }        
        
          
          
            if ($orderBy) {
                    $sql .= " ORDER BY $orderBy " . $orderDirection; 
                }
                
            if($page && $limit)
                $sql .= ' LIMIT ' . $limit . ' OFFSET ' . (($page-1)*$limit);
        
        
            $query = $this->db->prepare($sql);
            $query->execute($params); 
            return $query->fetchAll(PDO::FETCH_OBJ); 
        }
        
        

    function insert($nombre,$apellido,$nombre_producto,$TipoProducto,$imagen,$fecha,$descripcion){
      
        $query =  $this->db->prepare('INSERT INTO ordendecompra (nombre,apellido,nombre_producto,TipoProducto,imagen,fecha,descripcion) VALUES (?,?,?,?,?,?,?) ');
        $query -> execute([$nombre,$apellido,$nombre_producto,$TipoProducto,$imagen,$fecha,$descripcion]); 

        $id =  $this->db->lastInsertId();
      

        
        return $id;
        }
        

        function update($data, $id) {
            
            $fields = [];
            $values = [];
        
            if (!empty($data['nombre'])) {
                $fields[] = 'nombre = ?';
                $values[] = $data['nombre'];
            }
            if (!empty($data['fecha'])) {
                $fields[] = 'fecha = ?';
                $values[] = $data['fecha'];
            }
            if (!empty($data['descripcion'])) {
                $fields[] = 'descripcion = ?';
                $values[] = $data['descripcion'];
            }
            if (!empty($data['apellido'])) {
                $fields[] = 'apellido = ?';
                $values[] = $data['apellido'];
            }
            if (!empty($data['nombre_producto'])) {
                $fields[] = 'nombre_producto = ?';
                $values[] = $data['nombre_producto'];
            }
            if (!empty($data['tipoProducto'])) {
                $fields[] = 'tipoProducto = ?';
                $values[] = $data['tipoProducto'];
            }
            
            
         
             
            $sql = 'UPDATE ordendecompra SET ' . implode(', ', $fields) . ' WHERE id = ?';
            $values[] = $id; 
        
            
            $query = $this->db->prepare($sql);
            $query->execute($values);
        }

        function delete($id) {
   
            $query = $this->db->prepare('DELETE FROM ordendecompra WHERE id =  ?');
            $query->execute([$id]);
           
        }
    }


