<?php
    //Carga del modelo y los controladores
    require_once __DIR__ . '/../app/config.php';
	require_once __DIR__ . '/../app/model.php';
	require_once __DIR__ . '/../app/controller.php';

	// enrutamiento
	 $map = array(
	     'inicio' => array('controller' =>'Controller', 'action' =>'inicio'),
	     'listarCodPos' => array('controller' =>'Controller', 'action' =>'listarCodPost'),
	     'insertarCP' => array('controller' =>'Controller', 'action' =>'insertarCP'),
	     'buscarCP' => array('controller' =>'Controller', 'action' =>'buscarCP'),
	     'verCodPost' => array('controller' =>'Controller', 'action' =>'verCodPost'),
	     
	     //-------------------------CONTACTOS-------------------------------------------
	     'listContact' => array('controller' =>'Controller', 'action' =>'listarContacto'),
	     'insertContact' => array('controller' =>'Controller', 'action' =>'insertarContacto'),
	     'obtenerDir' => array('controller' =>'Controller', 'action' =>'obtenerDireccion'),
	     'viewContact' => array('controller' =>'Controller', 'action' =>'verContacto'),
	   

//******************************************************-CLIENTES ****************************************************/
	     'listaCliente' => array('controller' =>'Controller', 'action' =>'listaCliente'), 
     	 'verCliente' => array('controller' =>'Controller', 'action' =>'verCliente') ,
     	 'agregarCl' => array('controller' =>'Controller', 'action' =>'agregarCl'),     	 
     	 'modCl' => array('controller' =>'Controller', 'action' =>'modCl'),
         ///----------------------Direccion de cliente----------
		 'verMunicipio' => array('controller' =>'Controller', 'action' =>'verMunicipio'),	
		 'verLocalidad' => array('controller' =>'Controller', 'action' =>'verLocalidad'), 
         /////////-----------------Agregar Dat Bancarios a Cliente--------------------
		 'nuevoDB' => array('controller' =>'Controller', 'action' =>'nuevoDB'),
         /*-----------------------Nuevo Contacto para Cliente------------------------*/
		 'nuevoContacto' => array('controller' =>'Controller', 'action' =>'nuevoContacto'),
		 'addCliente' => array('controller' =>'Controller', 'action' =>'addCliente'),
         'paginacion_contacto' => array('controller' =>'Controller', 'action' =>'paginacion_contacto'),
         'remcontactocli' => array('controller' =>'Controller', 'action' =>'remcontactocli'),
         'addcontactocli' => array('controller' =>'Controller', 'action' =>'addcontactocli'),      
          //-------------------------FAMILIA-------------------------------------------
	     'listaFam' => array('controller' =>'Controller', 'action' =>'listaFam'), 
     	 'verFam' => array('controller' =>'Controller', 'action' =>'verFam'),
     	 'eliFam' => array('controller' =>'Controller', 'action' =>'eliFam'),
     	 'agregarFam' => array('controller' =>'Controller', 'action' =>'agregarFam'),
     	 'verFamMod' => array('controller' =>'Controller', 'action' =>'verFamMod'),
     	 'buscarFam' => array('controller' =>'Controller', 'action' =>'buscarFam'),
     	  //-------------------------MARCA--------------------------------------------
   		 'listaMarca' => array('controller' =>'Controller', 'action' =>'listaMarca'),
     	 'verMarca' => array('controller' =>'Controller', 'action' =>'verMarca'),
     	 'elimMarca' => array('controller' =>'Controller', 'action' =>'elimMarca'),
		 'verMarMod' => array('controller' =>'Controller', 'action' =>'verMarMod'),
		 'buscarMarca' => array('controller' =>'Controller', 'action' =>'buscarMarca'),
		  //-------------------------LINEA--------------------------------------------
   		 'listaLinea' => array('controller' =>'Controller', 'action' =>'listaLinea'),
   		 'verLinea' => array('controller' =>'Controller', 'action' =>'verLinea'),
		 'verLineaMod' => array('controller' =>'Controller', 'action' =>'verLineaMod'),
     	 'elimLinea' => array('controller' =>'Controller', 'action' =>'elimLinea'),
     	 //-------------------------PRODUCTOS--------------------------------------------
   		 'listaProducto' => array('controller' =>'Controller', 'action' =>'listaProducto'),
		 'agregarProd' => array('controller' =>'Controller', 'action' =>'agregarProd'),
		 'verProducto' => array('controller' =>'Controller', 'action' =>'verProducto') ,
     	 'addProd' => array('controller' =>'Controller', 'action' =>'addProd'),
     	 'verProdMod' => array('controller' =>'Controller', 'action' =>'verProdMod'),
  /*********************************************************************************************************************/ 	 	 
     	 	 
         
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
