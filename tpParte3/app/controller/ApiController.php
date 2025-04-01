<?php
require_once 'app/views/Json.view.php';
require_once 'app/model/Model.php';
require_once 'app/model/ModelCategoria.php';
const BASE_URL = 'http://localhost/web2/tp2/';


class ApiController{    
   
    private $view;
    private $model;
    private $ModelCategoria;

   public function __construct() {
      $this->model = new Model();
        $this->view = new JSONView();
        $this->ModelCategoria = new ModelCategoria();
        
    }
   
    
    function getAll($req, $res) {
        $nombre = null;
        $page = false;
        $limit = false;
        $orderBy = false;
        $orderDirection = "ASC";
        $apellido = false;
    
     
        if (isset($req->query->page) && is_numeric($req->query->page) && isset($req->query->limit) && is_numeric($req->query->limit)) {
            $page = intval($req->query->page);
            $limit = intval($req->query->limit);
    
            if ($page < 0 || $limit < 0) {
                return $this->view->response(['Parámetros de paginación inválidos'], 400);
            }
           
        }
    
 
        if (isset($req->query->nombre)) {
            $nombre = $req->query->nombre;
          
        }

        if (isset($req->query->apellido)) {
                $apellido = $req->query->apellido;
            
            }
  
        if (isset($req->query->order_by)) {
          
            $allowedColumns = ['nombre', 'apellido', 'nombre_producto','TipoProducto']; 
            if (in_array($req->query->order_by, $allowedColumns)) {
                $orderBy = $req->query->order_by;
            } else {
                 return $this->view->response(['error' => 'Columna de ordenamiento inválida'], 400);
            }
        }
    
 
        if (isset($req->query->order_direction)) {
            if (strtoupper($req->query->order_direction) === "ASC" || strtoupper($req->query->order_direction) === "DESC") {
                $orderDirection = strtoupper($req->query->order_direction);
            } else {
                return $this->view->response(['error' => 'Dirección de ordenamiento inválida'], 400);
            }
        }
    
        $task = $this->model->getAll($orderBy, $orderDirection, $nombre, $page, $limit,$apellido);
    
        return $this->view->response($task);
    }

    function post($req,$res){
       
        if(empty($req->body->nombre))
        return $this ->view->response("falta completar nombre",400);
        if(empty( $req->body->apellido))
        return $this ->view->response("falta completar apellido",400);
        if(empty($req->body->nombre_producto))
        return $this ->view->response("falta completar nombre del producto",400);
        if(empty($req->body->imagen))
        return $this ->view->response("falta completar imagen del producto",400);
        if(empty($req->body->descripcion))
        return $this ->view->response("falta completar descripcion del producto",400);
        if (isset($req->body->TipoProducto)) {
                $categoriaPermitida= $this->ModelCategoria -> getBynombre($_POST['tipoProducto']);
                if($categoriaPermitida){
                    $idCategoria = $categoriaPermitida->id;
                    $data['tipoProducto'] = $idCategoria;
            }else{
                return $this ->view->response("categoria inexistente",404);
            }
        }
   
   
        $apellido =  $req->body->apellido;
        $nombre_producto =  $req->body->nombre_producto;
        $TipoProducto =  $req->body->TipoProducto;
        $nombre =  $req->body->nombre;
        $imagen =  $req->body->imagen;
        $fecha =  $req->body->fecha;
        $descripcion =  $req->body->descripcion;
     
       


        $id = $this->model-> insert($nombre,$apellido,$nombre_producto, $TipoProducto,$imagen,$fecha,$descripcion);
        if($id){
            $item = $this->model->getItem( $id);
            return $this ->view->response($item,201);
        }else{
            return $this ->view->response("no se pudo agregar el comprador",500);
        }
        
    }
   

    function update($req,$res){
        
        $id = $req->params->id;
       $item = $this->model->getItem( $id);
       if(!$item){return $this ->view->response("no existe un comprador con el id=$id",400);}
   
    
    
       
        $data = [];
    
        if (isset($req->body->nombre)) {
            $data['nombre'] = $req->body->nombre;
        }
        
        if (isset($req->body->apellido)) {
            $data['apellido'] = $req->body->apellido;
        }
        if (isset($req->body->nombre_producto)) {
            $data['nombre_producto'] = $req->body->nombre_producto;
        }
        if (isset($req->body->imagen)) {
            $data['imagen'] = $req->body->imagen;
        }
        if (isset($req->body->descripcion)) {
            $data['descripcion'] = $req->body->descripcion;
        }
        if (isset($req->body->fecha)) {
            $data['fecha'] = $req->body->fecha;
        }
        if (isset($req->body->TipoProducto)) {
            $categoriaPermitida= $this->ModelCategoria -> getBynombre($req->body->TipoProducto);
            var_dump($categoriaPermitida);
            if($categoriaPermitida){
                $idCategoria = $categoriaPermitida->id;
                $data['tipoProducto'] = $idCategoria;
        }else{
            return $this ->view->response("categoria inexistente",404);
        }
        }
    
      
        if (empty($data)) {
            return $this ->view->response("debes completar al menos un campo",401);
        }
        
    
       
       
        $this-> model-> update($data, $id);    
        $this->view->response($item,200);    
        
   
    }

    



   function delete($req,$res){
    
        $id = $req -> params ->id;
        $item = $this->model->getItem($id);
        if(!$item)
            return $this ->view->response("la tarea no existe",404);
        
        $this->model->delete($id);
  
        return $this ->view->response("la tarea con el id= $id se elimino");
   }
   
   function get($req,$res){
       $id = $req -> params ->id;
       
       $item = $this->model->getItem($id);
        if(!$item){
            return $this ->view->response("la tarea no existe",404);}
        return $this->view-> response($item);
    }
   
}

