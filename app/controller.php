<?php
    class controller{
    	public function inicio(){
    		$obtenerDatos = array(
				'fecha' => date('d/m/Y H:i'),
			);
			
			require __DIR__ . '/templates/inicio.php';
    	}

		//---------------------------------------------CONTACTOS-------------------------------------------
		public function listarContacto()
		{
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerDatosContactos = array(
				'contactos' => $m->obtenerContactos(),
			); 
			
			require __DIR__ . '/templates/contactos/mostrarContactos.php';
		}
		
		public function verContacto(){
			if(!isset($_GET['idContact'])){
				throw new Exception("Página no encontrada", 1);
			}
			
			$IdContacto = $_GET['idContact'];
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			$detalleContacto = $m->obtenerContacto($IdContacto);
			
			$obtenerDatosContacto = $detalleContacto;
			
			require __DIR__ . '/templates/contactos/verContacto.php';
			
		}
		
		function obtenerDireccion()
		{
			if ($_REQUEST['postcode']!="") {
				
				$idCodPost = $_REQUEST['postcode'];
				
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
							
				$codPost = $m->obtenerCodigoP($idCodPost);			
				$obtenerDatosDir = $codPost;
			}

			require __DIR__ . '/templates/contactos/verDireccion.php';
		}
		
		public function insertarContacto(){
				
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			$parametrosContactos = array(
				//Datos Contacto
				'idCont' => $m->obtenerIdContacto(),
				'nombre' => '',
				'app' => '',
				'apm' => '',
				'area' => '',
				'movil' => '',
				'tel_ofi' => '',
				'tel_emer' => '',
				'correoPers' => '',
				'correoInsti' => '',
				'RSFacebook' => '',
				'RSTwitter' => '',
				'RSSkype' => '',
				'pagWeb' => '',
				//Datos dirección física
				'idDir' => $m->incrementoDir(),
				'cp' => '',
				'calleD' => '',
				'numExterior' => '',
				'numInterior' => '',
				'coloniaD' => '',
				'referenciaD' => '',
			);
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				//print_r($_POST);
				
				if($_POST['numInt'] == ""){
					$_POST['numInt'] = 0;
				}

				if($m->registrarContacto($_POST['idAddress'],$_POST['idcp-locality'],$_POST['street'],$_POST['numExt'],$_POST['numInt'],$_POST['colonia'],$_POST['reference'],
					$_POST['idContact'],$_POST['nameContact'],$_POST['ApPContact'],$_POST['ApMContact'],$_POST['nameArea'],$_POST['telMovil'],$_POST['telOficina'],
					$_POST['telEmergencia'],$_POST['emailPersonal'],$_POST['emailInstitucional'],$_POST['redSocialF'],$_POST['redSocialT'],$_POST['redSocialS'],
					$_POST['webPage'])){
						header('Location: index.php?url=listContact');
				}else{
					$parametrosContactos = array(
						'idCont' => $_POST['idContact'],
						'nombre' => $_POST['nameContact'],
						'app' => $_POST['ApPContact'],
						'apm' => $_POST['ApMContact'],
						'area' => $_POST['nameArea'],
						'movil' => $_POST['telMovil'],
						'tel_ofi' => $_POST['telOficina'],
						'tel_emer' => $_POST['telEmergencia'],
						'correoPers' => $_POST['emailPersonal'],
						'correoInsti' => $_POST['emailInstitucional'],
						'RSFacebook' => $_POST['redSocialF'],
						'RSTwitter' => $_POST['redSocialT'],
						'RSSkype' => $_POST['redSocialS'],
						'pagWeb' => $_POST['webPage'],
						'idDir' => $_POST['idAddress'],
						'cp' => $_POST['postcode'],
						'calleD' => $_POST['street'],
						'numExterior' => $_POST['numExt'],
						'numInterior' => $_POST['numInt'],
						'coloniaD' => $_POST['colonia'],
						'referenciaD' => $_POST['reference'],
					);
					
					$obtenerDatosDir = array(
						'codigoP' => $m -> obtenerDatosDireccion($_POST['postcode'],$_POST['idcp-locality']),
						'idCP' => $_POST['idcp-locality'], 
						'localidad' => $m -> obtieneNombreLocalidad($_POST['idcp-locality']), 
						'municipio' => $_POST['state'],
						'estado' => $_POST['municipality'], 
					);
					
					$parametrosContactos['mensaje'] = 'Error al registrar contacto. Revise el formulario';
				}
			}
			
			require __DIR__.'/templates/contactos/insertarContacto.php';
		}

		public function eliminarContacto(){
				
			if(!isset($_GET['idContact'])){
				throw new Exception("Página no encontrada", 1);
			}
			
			$IdContacto = $_GET['idContact'];
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			$eliminarContacto = $m-> borrarContacto($IdContacto);
		}

