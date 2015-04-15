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
		
		//---------------------------------------------CONTACTOS-------------------------------------------
		public function listarContacto()
		{
			// Realiza la conexión a la Base de datoss
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			//Se crea un array dentro de la variable $obtenerDatosContactos
			$obtenerDatosContactos = array(
				/*Se crea un parámetro que manda a llamar la conexión 
				 * a la BD para obtener acceso a la función de obtenerContactos(),
				 * dicha función realiza la consulta de los contactos activos*/
				'contactos' => $m->obtenerContactos(),
			); 
			// Manda a llamar el archivo mostrarContactos.php
			require __DIR__ . '/templates/contactos/mostrarContactos.php';
		}
		// La funcion ver contacto muestra el detalle del contacto
		public function verContacto(){
			// Se valida que se reciba el id del contacto
			if(!isset($_GET['idContact'])){
				throw new Exception("Página no encontrada", 1);
			}
			
			$IdContacto = $_GET['idContact'];
			// Realiza la conexión a la Base de datos
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			/*Dentro de la varible se manda a llamar la conexión a la BD para obtener
			 * acceso a la función obtener contacto, la cual recibe como parámetro el id del contacto*/
			$detalleContacto = $m->obtenerContacto($IdContacto);
			
			$obtenerDatosContacto = $detalleContacto;
			// Manda a llamar el archivo verContacto.php
			require __DIR__ . '/templates/contactos/verContacto.php';
			
		}
		
		public function insertarContacto(){
			// Realiza la conexión a la Base de datos	
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			//Se crea un array con los datos del contacto
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
				//Valida si el número interior esta vacío le asigna un 0 
				if($_POST['numInt'] == ""){
					$_POST['numInt'] = 0;
				}
				// Valida si no se recibe la variable le asigna un 0
				if(!isset($_POST['idcp-locality'])){
					$_POST['idcp-locality'] = 0;
				}
				// Valida si se ejecuta la función de registarContacto redirecciona a la lista de contactos
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
			// Manda a llamar el archivo insertarContacto.php
			require __DIR__.'/templates/contactos/insertarContacto.php';
		}

		public function buscarContacto(){
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerDatosContactos = array(
				'contactos' => $m->busquedaContactos($_REQUEST['nombreContacto'],$_REQUEST['municipioContacto'],$_REQUEST['coloniaContacto'],
																				$_REQUEST['areaContacto'],$_REQUEST['telMovilContacto'],$_REQUEST['emailPerContacto']),
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
				// print_r($_POST);
				
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
						'estadoAfter' => $m -> obtenerNombreEstado($_POST['idEstado']),
						// Combobox Estados
						'estados' => $m -> obtenerDatosEstadoInsert($_POST['idEstado']),
						'municipioAfter' => $_POST['municipio'],
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

//---------------------------------------------CLIENTES (SAM)-------------------------------------------
	
		//función para mandar a vista el listado de clientes
		public function listaCliente()
		{
			/*variable de conexion*/	
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerCliente = array(
				'm_clientes' => $m->obtieneClientes(),
			);
			
			/*combo_NombreRazonSocial
			$CargaCombo4 = $m->nombreRazonS();			
			$obtenerDatos4 = $CargaCombo4;	*/
		
			require __DIR__ . '/templates/clientes/mostrarCliente.php';
    	}
    	//función para mandar a vista el detalle del cliente
		public function verCliente()
    	{
    		if(!isset($_GET['id_cli'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$idCli=$_GET['id_cli'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisCliente=$m->obtieneVcliente($idCli);	

			$obtenerCliente=$lisCliente;		
			
			//Obtener tabla de contactos asignados al cliente
       		 $Contactos=$m->obtieneContactoCliente($idCli);
       		//Obtener tabla de datos bancarios asignados al cliente
       		 $DatosBank=$m->obtieneDatosBCliente($idCli);
			
			require __DIR__ . '/templates/clientes/verCliente.php';
    	}
		


		//Función para COMBOS
		public function verInfoCP()
		{
			if ($_REQUEST['cp'] !="") {
				$idCodPost = $_REQUEST['cp'];				
				print_r($idCodPost);
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
				$InfoCP = $m->obtenerCodigoP($idCodPost);			
				$obtenerInfo = $InfoCP;
			}
			require __DIR__ . '/templates/clientes/form_dir.php';
		}	

		//Función para COMBOS
		public function verInfoCP2()
		{
			if ($_REQUEST['cp'] !="") {
				$idCodPost = $_REQUEST['cp'];				
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
				$InfoCP = $m->obtenerCodigoP($idCodPost);			
				$obtenerInfo = $InfoCP;
			}
			require __DIR__ . '/templates/clientes/form_dir2.php';
		}	
		
			//función para mandar a vista datos municipio (COMBOS MAGICOS :P SAM)
			public function verMunicipio()
		{
			if ($_REQUEST['idEdo'] !="") {
				
                $idEdo = $_REQUEST['idEdo'];	
                $select = $_REQUEST['select'];
				
                
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
				$InfoCP = $m->obtenerMunicipio($idEdo);			
				$obtenerInfo = $InfoCP;
			}
            
			require __DIR__ . '/templates/clientes/form_dir.php';
		}	

		//función para mandar a vista datos de localidad(COMBOS MAGICOS :P SAM)
		public function verLocalidad()
		{
			if ($_REQUEST['select'] !="") {

				$select = $_REQUEST['select'];
                if($select==1)
                {
				$idEdo = $_REQUEST['idEdo'];				
				$municipio = $_REQUEST['municipios'];
                }else{
				$idEdo = $_REQUEST['idEdo2'];				
				$municipio = $_REQUEST['municipios2'];

                }
                
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
				$InfoCP = $m->obtenerLocalidad($idEdo,$municipio);
                
				$obtenerInfo = $InfoCP;
			}
			require __DIR__ . '/templates/clientes/form_dir2.php';
		}	
	
		/*************************************************************************************/


		//Función para agregar nuevo cliente
		public function addCliente()
    	{
         		
    	$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	$idcli = $_REQUEST['idCliente'];
            
    //if(isset($_REQUEST['nomb'])){
    	if(isset($_REQUEST['nomb'])){
			if(strlen($_REQUEST['rfc'])<12){
			echo "<script>  alert ('Ingrese un rfc valido')
					window.location='index.php?url=agregarCl';</script>";
				}	
		else{

		$idcli = $_REQUEST['idCliente'];
		$nomb =       $_REQUEST['nomb'];
		$movil =        $_REQUEST['telMovil'];
		$oficina =        $_REQUEST['telOficina'];
		$emergencia =        $_REQUEST['telEmergencia'];
		$ext =        $_REQUEST['extension'];
		$dirWeb =        $_REQUEST['dirWeb'];
		$catego = $_REQUEST['categoria'];
		$iddir =     $_REQUEST['idDir'];
		$idcp=        $_REQUEST['id_cp'];                    
		$calle    =    $_REQUEST['calle'];
		$nume    =    $_REQUEST['numExt'];
		$numi   =     $_REQUEST['numInt'];
		$col   =     $_REQUEST['colonia'];
		$ref  =      $_REQUEST['ref'];
	    /*Datos Fiscales*/
        $idDatF  =      $_REQUEST['idDatF'];
        $razonS  =      $_REQUEST['razonS'];
        $rfc  =      $_REQUEST['rfc'];
        $iddir2 =     $_REQUEST['idDir2'];
		$idcp2 =        $_REQUEST['id_cp2'];                    
		$calle2     =    $_REQUEST['calle2'];
		$nume2     =    $_REQUEST['numExt2'];
		$numi2    =     $_REQUEST['numInt2'];
		$col2    =     $_REQUEST['colonia2'];
		$ref2   =      $_REQUEST['ref2'];
    
        $addCliente=$m->addCliente($iddir,$calle,$nume,$numi,$col,$ref,$idcp,
                          $idcli,$nomb,$movil,$oficina,$emergencia,$ext,$dirWeb,$catego
                        ,$idDatF,$razonS,$rfc,$iddir2,$idcp2,$calle2,$nume2,$numi2,$col2,$ref2           
                           /*$id_datBank,$idBanco,$sucursal,$titular,$noCuenta,$cvInterban,$idTC,$idDetBank*/);
            }
          }  
        $comboEstados = $m->obtenerEstado();    
        $idFisc=$m->incrementodFiscal();
		$CargaCombo2 = $m->obtieneBanco();			
		$obtenerDatos2 = $CargaCombo2;
		//combo_tipoCuenta
		$CargaCombo3 = $m->obtieneTipoC();			
		$obtenerDatos3 = $CargaCombo3;
            
            $idDatBank = $m->incrementoDB();
            
            $idCon = $m->obtenerIdContacto();

            $idDir = $m->incrementoDir();
            
       
		require __DIR__ . '/templates/clientes/addCliente.php';   
        }

		//------------Función para agregar dat Bancarios----        
        public function nuevoDB()
    	{
         		
    	$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
            $idcli = $_REQUEST['idCliente'];
            $div = $_REQUEST['div'];
            if($div==1){
            
                $idDatBank = $_REQUEST['idDatBank'];
                $nombreB = $_REQUEST['nombreB'];
                $sucursal = $_REQUEST['sucursal'];
                $titular = $_REQUEST['titular'];
                $n_cuenta = $_REQUEST['n_cuenta'];
                $n_claveInterbancaria = $_REQUEST['n_claveInterbancaria'];
                $tipo_c = $_REQUEST['tipo_c'];
                
                
				$insertar=$m->AgregarDatBancarios
				($idDatBank,$nombreB,$sucursal,$titular,$n_cuenta,$n_claveInterbancaria,$tipo_c,$idcli);    
			    //id_incremental para datos bancarios
			    $idDatBank = $m->incrementoDB(); 
			    //combo nombr banco       
				$CargaCombo2 = $m->obtieneBanco();			
				$obtenerDatos2 = $CargaCombo2;
				//combo_tipoCuenta
				$CargaCombo3 = $m->obtieneTipoC();			
				$obtenerDatos3 = $CargaCombo3;
				// $TableBanco = $m->obtenerDatBancarios($idcli);
            }
            if($div==2)
            {
              $TableBanco = $m->obtenerDatBancarios($idcli);
            }
		require __DIR__ . '/templates/clientes/nuevoDB.php';   
        }
        //------------Agregar nuevo contacto desde clientes una vez asiganda la clave del cliente-------
        public function nuevoContacto()
    	{
         		
    	$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
            $idcli = $_REQUEST['idCliente'];
            $idContact = $_REQUEST['idContact'];
            $nameContact  = $_REQUEST['nameContact'];
            $ApPContact  = $_REQUEST['ApPContact'];
            $ApMContact  = $_REQUEST['ApMContact'];
            $nameArea  = $_REQUEST['nameArea'];
            $telMovil  = $_REQUEST['telMovil'];
           if(isset($_REQUEST['whatsapp'])){
            $whatsapp  = $_REQUEST['whatsapp'];
            }
            else{
                $whatsapp="no";
            }
            $extC  = $_REQUEST['extC'];
            $telOficina  = $_REQUEST['telOficina'];
            $telEmergencia  = $_REQUEST['telEmergencia'];
            $emailPersonal  = $_REQUEST['emailPersonal'];
            $emailInstitucional  = $_REQUEST['emailInstitucional'];
            $redSocialF  = $_REQUEST['redSocialF'];
            $redSocialT  = $_REQUEST['redSocialT'];
            $redSocialS  = $_REQUEST['redSocialS'];
            $webPage  = $_REQUEST['webPage'];
            /*Direccion contacto*/
            $iddir =     $_REQUEST['idDir'];
            $idcp=        $_REQUEST['id_cp'];                    
            $calle    =    $_REQUEST['calle'];
		    $nume    =    $_REQUEST['numExt'];
		    $numi   =     $_REQUEST['numInt'];
            $col   =     $_REQUEST['colonia'];
            $ref  =      $_REQUEST['ref'];
            
            

		$insertar=$m->AgregarDatContacto
			($idcli,$idContact,$nameContact,$ApPContact,$ApMContact,$nameArea,$telMovil,$whatsapp,$extC,
				$telOficina,$telEmergencia,$emailPersonal,$emailInstitucional,$redSocialF,$redSocialT,$redSocialS,$webPage, 
				$iddir,$idcp,$calle,$nume,$numi,$col,$ref);
            
          	$idCon = $m->obtenerIdContacto();

            $idDir = $m->incrementoDir();
    
            $comboEstados = $m->obtenerEstado();    
       
		
            
            require __DIR__ . '/templates/clientes/nuevoCo.php';   
        
        }

    	//---------Función para el formulario de nuevo_cliente
    	public function agregarCl()
    	{
			
    	$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
		//combo_Bancos
		$CargaCombo2 = $m->obtieneBanco();			
		$obtenerDatos2 = $CargaCombo2;
		//combo_tipoCuenta
		$CargaCombo3 = $m->obtieneTipoC();			
		$obtenerDatos3 = $CargaCombo3;
		//combo categoria
		$CargaCombo7 = $m->obtenerCategoria();			
		$obtenerDatos7 = $CargaCombo7;
            
        $comboEstados = $m->obtenerEstado();    
	    $idFisc=$m->incrementodFiscal();
        /*Direccion Fiscal*/
        $idDir2 = $m->incrementoDir() +1;
            
			$Clientes = array(
				'idDir' => $m->incrementoDir(),
				//datosF
				'idDatF' => $m->incrementodFiscal(),
				//datos_cliente
				'idCli' => $m->incrementoCli(),
				//datos_bancarios
				'idDatBank' => $m->incrementoDB(),
				//detKANclientes
				'idDetBank' => $m->iddet_bank(),
			);
						
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
				if($m->addCliente($_POST['idCliente'],$_POST['idDatF'],$_POST['idDir'],$_POST['idDatBank'],$_POST['id_tipo_cuenta'],$_POST['idDetBank'])){
							header('Location: index.php?url=listaCliente');
				} else {
						$Clientes = array(
					
						//Datos_fiscales
						'idDatF' => $_POST['idDatF'],
						//Datos_cliente
						'idCli' => $_POST['idCliente'],
						//id_direccion
						'idDir' => $_POST['idDir'],
						//id_bbancaria
						'idDatBank' => $_POST['idDatBank'],
						//comboTipocuenta
						'id_tipo_cuenta' => $_POST['id_tipo_cuenta'],
						//id para la tabla de det_bank_cli
						'idDetBank' => $_POST['idDetBank'],



					);
					$Clientes['mensaje'] = 'Error al registrar clientes. Revise el formulario';
				}
			}
			require __DIR__ . '/templates/clientes/nuevoCl.php';
    	}
	/*********************************************************************************/
	//muestra la paginacion del contacto para clientes
	public function paginacion_contacto()
		{
    	$idcli=$_REQUEST['idcli'];
        
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

	    $ContactosNo=$m->obtieneContactoNoCliente($idcli);
	    $Contactos=$m->obtieneContactoCliente($idcli);

				
			require __DIR__ . '/templates/clientes/paginador_contacto.php';
		}
        
        
        
      //-------Eliminar un Contacto de un Cliente
      public function remcontactocli()
		{
            
            $idCon=$_REQUEST['id_contacto'];
            $idCli=$_REQUEST['id_cliente'];
           
		$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
		/*Quitar contacto a cliente*/
		$Cremover=$m->remcontactocli($idCon,$idCli);     	
				
			 
		 /*Obtener tabla de Contactos*/           
		$ContactosNo=$m->obtieneContactoNoCliente($idCli);
		/*Obtener tabla de contactos Asignados al Cliente*/
		$Contactos=$m->obtieneContactoCliente($idCli);
        
			require __DIR__ . '/templates/clientes/addContacto.php';
		}

		//Agregar un Contacto a un Cliente
        public function addcontactocli()
		{
            
            $idCon=$_REQUEST['id_contacto'];
            $idCli=$_REQUEST['id_cliente'];
           
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);

		/*Agregar contacto a cliente*/
	    $Cagregar=$m->addcontactocli($idCon,$idCli);
	            
	     /*Obtener tabla de Contactos*/           
	    $ContactosNo=$m->obtieneContactoNoCliente($idCli);
	    
	    /*Obtener tabla de contactos Asignados al Cliente*/
	    $Contactos=$m->obtieneContactoCliente($idCli);
	    
	       require __DIR__ . '/templates/clientes/addContacto.php';
		}

	//-------Función para el formulario de editar_cliente
    public function modCl()
    	{	
		
		if(!isset($_GET['id_cli'])){
    		throw new Exception("Página no encontrada", 1);    			
    		}
    		$idCli=$_GET['id_cli'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisCliente = $m->obtieneVcliente($idCli);
			$obtenerCliente=$lisCliente;		
						
			$obtenerDatosCatego= array(
				'categoria' => $m -> comboCategoCliente($idCli),
			);

			$obtenerEstadosUpdate= array(
				'estados' => $m -> obtenerEstadoUpdate($idCli),
			);

		
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
								
				if($m->UpdateCliente($_POST['id_cli'],$_POST['nomb']/*,$_POST['f_alta']*/,$_POST['telMovil'],$_POST['telOficina'],
					$_POST['telEmergencia'],$_POST['extension'],$_POST['dirWeb'],$_POST['categoria'],$_POST['activo'],
					$_POST['id_datFiscal'],$_POST['razon_social'],$_POST['rfc'])){
					header('Location: index.php?url=listaCliente');
				} else {

					$ObtenerDatosCliente = array(
					
						// Cliente
						'idCli' => $_POST['id_cli'],
						'nombre' => $_POST['nomb'],
						//'falta' => $_POST['f_alta'],
						'movil' => $_POST['telMovil'],
						'oficina' => $_POST['telOficina'],
						'emergencia' => $_POST['telEmergencia'],
						'ext' => $_POST['extension'],
						'dweb' => $_POST['dirWeb'],
						'activo' => $_POST['activo'],
						
						'cv_DF' => $_POST['id_datFiscal'],
						'razonS' => $_POST['razon_social'],
						'rfc' => $_POST['rfc'],

						
					);

					$obtenerDatosCatego = array(
						'categoria' => $_POST['categoria'],
					);
				}
			}				 




			require __DIR__ . '/templates/clientes/modificar_cl.php';
    	}
		
		
		
				




		
		
	//------------------------------------------------------------------------------------------------
 	//---------------------------------------------FAMILIAS-------------------------------------------

		public function listaFam()
		{
			/*variable de conexion*/	
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerFamilias = array(
				'familia' => $m->obtieneFamilias(),
			);
			require __DIR__ . '/templates/familia/mostrarFamilia.php';
    	}
    	
    	public function verFam()
    	{
    		if(!isset($_GET['id_fam'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$cv_fam=$_GET['id_fam'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisFam=$m->obtieneVFamilia($cv_fam);		
			$obtenerFamilia=$lisFam;					
			require __DIR__ . '/templates/familia/verFamilia.php';
    	}

    	public function eliFam()
    	{
    		if(!isset($_GET['id_fam'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$del_fam=$_GET['id_fam'];
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisFam=$m->elimFamilia($del_fam);		
			$obtenerFamilia=$lisFam;				
		//	require __DIR__ . '/templates/familia/elimFam.php';
    	}
			
    	public function buscarFam()
    	{
    	$crit = array(
			'busqueda' => '',
			'resultado' => array(),
			);
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $crit['busqueda'] = $_POST['busqueda'];
             $crit['resultado'] = $m->busquedaF($_POST['busqueda']);
         }
		 
			require __DIR__ . '/templates/familia/buscador.php';
    	}
    	


		//función para el formulario de nuevo_cliente
    	public function agregarFam()
    	{
			
			
    	$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
										
			$familia = array(
				'idFam' => $m->incrementoFam(),
				'nombre_fam' => '',
				/*'activo' => '',*/
				
				
			);
			
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
				if($m->addFamilia($_POST['idFam'],$_POST['nombre_fam']/*,$_POST['activo']*/)){
						header('Location: index.php?url=listaFam');
				} else {
						$familia = array(
						'idFam' => $_POST['idFam'],
						'nombre_fam' => $_POST['nombre_fam'],
						/*'activo' => $_POST['activo'],*/
						
					);
					$familia['mensaje'] = 'Error al registrar familia. Revise el formulario';
				}
			}
			require __DIR__ . '/templates/familia/newFamilia.php';
    	}
		
		
		public function verFamMod()
    	{
    		if(!isset($_GET['id_fam'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$cv_fam=$_GET['id_fam'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisFam=$m->obtieneVFamilia($cv_fam);		
			$obtenerFamilia=$lisFam;					
		
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($_POST['nombre_fam'] != "" && $_POST['nombre_fam'] != " " && $_POST['nombre_fam'] != "  " && $_POST['nombre_fam'] != "   "){
				
					if($m->modiFam($_POST['id_fam'],$_POST['nombre_fam'],$_POST['activo'])){
							header('Location: index.php?url=listaFam');
					} else {

						$Familia = array(
					'nombre_fam' => '',
					'activo' => '',				
					);

					}
				}else{
				$Familia['mensaje'] = 'La familia ingresada es invalida, verificar formulario';
				}
			}
			require __DIR__ . '/templates/familia/modFam.php';
    	}


		

    	//------------------------------------------------------------------------------------------------
    	//---------------------------------------------MARCAS---------------------------------------------


    	public function listaMarca()
		{
			/*variable de conexion*/	
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerMarcas	= array(
				'marca' => $m->obtieneMarcas(),
			);
			require __DIR__ . '/templates/marca/mostrarMarcas.php';
    	}
    	
    	public function verMarca()
    	{
    		if(!isset($_GET['id_marca'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$cv_marca=$_GET['id_marca'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisM=$m->obtieneVmarca($cv_marca);		
			$obtenerMarca=$lisM;					
			require __DIR__ . '/templates/marca/verMarca.php';
    	}

    		public function elimMarca()
    	{
    		if(!isset($_GET['id_marca'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$del_mar=$_GET['id_marca'];
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisM=$m->elimMarca($del_mar);		
			$obtenerMarca=$lisM;				
			//require __DIR__ . '/templates/marca/elimMarca.php';
    	}
    	
    	public function buscarMarca()
    	{
    	$crit = array(
			'busqueda' => '',
			'resultado' => array(),
			);
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $crit['busqueda'] = $_POST['busqueda'];
             $crit['resultado'] = $m->busquedaM($_POST['busqueda']);
         }
		 
			require __DIR__ . '/templates/marca/buscador.php';
    	}

		public function verMarMod()
    	{
    		if(!isset($_GET['id_marca'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$cv_marca=$_GET['id_marca'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisM=$m->obtieneVmarca($cv_marca);		
			$obtenerMarca=$lisM;	

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($_POST['nombre_marca'] != "" && $_POST['nombre_marca'] != " " && $_POST['nombre_marca'] != "  " && $_POST['nombre_marca'] != "   "){
				
				if($m->modiMarca($_POST['id_marca'],$_POST['nombre_marca'],$_POST['activo'])){
						header('Location: index.php?url=listaMarca');
				} else {
						$Marca = array(
						'nombre_marca' => $_POST['nombre_marca'],
						'activo' => $_POST['activo'],
						
					);
					}
				}
				else{
				$Marca['mensaje'] = 'La marca ingresada es invalida, verificar formulario';
				}
			}
			
			require __DIR__ . '/templates/marca/modMarca.php';
    	}

		
//------------------------------------------------------------------------------------------------
//---------------------------------------------LINEA---------------------------------------------


    	public function listaLinea()
		{
			/*variable de conexion*/	
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerLineas	= array(
				'linea' => $m->obtieneLineas(),
			);
			require __DIR__ . '/templates/linea/mostrarLineas.php';
    	}
    	
    	public function verLinea()
    	{
    		if(!isset($_GET['id_linea'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$cv_linea=$_GET['id_linea'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisL=$m->obtieneVLinea($cv_linea);		
			$obtenerLinea=$lisL;					
			require __DIR__ . '/templates/linea/verLinea.php';
    	}

		
		public function verLineaMod()
    	{
    		if(!isset($_GET['id_linea'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$cv_linea=$_GET['id_linea'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisL=$m->obtieneVLinea($cv_linea);		
			$obtenerLinea=$lisL;		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($_POST['nombre_linea'] != "" && $_POST['nombre_linea'] != " " && $_POST['nombre_linea'] != "  " && $_POST['nombre_linea'] != "   "){
					
					if($m->modiLinea($_POST['id_linea'],$_POST['nombre_linea'],$_POST['activo'])){
						header('Location: index.php?url=listaLinea');
				} else {

						$Linea = array(
				'nombre_linea' => '',
				'activo' => '',
								
				);
					}
				}else{
					$Linea['mensaje'] = 'La linea ingresada es invalida, verificar formulario';
				}
			}
			
		require __DIR__ . '/templates/linea/modLinea.php';
		}


					
		
		public function elimLinea()
    	{
    		if(!isset($_GET['id_linea'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$del_linea=$_GET['id_linea'];
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisL=$m->eliminaLinea($del_linea);		
			$obtenerLinea=$lisL;				
			//require __DIR__ . '/templates/marca/elimLinea.php';
    	}
    	


/*-------------------------------------PRODUCTOS---------------------------------------------*/
		/*-------------------------------------PRODUCTOS---------------------------------------------*/
		public function agregarProd()
    	{	
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    		//combo_Marcas
		$CargaCombo8 = $m->obtieneMarcasCombo();			
		$obtenerDatos8 = $CargaCombo8;
			
    		//combo_familias
		$CargaCombo9 = $m->obtieneFamiliasCombo();			
		$obtenerDatos9 = $CargaCombo9;
		
		//combo_familias
		$CargaCombo10 = $m->obtieneLineasCombo();			
		$obtenerDatos10 = $CargaCombo10;    	
    	
		 //combo_Unidad
		$CargaCombo12 = $m->obtieneUnidad();			
		$obtenerDatos12 = $CargaCombo12;
		
		//comboTipoProducto
		$CargaCombo14 = $m->obtieneTProd();			
		$obtenerDatos14 = $CargaCombo14;
		
		//comboSubCateogria
		$CargaCombo15 = $m->obtieneSubcatego();			
		$obtenerDatos15 = $CargaCombo15;

		//comoProveedores
		$CargaCombo16 = $m->obtieneProvCombo();			
		$obtenerDatos16 = $CargaCombo16;

		
		
		$Producto = array(
				//datos_producto
				'idProd' => $m->incrementoProd(),	
			
			);				


		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//				print_r($_POST);
				$band = 0;
				
				if ($_POST['marca'] == 0 & $_POST['familia'] == 0 & $_POST['linea'] == 0 & $_POST['subcatego'] == 0 & $_POST['tipoProd'] == 0 & $_POST['unidad'] == 0 & $_POST['proveedor'] == 0){
					$band = 1;
					
					$Producto = array(
						'id_producto' => $_POST['idProd'],
						'nombreP' => $_POST['nomP'],
						'model' => $_POST['modelo'],
						'marca' => $_POST['marca'],
						'familia' => $_POST['familia'],
						'linea' => $_POST['linea'],
						'subC' => $_POST['subcatego'],
						'tipo' => $_POST['tipoProd'],
						'unidad' => $_POST['unidad'],
						'idProv' => $_POST['proveedor'],
						'existencia' => $_POST['exis'],
						'descrip' => $_POST['desc'],
						'p_unitario' => $_POST['precioU'],

					);
					$Producto['mensaje'] = 'Complete toda la información requerida antes de continuar,verificar formulario';
				}


				if($band == 0){
					if($m->addProd($_POST['idProd'],$_POST['nomP'],$_POST['modelo'],$_POST['marca'],$_POST['familia'],$_POST['linea'],$_POST['subcatego'],
					$_POST['tipoProd'],$_POST['unidad'],$_POST['proveedor'],$_POST['exis'],$_POST['desc'],$_POST['precioU'])){
						header('Location: index.php?url=listaProducto');
						}

				}

			}

			require __DIR__ . '/templates/producto/crear_producto.php';
	
		}
		

	public function listaProducto()
		{
			/*variable de conexion*/	
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$obtenerProductos = array(
				'productos' => $m->obtieneProductos(),
			);
		
			require __DIR__ . '/templates/producto/mostrarProductos.php';
    	}
			
		public function verProducto()
    	{
    		if(!isset($_GET['id_producto'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$cv_producto=$_GET['id_producto'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisPro=$m->obtieneVProducto($cv_producto);		
			$obtenerProducto=$lisPro;					
			require __DIR__ . '/templates/producto/verProducto.php';
    	}
	
    	public function verProdMod()
    	{
    		if(!isset($_GET['id_producto'])){
    			throw new Exception("Página no encontrada", 1);    			
    		}
    		$cv_producto=$_GET['id_producto'];

			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
    	
			$lisPro=$m->obtieneVProducto($cv_producto);		
			
			$ObtenerDatosProducto = $lisPro;

			$obtenerDatosMarca = array(
				'marcas' => $m->comboMUpdate($cv_producto),
			);
		
			$obtenerDatosFam = array(
				'familias' => $m->comboCatUpdate($cv_producto),
			);
		
			$obtenerDatosLinea = array(
				'lineas' => $m->comboLinUpdate($cv_producto),
			);
		
			$obtenerDatosSubC = array(
				'subcatego' => $m->comboSubCUpdate($cv_producto),
			);
		
			$obtenerDatosTP = array(
				'tipoProd' => $m->comboTipoProd($cv_producto),
			);
		
		
			$obtenerDatosUn = array(
				'unidades' => $m->comboUnidadUp($cv_producto),
			);

			$obtenerDatosProv = array(
				'proveedores' => $m->comboProvUpdate($cv_producto),
			);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
								
				if($m->UpdateProducto($_POST['id_producto'],$_POST['nomP'],$_POST['modelo'],$_POST['marca'],$_POST['familia'],
					$_POST['linea'],$_POST['subcatego'],$_POST['tipoProd'],$_POST['unidad'],$_POST['proveedores'],
					$_POST['exis'],$_POST['desc'],$_POST['precioU'])){
					header('Location: index.php?url=listaProducto');
				} else {

					$ObtenerDatosProducto = array(
					
						// Producto
						'idProd' => $_POST['id_producto'],
						'producto' => $_POST['nomP'],
						'model' => $_POST['modelo'],
						'existencia' => $_POST['exis'],
						'descrip' => $_POST['desc'],
						'pUnitario' => $_POST['precioU'],
						
					);
						
					$obtenerDatosMarca = array(
						'marcas' => $_POST['marca'],
					);
					
					$obtenerDatosFam = array(
						'familias' => $_POST['familia'],
					);

					$obtenerDatosLinea = array(
						'lineas' => $_POST['linea'],
					);

					$obtenerDatosSubC = array(
						'subcatego' => $_POST['subcatego'],
					);

					$obtenerDatosTP = array(
						'tipoProd' => $_POST['tipoProd'],
					);

					$obtenerDatosUn = array(
						'unidades' => $_POST['unidad'],
					);

					$obtenerDatosProv = array(
						'proveedores' => $_POST['proveedores'],
					);

				}
			}				 
		  require __DIR__ . '/templates/producto/modProd.php';
    	}

	
		public function  validaformTwo($idcli)
		{
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			$validar=$m->validaformTwo($idcli);	
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
				'idDatFis' => $model->incrementodFiscal(),	
				'razon_s' => '',
				'rfc' => '',

				// datos direccion fisica
				'cp' => '',
				'idDire' => $model->incrementoDir(),
				'street' => '',
				'n_ext' => '',
				'n_int' => '',
				'colo' => '',
				'ref' => '',
				
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
				// print_r($_POST);

				if($_POST['txt_noint'] == ""){
					$_POST['txt_noint'] = "s/n";
				}
				
				if($model->registrarProveedores($_POST['txt_iddf'],
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

						// datos direccion fisica
						'cp' => $_POST['postcode'],
						'idDire' => $_POST['txt_iddir'],
						'street' => $_POST['txt_calle'],
						'n_ext' => $_POST['txt_noext'],
						'n_int' => $_POST['txt_noint'],
						'colo' => $_POST['txt_col'],
						'ref' => $_POST['txt_ref'],

						// datos bancarios
						'idBank' => $_POST['txt_iddb'],
						'banco' => $_POST['slt_banco'],
						'sucursal' => $_POST['txt_suc'],
						'titular' => $_POST['txt_titul'],
						'num_cuenta' => $_POST['txt_cuenta'],
						'clabe' => $_POST['txt_clabe'],
						'tipo_cta' => $_POST['slt_tipo_c'],
					);
					
					$obtenerDatosDir = array(
						'codigoP' => $model -> obtenerDatosDireccionInsert($_POST['postcode'],$_POST['idcp-locality']),
						'idCP' => $_POST['idcp-locality'], 
						'localidadC' => $model -> obtieneNombreLocalidad($_POST['idcp-locality']), 
						'municipio' => $_POST['state'],
						'estado' => $_POST['municipality'], 
					);

					$parametrosProveedores['mensaje'] = 'Error al registrar Proveedores . Revise el formulario';
				}

			}

			require '/templates/proveedor/nuevoPro.php';
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

			require __DIR__ . '/templates/proveedor/verProveedor.php';
		}
		
		//-------------------------TRANSACCIONES-------------------------------------------
		public function verMenuTransacciones()
		{
			require __DIR__ . '/templates/transacciones/menuTransacciones.php';
		}
		
		public function nuevaTransaccion()
		{
			require __DIR__ . '/templates/transacciones/elegirTransaccion.php';
		}
		
		public function cargarFormTransaccion(){
				
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			if($_REQUEST['sltTrans'] != ""){
				// 1 = Compra
				if($_REQUEST['sltTrans'] == 1){
					
					$parametrosCompra = array(
						'noComprovanteC' => $m -> obtenerNoComprobanteCompr(),
						'proveedores' => $m -> obtieneProveedorProd(),
					);
					
					require __DIR__ . '/templates/transacciones/transaccionCompra.php';
				}
				// 2 = Venta
				elseif($_REQUEST['sltTrans'] == 2){
					
					$parametrosVenta = array(
						'noComprovanteV' => $m -> obtenerNoComprobanteVenta(),
						'clientes' => $m -> obtenerClientesVent(),
					);
					
					require __DIR__ . '/templates/transacciones/transaccionVenta.php';
				}
			}
		}
		
		public function insertarTransaccion()
		{
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
				
			if(isset($_POST['sltTrans'])){
				if($_POST['sltTrans'] == 1){
						
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						
						if($m -> registrarTransCompra($_POST['numCompra'],$_POST['idProveedor'])){
							$parametrosCompra2 = array(
								'noComprovanteC' => $_POST['numCompra'],
								'datosCompra' => $m -> obtenerDatosCompra($_POST['numCompra']),
								'productos' => $m -> obtieneProductosProveedores($_POST['idProveedor']),
							);
						}else{
							$parametrosCompra2 = array(
								'noComprovanteC' => $_POST['numCompra'],
								'datosCompra' => $m -> obtenerDatosCompra($_POST['numCompra']),
								'productos' => $m -> obtieneProductosProveedores($_POST['idProveedor']),
							);
							
							$datosProdAddCompr = $m -> obtenerProductosAgregadosCompra($_REQUEST['numCompra']);
							$obtenerDatosProdAddCompr= $datosProdAddCompr;
						}	
					}
					
					require __DIR__ . '/templates/transacciones/insertarTransCompra.php';					
				}
				// 2 = Venta
				elseif($_POST['sltTrans'] == 2){
					
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						if ($m -> registrarTransVenta($_POST['numVenta'],$_POST['idCliente'])) {
							$parametrosVenta2 = array(
								'noComprovanteV' => $_POST['numVenta'],
								'datosVenta' => $m -> obtenerDatosVenta($_POST['numVenta']),
								'proveedores' => $m -> obtieneProvCombo(),
							);
						}else {
							$parametrosVenta2 = array(
								'noComprovanteV' => $_POST['numVenta'],
								'datosVenta' => $m -> obtenerDatosVenta($_POST['numVenta']),
								'proveedores' => $m -> obtieneProvCombo(),
							);
							
							$datosProdAddVent = $m -> obtenerProductosAgregadosVenta($_REQUEST['numVenta']);
							$obtenerDatosProdAddVent = $datosProdAddVent;
						}
					}
					
					require __DIR__ . '/templates/transacciones/insertarTransVenta.php';
				}
			}else {
				// redireccionar
				header("Location: index.php?url=transacciones");
				exit;
			}
		}
		
		public function verInformacionProducto(){
			if(!isset($_GET['IDproducto'])){
				throw new Exception("Página no encontrada", 1);
			}
			
			$claveProducto = $_GET['IDproducto'];
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			
			$datosProducto = $m -> obtenerInformacionProducto($claveProducto);
			$mandarDatosProducto = $datosProducto;
			
			require __DIR__ . '/templates/transacciones/verDatosProducto.php';
		}
		
		//COMPRAS
		public function agregarProdCompra(){
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			if ($_REQUEST != "") {
				if($m -> registrarDetalleTransCompra($_REQUEST['txtNumCompr'],$_REQUEST['idProducto'],$_REQUEST['txtCantProd'])){
					$datosProdAddCompr = $m -> obtenerProductosAgregadosCompra($_REQUEST['txtNumCompr']);
					$obtenerDatosProdAddCompr= $datosProdAddCompr;
				}else{
					$datosProdAddCompr = $m -> obtenerProductosAgregadosCompra($_REQUEST['txtNumCompr']);
					$obtenerDatosProdAddCompr= $datosProdAddCompr;
				}
			}
			
			require __DIR__ . '/templates/transacciones/agregarProductoCompra.php';
		}
		
		public function eliminarProdCompra(){
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			if ($_REQUEST != "") {
				if($m -> borrarProductosAgregadosCompra($_REQUEST['idDetTransCompr'],$_REQUEST['idProductoC'],$_REQUEST['cantProdC'])){
					$datosProdAddCompr = $m -> obtenerProductosAgregadosCompra($_REQUEST['folioCompra']);
					$obtenerDatosProdAddCompr= $datosProdAddCompr;
				}else{
					$datosProdAddCompr = $m -> obtenerProductosAgregadosCompra($_REQUEST['folioCompra']);
					$obtenerDatosProdAddCompr= $datosProdAddCompr;
				}
			}
			
			require __DIR__ . '/templates/transacciones/borrarProductoCompra.php';
		}
		
		public function listarComprasTrans(){
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			$obtenerDatosListCompras = array(
				'compras' => $m -> listarCompras(),
			);
			
			require __DIR__ . '/templates/transacciones/mostrarCompras.php';
		}
		
		public function detalleCompraTrans(){
			if(!isset($_GET['numCompr'])){
				throw new Exception("Página no encontrada", 1);
			}
			
			if(!isset($_GET['idPro'])){
				throw new Exception("Página no encontrada", 1);
			}
			
			$folioCompra = $_GET['numCompr'];
			$IDproveedor = $_GET['idPro'];
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			$datosProdAddCompr = $m -> obtenerProductosAgregadosCompra($folioCompra);
			
			$obtenerDatosProdAddCompr= $datosProdAddCompr;
			
			$informacionCompra = array(
				'noComprovanteC' => $folioCompra,
				'datosCompra' => $m -> obtenerDatosCompra($folioCompra),
				'productos' => $m -> obtieneProductosProveedores($IDproveedor),
			);
			
			require __DIR__ . '/templates/transacciones/verCompra.php';
		}
		
		// VENTAS
		function obtenerProductosProvee()
		{
			if ($_REQUEST['prove']!="") {
				
				$nameProveedor= $_REQUEST['prove'];
				
				$m = new model(config::$mvc_db_name, config::$mvc_db_user,
							config::$mvc_db_pass, config::$mvc_db_hostname);
							
				$productos = $m->obtieneProductosProveedores($nameProveedor);			
				$obtenerDatosProductos = $productos;
			}
			require __DIR__ . '/templates/transacciones/verProductosProveedor.php';
		}
		
		public function agregarProdVenta(){
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			if ($_REQUEST != "") {
				if($m -> registrarDetalleTransVenta($_REQUEST['txtNumVenta'],$_REQUEST['idProducto'],$_REQUEST['txtCantProd'])){
					$datosProdAddVent = $m -> obtenerProductosAgregadosVenta($_REQUEST['txtNumVenta']);
					$obtenerDatosProdAddVent = $datosProdAddVent;
				}else{
					$datosProdAddVent = $m -> obtenerProductosAgregadosVenta($_REQUEST['txtNumVenta']);
					$obtenerDatosProdAddVent = $datosProdAddVent;
				}
			}
			
			require __DIR__ . '/templates/transacciones/agregarProductoVenta.php';
		}
		
		public function eliminarProdVenta(){
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
						
			if ($_REQUEST != "") {
				if($m -> borrarProductosAgregadosVenta($_REQUEST['idDetTransVent'],$_REQUEST['idProductoV'],$_REQUEST['cantProdV'])){
					$datosProdAddVent = $m -> obtenerProductosAgregadosVenta($_REQUEST['folioVenta']);
					$obtenerDatosProdAddVent = $datosProdAddVent;
				}else{
					$datosProdAddVent = $m -> obtenerProductosAgregadosVenta($_REQUEST['folioVenta']);
					$obtenerDatosProdAddVent = $datosProdAddVent;
				}
			}
			
			require __DIR__ . '/templates/transacciones/borrarProductoVenta.php';
		}
		
		public function listarVentasTrans(){
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			$obtenerDatosListVentas = array(
				'ventas' => $m -> listarVentas(),
			);
			
			require __DIR__ . '/templates/transacciones/mostrarVentas.php';
		}
		
		public function detalleVentaTrans(){
			if(!isset($_GET['numVent'])){
				throw new Exception("Página no encontrada", 1);
			}
			
			$folioVenta = $_GET['numVent'];
			
			$m = new model(config::$mvc_db_name, config::$mvc_db_user,
						config::$mvc_db_pass, config::$mvc_db_hostname);
			
			$datosProdAddVent = $m -> obtenerProductosAgregadosVenta($folioVenta);
			
			$obtenerDatosProdAddVent= $datosProdAddVent;
			
			$informacionVenta = array(
				'noComprovanteV' => $folioVenta,
				'datosVenta' => $m -> obtenerDatosVenta($folioVenta),
				'proveedores' => $m -> obtieneProvCombo(),
			);
			
			require __DIR__ . '/templates/transacciones/verVenta.php';
		}

    }
?>