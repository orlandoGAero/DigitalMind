<?php
    //Carga del modelo y los controladores
    require_once __DIR__ . '/../app/config.php';
	require_once __DIR__ . '/../app/model.php';
	require_once __DIR__ . '/../app/controller.php';
	require_once __DIR__ . '/../app/Encrypter.php';
	
	// enrutamiento
 $map = array(
     'inicio' => array('controller' =>'Controller', 'action' =>'inicio'),
     'listarCodPos' => array('controller' =>'Controller', 'action' =>'listarCodPost'),
     'insertarCP' => array('controller' =>'Controller', 'action' =>'insertarCP'),
     'buscarCP' => array('controller' =>'Controller', 'action' =>'buscarCP'),
     'verCodPost' => array('controller' =>'Controller', 'action' =>'verCodPost'),
     // proveedor
     'Proveedores' => array('controller' =>'Controller', 'action' =>'Proveedor'),
     'NuevoProveedor' => array('controller' =>'Controller', 'action' =>'InsertarProveedor'),
 );
 
 	// Parseo de la ruta
	 if (isset($_GET['url'])) {
	     if (isset($map[$_GET['url']])) {
	         $ruta = $_GET['url'];
	     } else {
	         header('Status: 404 Not Found');
	         echo '<html><body><h1>Error 404: No existe la ruta <i>' .
	                 $_GET['url'] .
	                 '</p></body></html>';
	         exit;
	     }
	 } else {
	     $ruta = 'inicio';
	 }
	
	 $controlador = $map[$ruta];
	 // Ejecución del controlador asociado a la ruta
	
	 if (method_exists($controlador['controller'],$controlador['action'])) {
	     call_user_func(array(new $controlador['controller'], $controlador['action']));
	 } else {
	
	     header('Status: 404 Not Found');
	     echo '<html><body><h1>Error 404: El controlador <i>' .
	             $controlador['controller'] .
	             '->' .
	             $controlador['action'] .
	             '</i> no existe</h1></body></html>';
	 }
?>