//---------------------------------------------CLIENTES-------------------------------------------

		public function listaCliente()
		{
			/*variable de conexion*/	
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerCliente = array(
				'm_clientes' => $m->obtieneClientes(),
			);
			require __DIR__ . '/templates/clientes/mostrarCliente.php';
    	}
    	
    	public function verCliente()
    	{
    		if(!isset($_GET['id_cli'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$cv_cli=$_GET['id_cli'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisCliente=$m->obtieneVcliente($cv_cli);		
			$obtenerCliente=$lisCliente;					
			require __DIR__ . '/templates/clientes/verCliente.php';
    	}
		
		public function buscarXC()
    	{
    	$crit = array(
			'busqueda' => '',
			'resultado' => array(),
			);
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $crit['busqueda'] = $_POST['busqueda'];
             $crit['resultado'] = $m->busquedaX($_POST['busqueda']);
         }
		 
			require __DIR__ . '/templates/clientes/buscador.php';
    	}

    	public function eli_cli()
    	{
    		if(!isset($_GET['id_cli'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$del_cli=$_GET['id_cli'];
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisCliente=$m->elimCliente($del_cli);		
			$obtenerCliente=$lisCliente;				
			require __DIR__ . '/templates/clientes/elim.php';
    	}
		

    	//funcion para el formulario de nuevo_cliente
    	public function agregarCl()
    	{
    	$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
										
			$Clientes = array(
				//datos_cliente
				'idCli' => $m->incrementoCli(),
				'nombre' => '',
				'fecha_alta' => '',
				'activo' => '',
				'idDatF' => $m->incrementodFiscal(),
				'razonS' => '',				
				'rfc' => '',
				'tipoRason_Social' => '',				
				'idAddress' => $m->incrementoDir(),
				'idDBank' => $m->incrementoDB(),
				
			);
						
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
				if($m->addCliente($_POST['idCliente'],$_POST['nomb'],$_POST['f_alta'],$_POST['activo'],$_POST['idDatF'],$_POST['razonS'],$_POST['rfc'],$_POST['tipoRason_Social'],$_POST['idAddress'],
						$_POST['idDBank'],$_POST['nombreB'],$_POST['sucursal'],$_POST['titular'],$_POST['n_cuenta'],$_POST['n_claveInterbancaria'],$_POST['tipo_c'])){
							header('Location: index.php?url=listaCliente');
				} else {
						$Clientes = array(
						//Datos_cliente
						'idCli' => $_POST['idCliente'],
						'nombre' => $_POST['nomb'],
						'fecha_alta' => $_POST['f_alta'],
						'activo' => $_POST['activo'],
						//Datos_fiscales
						'idDatF' => $_POST['idDatF'],
						'razonS' => $_POST['razonS'],
						'rfc' => $_POST['rfc'],
						'tipoRason_Social' => $_POST['tipoRason_Social'],
						//id_direccion
						'idAddress' => $_POST['idAddress'],
						//id_contacto
						//'idCont' => $_POST['idCont'],
						//Datos_bancarios
						'idDBank' => $_POST['idDBank'],
						'nombreB' => $_POST['nombreB'],
						'sucursal' => $_POST['sucursal'],
						'titular' => $_POST['titular'],
						'n_cuenta' => $_POST['n_cuenta'],
						'n_claveInterbancaria' => $_POST['n_claveInterbancaria'],
						'tipo_c' => $_POST['tipo_c'],
																		
					);
					$Clientes['mensaje'] = 'Error al registrar clientes. Revise el formulario';
				}
			}
			require __DIR__ . '/templates/clientes/nuevoCl.php';
    	}
		//funcion para el formulario de editar_cliente
    	public function modCl()
    		{	
    	
			require __DIR__ . '/templates/clientes/modificar_cl.php';
    	}

		// FUNCIONES PROVEEDORES
	
		public function Proveedor()
		{
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

			$obtenerDat = array(
			'proveedores' => $model->obtenerProveedores(),
			);

			require '/templates/proveedor/mostrarProveedores.php';
		}

		public function InsertarProveedor()
		{
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

			require '/templates/proveedor/nuevoPro.php';
		}

		public function cargarContactosPro()
		{
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

				$obtContactos = array(
					'listcontacto' => $model->obtenerContactos(),
				); 
				
			require __DIR__ . '/templates/proveedor/table-contact.php';
		}

		public function verProveedor()
		{
			if (!isset($_GET['id_Proveedor'])) {
				throw new Exception("Página no encontrada", 1);
			}

			$idProveedor = $_GET['id_Proveedor'];

			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

			$detProveedor = $model->obtenerDetalleProveedor($idProveedor);

			$obtenerDatosProveedor = $detProveedor;

			require __DIR__ . '/templates/proveedor/verProveedor.php';
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
		
		public function insertarCodPost()
		{
			
			require __DIR__ . '/templates/________';
		}
		
		public function buscarCodPost()
		{
			
			require __DIR__ . '/templates/________';
		}
		
		public function verCodPost()
		{				
			if (!isset($_GET['idCP'])) {
				throw new Exception("Página no encontrada", 1);
			}
			
			$idCodPost = $_GET['idCP'];
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$codPost = $m->obtenerCodigoPostal($idCodPost);
			
			$obtenerDatos = $codPost;
			
			require __DIR__ . '/templates/verCodigoPostal.php';
		}
    }
?>
