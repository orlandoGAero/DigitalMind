<?php
/**
 * Esta clase implementa una serie de métodos públicos, que hemos denominado acciones para indicar que son métodos asociados a URL’s. 
 * En cada una de las acciones se declara un array asociativo con los datos que serán pintados en la plantilla. Pero en ningún caso hay información 
 * acerca de como se pintarán dichos datos. Por otro lado, casi todas las acciones utilizan un objeto de la clase Models para realizar operaciones relativas
 * a la lógica de negocio.
 */
    class controller{
    	public function inicio(){
    		$obtenerDatos = array(
				'fecha' => date('d/m/Y H:i'),
			);
			
			require __DIR__ . '/templates/inicio.php';
    	}
		
		//CONTACTOS
		public function listarContacto()
		{
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerDatosContacto = array(
				'contactos' => $m->obtenerContactos(),
			); 
			
			require __DIR__ . '/templates/mostrarContactos.php';
		}
		
		public function verContacto(){
			if(!isset($_GET['idContacto'])){
				throw new Exception("Página no encontrada", 1);
			}
		}
		
		/* CODIGOS POSTALES */
		public function listarCodPost()
		{
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerDatos = array(
				'codigos_postales' => $m->obtenerCodigosPostales(),
			);
			
			require __DIR__ . '/templates/mostrarCodigosPostales.php';
		}
			
		public function verCodPost()
		{				
			if (!isset($_GET['idCP'])) {
				throw new Exception("Página no encontrada", 1);
			}
			
			
			$idCodPost = $_GET['idCP'];
			//$idCodPost = Encrypter::decrypt("$idCodigoPostal");
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$codPost = $m->obtenerCodigoPostal($idCodPost);
			
			$obtenerDatos = $codPost;
			
			require __DIR__ . '/templates/verCodigoPostal.php';
		}
    
		public function insertarCodPost()
		{
			
			require __DIR__ . '/templates/________';
		}
		
		public function buscarCodPost()
		{
			
			require __DIR__ . '/templates/________';
		}
}
?>