<?php
/**
 * En este archivo se cargar la configuración del proyecto y las librerías donde implementaremos la parte del Modelo, del Controlador y de la Vista. 
 * También se analiza los parámetros de la petición HTTP (request) comprobando si la página solicitada en ella tiene asignada alguna acción del Controlador.
 * Si es así la ejecutará, si no dará un error 404 (page not found).
 */
    
     //Se realiza la carga de la configuración del modelo y de los controladores.
    require_once __DIR__ . '/../app/config.php';
	require_once __DIR__ . '/../app/model.php';
	require_once __DIR__ . '/../app/controller.php';

	// ENRUTAMIENTO
	/* 
	 * Se declara un array asociativo cuya función es definir una "tabla de rutas" para 
	 * 	mapear (asociar), rutas en acciones de un controlador. 
	 */
	$map = array(
	     'inicio' => array('controller' =>'Controller', 'action' =>'inicio'),
	     
	     //-------------------------CONTACTOS-------------------------------------------
	     'listContact' => array('controller' =>'Controller', 'action' =>'listarContacto'),
	     'viewContact' => array('controller' =>'Controller', 'action' =>'verContacto'),
	     'insertContact' => array('controller' =>'Controller', 'action' =>'insertarContacto'),
	     'viewMunicipality' => array('controller' =>'Controller', 'action' =>'obtenerMunicipio'),
	     'viewDirLocality' => array('controller' =>'Controller', 'action' =>'obtenerDireccionLocalidad'),
	     'obtenerDir' => array('controller' =>'Controller', 'action' =>'obtenerDireccion'),
	     'searchContact' => array('controller' =>'Controller', 'action' =>'buscarContacto'),
	     'updateContact' => array('controller' =>'Controller', 'action' =>'modificarContacto'),
	     'deletedContact' => array('controller' =>'Controller', 'action' =>'eliminarContacto'),
	     
	     //-------------------------CLIENTES-------------------------------------------
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
     	 
     	 /*------------------------------PROVEEDOR----------------------------------------------*/
	     'Proveedores' => array('controller' =>'Controller', 'action' =>'Proveedor'),
	     'NuevoProveedor' => array('controller' =>'Controller', 'action' =>'InsertarProveedor_part1'),
	     'NuevoProveedorPart2' => array('controller' =>'Controller', 'action' =>'InsertarProveedores_part2'),
	     'TablaContactos' => array('controller' =>'Controller', 'action' =>'cargarContactosPro'),
	     'DetalleProveedor' => array('controller' =>'Controller', 'action' =>'verProveedor'),
	     'DatosContacto' => array('controller' =>'Controller', 'action' =>'mostrarContactos'),
	     'EditarProveedores' => array('controller' =>'Controller', 'action' =>'ModificarProveedor_part1'),
	     'BorrarProveedores' => array('controller' =>'Controller', 'action' =>'EliminarProveedor'),
	     'DeleteDatosBancarios' => array('controller' =>'Controller', 'action' =>'borrarDatosB'),
	     'DatosBancarios' => array('controller' =>'Controller', 'action' =>'InsertarDatosBancariosP'),
	     'DatosContacto' => array('controller' =>'Controller', 'action' =>'InsertarDatosContactosP'),
	 	 'verMunicipioFiscal' => array('controller' =>'Controller', 'action' =>'obtenerMunicipioDirFiscal'),
	 	 'verLocalidadFiscal' => array('controller' =>'Controller', 'action' =>'obtenerDireccionLocalidadDirFiscal'),
	 	 'searchProveedores' => array('controller' =>'Controller', 'action' =>'ConsultarProveedores'),


	     // ------------------------------INVENTARIO------------------------------------------
	     'Inventario' => array('controller' =>'Controller', 'action' =>'Inventarios'),
	     'NuevoRegistro' => array('controller' =>'Controller', 'action' =>'AgregarInventario'),
	     
		 //-------------------------TRANSACCIONES-------------------------------------------
		 'menuTransacciones' => array('controller' =>'Controller', 'action' =>'verMenuTransacciones'),
		 'transacciones' => array('controller' =>'Controller', 'action' =>'nuevaTransaccion'),
		 'viewFormTrans' => array('controller' =>'Controller', 'action' =>'cargarFormTransaccion'),
		 'continuarTransaccion' => array('controller' =>'Controller', 'action' =>'insertarTransaccion'),
		 'verInfoProd' => array('controller' =>'Controller', 'action' =>'verInformacionProducto'),
		 	// COMPRAS
		 	'addProdCompra' => array('controller' =>'Controller', 'action' =>'agregarProdCompra'),
		 	'deleteProdCompra' => array('controller' =>'Controller', 'action' =>'eliminarProdCompra'),
		 	'listarCompras' => array('controller' =>'Controller', 'action' =>'listarComprasTrans'),
		 	'detalleCompra' => array('controller' =>'Controller', 'action' =>'detalleCompraTrans'),
		 	// VENTAS
		 	'viewProductProd' => array('controller' =>'Controller', 'action' =>'obtenerProductosProvee'),
		 	'addProdVenta' => array('controller' =>'Controller', 'action' =>'agregarProdVenta'),
		 	'deleteProdVenta' => array('controller' =>'Controller', 'action' =>'eliminarProdVenta'),
		 	'listarVentas' => array('controller' =>'Controller', 'action' =>'listarVentasTrans'),
		 	'detalleVenta' => array('controller' =>'Controller', 'action' =>'detalleVentaTrans'),
	 );
		
	 
 	// PARSEO DE LA RUTA
 	/**
	 * Se lleva a cabo el parseo de la URL y la carga de la acción, si la ruta está definida en la tabla de rutas.
	 * En caso contrario se devuelve una página de error. Hemos utilizado la función header() de PHP para indicar 
	 * en la cabecera HTTP el código de error correcto. Además enviamos un pequeño documento HTML que informa del error.
	 * También definimos a inicio como una ruta por defecto, ya que si la query string llega vacía, se opta por cargar esta acción.
	 */
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
	 // EJECUCIÓN DEL CONTROLADOR ASOCIADO A LA RUTA
	
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
