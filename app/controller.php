<?php
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
						
			$obtenerDatosContactos = array(
				'contactos' => $m->obtenerContactos(),
			); 
			
			require __DIR__ . '/templates/mostrarContactos.php';
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
			
			require __DIR__ . '/templates/verContacto.php';
			
		}
		
		public function insertarContacto(){
				
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			/*$parametrosEstado = array(
				'dirEstado' => $m->obtieneEstado(),
			);*/
			
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
				'dirEstado' => $m->obtieneEstado(),
				'calleD' => '',
				'numExterior' => '',
				'numInterior' => '',
				'coloniaD' => '',
				'referenciaD' => '',
			);
			
			
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
				if($m->registrarContacto($_POST['idAddress'],$_POST['street'],$_POST['numExt'],$_POST['numInt'],$_POST['colonia'],$_POST['reference'],
						$_POST['idContact'],$_POST['nameContact'],$_POST['ApPContact'],$_POST['ApMContact'],$_POST['nameArea'],$_POST['telMovil'],$_POST['telOficina'],
						$_POST['telEmergencia'],$_POST['emailPersonal'],$_POST['emailInstitucional'],$_POST['redSocialF'],$_POST['redSocialT'],$_POST['redSocialS'],
						$_POST['webPage'],$_POST['state'])){
							header('Location: index.php?url=listContact');
				} else {
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
						'calleD' => $_POST['street'],
						'numExterior' => $_POST['numExt'],
						'numInterior' => $_POST['numInt'],
						'coloniaD' => $_POST['colonia'],
						'referenciaD' => $_POST['reference'],
					);
					$parametrosContactos['mensaje'] = 'Error al registrar contactos. Revise el formulario';
				}
			}
			
			require __DIR__.'/templates/insertarContacto.php';
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

		public function InsertarProveedor()
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
				'idDatFis' => $model->incrementoDatFis(),	
				'razon_s' => '',
				'rfc' => '',
				'tipo_razon' => $model->obtieneTrazon(),
				// datos direccion fisica
				'idDire' => $model->incrementoDir(),
				'street' => '',
				'n_ext' => '',
				'n_int' => '',
				'colo' => '',
				'ref' => '',
				
				// datos bancarios
				'banco' => $model->obtieneBanco(),
				'sucursal' => '',
				'titular' => '',
				'num_cuenta' => '',
				'clabe' => '',
				'tipo_cta' => $model->obtieneTipoC(),
			);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				if($model->registrarProveedores($_POST['txt_iddf'],
												$_POST['txt_razon_s'],
												$_POST['txt_rfc'],
												$_POST['slt_tipo_rs'],
												$_POST['txt_iddir'],
												$_POST['txt_calle'],
												$_POST['txt_noext'],
												$_POST['txt_noint'],
												$_POST['txt_col'],
												$_POST['txt_ref'],
												$_POST['txt_idProv'],
												$_POST['txt_nombrepro'],
												$_POST['slt_catprov'],
												$_POST['txt_tel_pro'],
												$_POST['txt_url_web'])){
					print_r($_POST);
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
						'tipo_razon' => $_POST['slt_tipo_rs'],
						// datos direccion fisica
						'idDire' => $_POST['txt_iddir'],
						'street' => $_POST['txt_calle'],
						'n_ext' => $_POST['txt_noext'],
						'n_int' => $_POST['txt_noint'],
						'colo' => $_POST['txt_col'],
						'ref' => $_POST['txt_ref'],
					);
				}

			}

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
    }
?>