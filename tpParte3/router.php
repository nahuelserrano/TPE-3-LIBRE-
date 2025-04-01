<?php

require_once './libs/Router.php';
require_once 'app/controller/ApiController.php';


require_once 'app/controller/UserApiController.php';

require_once 'app/middleware/JWTAuthMiddleware.php';

$Router = new Router();
$Router->addMiddleware(new JWTAuthMiddleware());

 
$Router->addRoute('ordendecompra'       ,'GET'      ,'ApiController'    ,'getAll');
$Router->addRoute('ordendecompra/:id'   ,'GET'      ,'ApiController'    ,'get');
$Router->addRoute('ordendecompra/:id'   ,'DELETE'   ,'ApiController'    ,'delete');
$Router->addRoute('ordendecompra'       ,'POST'   ,'ApiController'      ,'post');
$Router->addRoute('ordendecompra/:id'   ,'PUT'   ,'ApiController'      ,'update');
$Router->addRoute('user/token'  ,     'GET',     'UserApiController'      ,   'getToken');

$Router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
