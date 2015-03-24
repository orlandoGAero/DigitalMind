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
						'codigoP' => $m -> obtenerDatosDireccionInsert($_POST['postcode'],$_POST['idcp-locality']),
						'idCP' => $_POST['idcp-locality'], 
						'localidadC' => $m -> obtieneNombreLocalidad($_POST['idcp-locality']), 
						'municipio' => $_POST['state'],
						'estado' => $_POST['municipality'], 
					);
					
					$parametrosContactos['mensaje'] = 'Error al registrar contacto. Revise el formulario';
				}
			}
			
			require __DIR__.'/templates/contactos/insertarContacto.php';
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
				'codigoP' => $m -> obtenerDatosDireccionUpdate($IdContacto),
			);
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				//print_r($_POST);
				
				if($_POST['numInt'] == ""){
					$_POST['numInt'] = 0;
				}

				if($m->actualizarContacto($_POST['idAddress'],$_POST['idcp-locality'],$_POST['street'],$_POST['numExt'],$_POST['numInt'],$_POST['colonia'],$_POST['reference'],
					$_POST['idContact'],$_POST['nameContact'],$_POST['ApPContact'],$_POST['ApMContact'],$_POST['nameArea'],$_POST['telMovil'],$_POST['telOficina'],
					$_POST['telEmergencia'],$_POST['emailPersonal'],$_POST['emailInstitucional'],$_POST['redSocialF'],$_POST['redSocialT'],$_POST['redSocialS'],
					$_POST['webPage'],$_POST['activoC'])){
						header('Location: index.php?url=listContact');
				}else{
					$obtenerDatosContacto = array(
						'id_contacto' => $_POST['idContact'],
						'nombreCon' => $_POST['nameContact'],
						'ap_paterno' => $_POST['ApPContact'],
						'ap_materno' => $_POST['ApMContact'],
						'nombre_area' => $_POST['nameArea'],
						'movil' => $_POST['telMovil'],
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
						'codigoP' => $_POST['postcode'],
						'calle' => $_POST['street'],
						'num_ext' => $_POST['numExt'],
						'num_int' => $_POST['numInt'],
						'colonia' => $_POST['colonia'],
						'referencia' => $_POST['reference'],
						'id_cp' => $_POST['idcp-locality'], 
						'localidad' =>$m -> obtieneNombreLocalidad($_POST['idcp-locality']),
						'municipio' => $_POST['state'],
						'estado' => $_POST['municipality'], 
					);
					
					$obtenerDatosDir = array(
						'codigoP' => $m -> obtenerDatosDireccionInsert($_POST['postcode'],$_POST['idcp-locality']),
						'id_cp' => $_POST['idcp-locality'], 
						'localidad' => $m -> obtieneNombreLocalidad($_POST['idcp-locality']), 
					);
					
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
//------------------------------------------------------------------------------------------------------
	
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
		

		
		
    }
?>
