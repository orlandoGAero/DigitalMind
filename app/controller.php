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
		
		//---------------------------------------------DIRECCIÓN-------------------------------------------
		/*function obtenerDireccion()
		{
			if ($_REQUEST['postcode']!="") {
				
				$idCodPost = $_REQUEST['postcode'];
				
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
							
				$codPost = $m->obtenerCodigoP($idCodPost);			
				$obtenerDatosDir = $codPost;
			}

			require __DIR__ . '/templates/contactos/verDireccion.php';
		}*/
		
		function obtenerMunicipio()
		{
			if ($_REQUEST['state']!="") {
				
				$nameState = $_REQUEST['state'];
				
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
							
				$municipio = $m->municipioObtener($nameState);			
				$obtenerDatosMun = $municipio;
			}

			require __DIR__ . '/templates/contactos/verMunicipio.php';
		}

		/*----------------------------------cambiar ruta -------------------*/
		// funcion para municipios de la dirección fiscal de proveedores
		function obtenerMunicipioDirFiscal()
		{
			if ($_REQUEST['statef']!="") {
				
				$nameState = $_REQUEST['statef'];
				
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
							
				$municipio = $m->municipioObtener($nameState);			
				$obtenerDatosMun = $municipio;
			}

			require __DIR__ . '/templates/contactos/verMunicipio.php';
		}
		
		function obtenerDireccionLocalidad()
		{
			if ($_REQUEST['idEstado'] !="" && $_REQUEST['municipio'] && $_REQUEST['localidad'] !="") {
					
				$idState = $_REQUEST['idEstado']; 
				$nameMunicipality = $_REQUEST['municipio'];
				$nameLocality = $_REQUEST['localidad'];
				
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
							
				$dirL = $m->obtener_direccion($idState,$nameMunicipality,$nameLocality);			
				$obtenerDatosDireccion = $dirL;
			}

			require __DIR__ . '/templates/contactos/verDireccionLocalidad.php';
		}

		// funcion para localidad de la dirección fiscal de proveedores
		function obtenerDireccionLocalidadDirFiscal()
		{
			if ($_REQUEST['idEstadof'] !="" && $_REQUEST['idMunicipiof'] && $_REQUEST['txt_localidad_f'] !="") {
					
				$idState = $_REQUEST['idEstadof']; 
				$nameMunicipality = $_REQUEST['idMunicipiof'];
				$nameLocality = $_REQUEST['txt_localidad_f'];
				
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
							
				$dirL = $m->obtener_direccion($idState,$nameMunicipality,$nameLocality);			
				$obtenerDatosDireccion = $dirL;
			}

			require __DIR__ . '/templates/proveedor/verDirLocalidad-DireccionFiscal.php';
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
				'whatsAppC' => 'No',
				'ext' => '',
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
				'stateID' => $m->obtenerEstados(),
				'nomEstado' => '',
				'nomMunicipio' => '',
				'nameLocality' => '',
				'cp' => '',
				'calleD' => '',
				'numExterior' => '',
				'numInterior' => '',
				'coloniaD' => '',
				'referenciaD' => '',
			);
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// print_r($_POST);
				
				if($_POST['numInt'] == ""){
					$_POST['numInt'] = 0;
				}
				
				if(!isset($_POST['idcp-locality'])){
					$_POST['idcp-locality'] = 0;
				}

				if($m->registrarContacto($_POST['idAddress'],$_POST['idcp-locality'],$_POST['street'],$_POST['numExt'],$_POST['numInt'],$_POST['colonia'],$_POST['reference'],
					$_POST['idContact'],$_POST['nameContact'],$_POST['ApPContact'],$_POST['ApMContact'],$_POST['nameArea'],$_POST['telMovil'],$_POST['whatsappMovil'],
					$_POST['extC'],$_POST['telOficina'],$_POST['telEmergencia'],$_POST['emailPersonal'],$_POST['emailInstitucional'],$_POST['redSocialF'],$_POST['redSocialT'],
					$_POST['redSocialS'],$_POST['webPage'])){
						header('Location: index.php?url=listContact');
				}else{
					$parametrosContactos = array(
						'idCont' => $_POST['idContact'],
						'nombre' => $_POST['nameContact'],
						'app' => $_POST['ApPContact'],
						'apm' => $_POST['ApMContact'],
						'area' => $_POST['nameArea'],
						'movil' => $_POST['telMovil'],
						'whatsAppC' => $_POST['whatsappMovil'],
						'ext' => $_POST['extC'],
						'tel_ofi' => $_POST['telOficina'],
						'tel_emer' => $_POST['telEmergencia'],
						'correoPers' => $_POST['emailPersonal'],
						'correoInsti' => $_POST['emailInstitucional'],
						'RSFacebook' => $_POST['redSocialF'],
						'RSTwitter' => $_POST['redSocialT'],
						'RSSkype' => $_POST['redSocialS'],
						'pagWeb' => $_POST['webPage'],
						'idDir' => $_POST['idAddress'],
						'stateID' => $_POST['idEstado'],
						'nomEstado' => $m -> obtenerNombreEstado($_POST['idEstado']),
						// Combobox Estados
						'estados' => $m -> obtenerDatosEstadoInsert($_POST['idEstado']),
						'nomMunicipio' => $_POST['municipio'],
						// Combobox Municipios
						'municipios' => $m -> obtenerDatosMunicipioInsert($_POST['idEstado'], $_POST['municipio']),
						'nameLocality' => $_POST['localidad'],
						//Table Localidades
						'localidades' => $m -> obtener_direccion($_POST['idEstado'], $_POST['municipio'], $_POST['localidad']),
						//
						'idCP' => $_POST['idcp-locality'],
						'calleD' => $_POST['street'],
						'numExterior' => $_POST['numExt'],
						'numInterior' => $_POST['numInt'],
						'coloniaD' => $_POST['colonia'],
						'referenciaD' => $_POST['reference'],
						//Obtener direción según cp
						//'cp' => $_POST['postcode'],
						// 'codigoP' => $m -> obtenerDatosDireccionInsert($_POST['postcode'],$_POST['idcp-locality']),
						// 'idCP' => $_POST['idcp-locality'], 
						// 'localidadC' => $m -> obtieneNombreLocalidad($_POST['idcp-locality']), 
						// 'municipio' => $_POST['municipality'],
						// 'estado' => $_POST['state'],
					);
					
					$parametrosContactos['mensaje'] = 'Error al registrar contacto. Revise el formulario';
				}
			}
			
			require __DIR__.'/templates/contactos/insertarContacto.php';
		}

		public function buscarContacto(){
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerDatosContactos = array(
				'contactos' => $m->busquedaContactos($_REQUEST['nombreContacto'],$_REQUEST['municipioContacto'],$_REQUEST['areaContacto']),
			); 
			
			require __DIR__.'/templates/contactos/mostrarContactosFiltros.php';
		}

		public function modificarContacto(){
			
			if(!isset($_GET['idContact'])){
				throw new Exception("Página no encontrada", 1);
			}
			
			$IdContacto = $_GET['idContact'];
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			//Obtener datos de contacto
			$detalleContacto = $m->obtenerContacto($IdContacto);
			
			$obtenerDatosContacto = $detalleContacto;
			
			$obtenerDatosDir = array(
				'estados' => $m -> obtenerDatosEstadoUpdate($IdContacto),
				'municipios' => $m -> obtenerDatosMunicipioUpdate($IdContacto),
				'localidades' => $m -> obtener_direccion_update($IdContacto),
			);
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				print_r($_POST);
				
				if($_POST['numInt'] == ""){
					$_POST['numInt'] = 0;
				}

				if(!isset($_POST['idcp-locality'])){
					$_POST['idcp-locality'] = 0;
				}

				if($m->actualizarContacto($_POST['idAddress'],$_POST['idcp-locality'],$_POST['street'],$_POST['numExt'],$_POST['numInt'],$_POST['colonia'],$_POST['reference'],
					$_POST['idContact'],$_POST['nameContact'],$_POST['ApPContact'],$_POST['ApMContact'],$_POST['nameArea'],$_POST['telMovil'],$_POST['whatsappMovil'],
					$_POST['extC'],$_POST['telOficina'],$_POST['telEmergencia'],$_POST['emailPersonal'],$_POST['emailInstitucional'],$_POST['redSocialF'],$_POST['redSocialT'],
					$_POST['redSocialS'],$_POST['webPage'],$_POST['activoC'])){
						header('Location: index.php?url=listContact');
				}else{
					$obtenerDatosContacto = array(
						'id_contacto' => $_POST['idContact'],
						'nombreCon' => $_POST['nameContact'],
						'ap_paterno' => $_POST['ApPContact'],
						'ap_materno' => $_POST['ApMContact'],
						'nombre_area' => $_POST['nameArea'],
						'movil' => $_POST['telMovil'],
						'whatsapp' => $_POST['whatsappMovil'],
						'extension' => $_POST['extC'],
						'tel_oficina' => $_POST['telOficina'],
						'tel_emergencia' => $_POST['telEmergencia'],
						'correo_p' => $_POST['emailPersonal'],
						'correo_instu' => $_POST['emailInstitucional'],
						'facebook' => $_POST['redSocialF'],
						'twitter' => $_POST['redSocialT'],
						'skype' => $_POST['redSocialS'],
						'direccion_web' => $_POST['webPage'],
						'activo' => $_POST['activoC'],
						'id_direccion' => $_POST['idAddress'],
						'id_estado' => $_POST['idEstado'],
						'estado' => $m -> obtenerNombreEstado($_POST['idEstado']),
						// Combobox Estados
						'estados' => $m -> obtenerDatosEstadoInsert($_POST['idEstado']),
						'municipio' => $_POST['municipio'],
						// Combobox Municipios
						'municipios' => $m -> obtenerDatosMunicipioInsert($_POST['idEstado'], $_POST['municipio']),
						'localidadAfter' => $_POST['localidad'],
						//Table Localidades
						'localidades' => $m -> obtener_direccion($_POST['idEstado'], $_POST['municipio'], $_POST['localidad']),
						//
						'id_cp' => $_POST['idcp-locality'],
						'calle' => $_POST['street'],
						'num_ext' => $_POST['numExt'],
						'num_int' => $_POST['numInt'],
						'colonia' => $_POST['colonia'],
						'referencia' => $_POST['reference'],
						// 'localidad' =>$m -> obtieneNombreLocalidad($_POST['idcp-locality']),
						// 'municipio' => $_POST['state'],
						// 'estado' => $_POST['municipality'], 
					);
					
					// $obtenerDatosDir = array(
						// 'codigoP' => $_POST['postcode'],
						// 'codigoP' => $m -> obtenerDatosDireccionInsert($_POST['postcode'],$_POST['idcp-locality']),
						// 'id_cp' => $_POST['idcp-locality'], 
						// 'localidad' => $m -> obtieneNombreLocalidad($_POST['idcp-locality']), 
					// );
					
					$parametrosContactos['mensaje'] = 'Error al actualizar contacto. Revise el formulario';
				}
			}

			require  __DIR__.'/templates/contactos/modificarContacto.php';
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

public function mostrarContactos(){
			if(!isset($_GET['idCont'])){
				throw new Exception("Página no encontrada", 1);
			}
			
			$IdCo = $_GET['idCont'];
			
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			$detContacto = $model->obtenerContacto($IdCo);
			
			$MostrarDatosContacto = $detContacto;
			
			require __DIR__ . '/templates/proveedor/datosContProv.php';
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

		// -----------------------FUNCIONES PROVEEDORES---------------------------------
	
		public function Proveedor()
		{
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

			$obtenerDat = array(
			'proveedores' => $model->obtenerProveedores(),
			);

			require '/templates/proveedor/mostrarProveedores.php';
		}

		
		public function InsertarProveedor_part1()
		{
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

			$parametrosProveedores = array(
				// datos proveedor
				'idprov' => $model->obtenerIdProveedor(),
				'proveedor' => '',
				'categoriaprov' => $model->obtenerCategoria(),	
				'phone' => '',
				'direweb' => '',
				
				// datos fiscales
				'idDatFis' => $model->incrementodFiscal(),	
				'razon_s' => '',
				'rfc' => '',
				
				//datos direccion fiscal
				'idDireFiscal' => $model->incrementoDir(),
				'idStateFiscal' => $model->obtenerEstados(),
				'nameEstadoFiscal' => '',
				'nameMunicipioFiscal' => '',
				'nameLocalityFiscal' => '',
				'cpFiscal' => '',
				'streetFiscal' => '',
				'n_extFiscal' => '',
				'n_intFiscal' => '',
				'coloFiscal' => '',
				'refFiscal' => '',

				// datos direccion fisica
				'idDire' => $model->incrementoDir()+1,
				'idState' => $model->obtenerEstados(),
				'nameEstado' => '',
				'nameMunicipio' => '',
				'nameLocality' => '',
				'cp' => '',
				'street' => '',
				'n_ext' => '',
				'n_int' => '',
				'colo' => '',
				'ref' => '',
			);

			require '/templates/proveedor/nuevoPro.php';;
		}

		public function InsertarProveedores_part2()
		{
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

			// print "<pre>"; print_r($_POST); print "</pre>\n";
			
			
			$parametrosProveedores = array(
							
			// datos proveedor
			'idprov' => $_POST['txt_idProv'],
			);

			$parametrosDatosBank = array(
				// datos bancarios
				'idBank' => $model->incrementoDB(),
				'banco' => $model->obtieneBanco(),
				'sucursal' => '',
				'titular' => '',
				'num_cuenta' => '',
				'clabe' => '',
				'tipo_cta' => $model->obtieneTipoC(),
			);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// print "<pre>"; print_r($_POST); print "</pre>\n";
				if($_POST['txt_noint'] == ""){
					$_POST['txt_noint'] = "s/n";
				}

				if($_POST['txt_noint_f'] == ""){
					$_POST['txt_noint_f'] = "s/n";
				}

				if ($model->registrarProveedores($_POST['txt_iddir'],
												$_POST['txt_calle'],
												$_POST['txt_noext'],
												$_POST['txt_noint'],
												$_POST['txt_col'],
												$_POST['txt_ref'],
												$_POST['idcp-locality'],
												$_POST['txt_iddir_fis'],
												$_POST['txt_calle_f'],
												$_POST['txt_noext_f'],
												$_POST['txt_noint_f'],
												$_POST['txt_col_f'],
												$_POST['txt_ref_f'],
												$_POST['idcp-localityFiscal'],
												$_POST['txt_iddf'],
												$_POST['txt_razon_s'],
												$_POST['txt_rfc'],
												$_POST['txt_idProv'],
												$_POST['txt_nombrepro'],
												$_POST['slt_catprov'],
												$_POST['txt_tel_pro'],
												$_POST['txt_url_web'])
				){
					# code...header('Location: index.php?url=Proveedores');
				} else {

					$parametrosProveedores = array(
							
						// datos proveedor
						'idprov' => $_POST['txt_idProv'],
						'proveedor' => $_POST['txt_nombrepro'],
						'categoriaprov' => $_POST['slt_catprov'],
						'phone' => $_POST['txt_tel_pro'],
						'direweb' => $_POST['txt_url_web'],
						
						// datos fiscales
						'idDatFis' => $_POST['txt_iddf'],
						'razon_s' => $_POST['txt_razon_s'],
						'rfc' => $_POST['txt_rfc'],

						//datos direccion fiscal
						'idDireFiscal' => $_POST['txt_iddir_fis'],

							// Combobox Estados
						'estadosF' => $model -> obtenerDatosEstadoInsert($_POST['idEstadof']),
						'nameMunicipioFiscal' => $_POST['idMunicipiof'],
							// Combobox Municipios
						'municipiosF' => $model -> obtenerDatosMunicipioInsert($_POST['idEstadof'], $_POST['idMunicipiof']),
						'nameLocalityFiscal' => $_POST['txt_localidad_f'],
							// Table localidades
						'localidadesF' => $model -> obtener_direccion($_POST['idEstadof'], $_POST['idMunicipiof'], $_POST['txt_localidad_f']),

						'cpFiscal' => $_POST['idcp-localityFiscal'],
						'streetFiscal' => $_POST['txt_calle_f'],
						'n_extFiscal' => $_POST['txt_noext_f'],
						'n_intFiscal' => $_POST['txt_noint_f'],
						'coloFiscal' => $_POST['txt_col_f'],
						'refFiscal' => $_POST['txt_ref_f'],

						// datos direccion fisica
						'idDire' => $_POST['txt_iddir'],

							// Combobox Estados
						'estados' => $model -> obtenerDatosEstadoInsert($_POST['idEstado']),
						'nameMunicipio' => $_POST['municipio'],
							// Combobox Municipios
						'municipios' => $model -> obtenerDatosMunicipioInsert($_POST['idEstado'], $_POST['municipio']),
						'nameLocality' => $_POST['localidad'],
							//Table Localidades
						'localidades' => $model -> obtener_direccion($_POST['idEstado'], $_POST['municipio'], $_POST['localidad']),
						
						'cp' => $_POST['idcp-locality'],
						'street' => $_POST['txt_calle'],
						'n_ext' => $_POST['txt_noext'],
						'n_int' => $_POST['txt_noint'],
						'colo' => $_POST['txt_col'],
						'ref' => $_POST['txt_ref'],
					);
					
					$parametrosProveedores['mensaje'] = 'Error al registrar Proveedores . Revise el formulario';

				} /*endelse*/
			}

			require '/templates/proveedor/nuevoPro_parte2.php';

		}

		public function InsertarDatosBancariosP()
		{
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

			print "<pre>"; print_r($_REQUEST); print "</pre>\n";

			$div = $_REQUEST['div'];
			
			/* validación si el div es igual a frmDB muestra el formulario datos bancarios*/
			if($div == 'frmDB') {

				$id_Prove = $_REQUEST['txt_IDProv'];
			
				$parametrosProveedores = array(
					'idprov' => '',
				);

				$parametrosDatosBank = array(
					// datos bancarios
					'idBank' => $model->incrementoDB(),
					'banco' => $model->obtieneBanco(),
					'sucursal' => '',
					'titular' => '',
					'num_cuenta' => '',
					'clabe' => '',
					'tipo_cta' => $model->obtieneTipoC(),
				);
					
					$model->registrarProv_DatosBank($_REQUEST['txt_iddb'],
														$_REQUEST['slt_banco'],
														$_REQUEST['txt_suc'],
														$_REQUEST['txt_titul'],
														$_REQUEST['txt_cuenta'],
														$_REQUEST['txt_clabe'],
														$_REQUEST['slt_tipo_c'],
														$_REQUEST['txt_IDProv']);
					
			} /*endIf frmDB*/

			/*validación si el div es igual a tblDB muestra la tabla de datos bancarios*/
			if($div == 'tblDB') {
				
				$id_Prove = $_REQUEST['txt_IDProv'];
				
				$tablaDB_Prov = array(
					'datos-bancarios' => $model->obtDatBankPro($id_Prove)
				);
			} /*endIf tblDB*/


			require '/templates/proveedor/addDBancarios.php';
		}

		public function ModificarProveedor()
		{
			if(!isset($_GET['id_Proveedor'])){
				throw new Exception("Página no encontrada", 1);
			}

			$IdProv = $_GET['id_Proveedor'];

			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

			// obtener datos de proveedor
			$detalleProv = $model->obtenerDetalleProveedor($IdProv);
			
			$obtenerDatosProv = $detalleProv;

			// obtener categoria del proveedor
			$obtenerCatPro = array(
				'categoriaprov' => $model ->  obtCategoriaUpdate($IdProv),
			);

			// obtener direccion
			$obtenerDatosDir = array(
				'codigoP' => $model -> obtenerDatosDireccionUpdateProv($IdProv),
			);

			//obtener banco
			$obtenerBank = array(
				'bancarios' => $model -> obtBankUpdateProv($IdProv),
			);

			//obtener tipo de cuenta
			$obtenerTaccount = array(
				'tipo_cta' => $model -> obtTctaUpdateProv($IdProv),
			);


			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				print_r($_POST);
				if($_POST['txt_noint'] == ""){
					$_POST['txt_noint'] = "s/n";
				}
				
				if($model->actualizarProveedores($_POST['txt_iddf'],
												$_POST['txt_razon_s'],
												$_POST['txt_rfc'],
												$_POST['txt_iddir'],
												$_POST['txt_calle'],
												$_POST['txt_noext'],
												$_POST['txt_noint'],
												$_POST['txt_col'],
												$_POST['txt_ref'],
												$_POST['idcp-locality'],
												$_POST['txt_idProv'],
												$_POST['txt_nombrepro'],
												$_POST['slt_catprov'],
												$_POST['txt_tel_pro'],
												$_POST['txt_url_web'],
												$_POST['txt_iddb'],
												$_POST['slt_banco'],
												$_POST['txt_suc'],
												$_POST['txt_titul'],
												$_POST['txt_cuenta'],
												$_POST['txt_clabe'],
												$_POST['slt_tipo_c'])){
					header('Location: index.php?url=Proveedores');
				} else {

					$obtenerDatosProv = array(
					
						// datos proveedor
						'idprov' => $_POST['txt_idProv'],
						'proveedor' => $_POST['txt_nombrepro'],
						'phone' => $_POST['txt_tel_pro'],
						'direweb' => $_POST['txt_url_web'],
						
						// datos fiscales
						'idDatFis' => $_POST['txt_iddf'],
						'razon_s' => $_POST['txt_razon_s'],
						'rfc' => $_POST['txt_rfc'],

						// datos direccion fisica
						'idDire' => $_POST['txt_iddir'],
						'street' => $_POST['txt_calle'],
						'n_ext' => $_POST['txt_noext'],
						'n_int' => $_POST['txt_noint'],
						'colo' => $_POST['txt_col'],
						'ref' => $_POST['txt_ref'],
						
						// datos bancarios
						'idBank' => $_POST['txt_iddb'],
						'sucursal' => $_POST['txt_suc'],
						'titular' => $_POST['txt_titul'],
						'num_cuenta' => $_POST['txt_cuenta'],
						'clabe' => $_POST['txt_clabe'],
					);
						
					$obtenerCatPro = array(
						'categoriaprov' => $_POST['slt_catprov'],
					);
						
					$obtenerDatosDir = array(
						'codigoP' => $model -> obtenerDatosDireccionInsert($_POST['postcode'],$_POST['idcp-locality']),
						'id_cp' => $_POST['idcp-locality'], 
						'localidad' => $model -> obtieneNombreLocalidad($_POST['idcp-locality']), 
						
					);

					$obtenerBank = array(
						'banco' => $_POST['slt_banco'],
					);

					$obtenerTaccount = array(
						'tipo_cta' => $_POST['slt_tipo_c'],
					);
				}
			}

			require '/templates/proveedor/editarPro.php';
		}

		public function EliminarProveedor(){
				
			if(!isset($_GET['id_Proveedor'])){
				throw new Exception("Página no encontrada", 1);
			}
			
			$IdPro = $_GET['id_Proveedor'];
			
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			$eliminarProv = $model-> borrarProveedores($IdPro);
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
			//obtener direccion fiscal del proveedor
			$detProvDirFis = $model->DetalleDirFiscalProv($idProveedor);

			$obtDirFiscal = $detProvDirFis;

			require __DIR__ . '/templates/proveedor/verProveedor.php';
		}

		// ----------------------- FUNCIONES INVENTARIO ----------------------------------------

		public function Inventarios()
		{
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

			$obtenerInv = array(
			// 'inventario' => $model->obtenerInventario(),
			);

			require '/templates/inventario/mostrarInventario.php';
		}

		public function AgregarInventario()
		{
			$model = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

			require '/templates/inventario/nuevoInventario.php';
		}
    }
?>
