<?php
    /**
     * Modelo
     */
    class model {
        protected $conexion;
        
        public function __construct($dbname,$dbuser,$dbpass,$dbhost) {
            $mvc_db_conexion = mysql_connect($dbhost, $dbuser, $dbpass);
			
			if (!$mvc_db_conexion) {
				die('Error al realizar la conexión con la base de datos: ' . mysql_error());
			}
			mysql_select_db($dbname, $mvc_db_conexion);
			
			mysql_set_charset('utf8');
			
			$this->conexion = $mvc_db_conexion;
        }
		
		public function bd_conexion()
		{
			
		}
		
		//obtiene id direccion para insercion
		public function incrementoDir()
		{			
			$sql="SELECT id_direccion FROM direcciones ORDER BY id_direccion DESC LIMIT 1";
			$consulta=mysql_query($sql)or die ("Error de Consulta-Increment-Dir");
			$filas=mysql_num_rows($consulta);
			
			if($filas==0){
				$cv_dir = 1;
			}else	{
				$cv_dir = mysql_result($consulta,0,'id_direccion');
				$cv_dir = ($cv_dir + 1);
			}
			return $cv_dir;
		}
		
		public function obtieneEstado()
    	{
    		$consulta = "SELECT estado FROM codigos_postales GROUP BY estado";
			$ejecutar = mysql_query($consulta)or die ("Error de Consulta obtener estado".mysql_error());
	
			$estado= array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$estado[] = $rows;
			}
			
			return $estado;
		}
		
		//CONTACTOS
		public function obtenerContactos(){
			$consulta = "SELECT id_contacto,nombreCon,ap_paterno,ap_materno,nombre_area,movil,tel_oficina,correo_instu FROM contacto ORDER BY nombreCon;";
			$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
			
			$Contactos = array();
			while($rows = mysql_fetch_assoc($ejecutar)){
				$Contactos[] = $rows;
			}
			
			/*$TableContactos = array(
		         'sEcho' => $_POST['sEcho'],
		         //'iTotalRecords' => $nTotal,
		         //'iTotalDisplayRecords' => $nTotal,
		         'aaData' => $Contactos);
		 
		    print_r(json_encode($TableContactos));*/
			
			return $Contactos;
		}
		
		public function obtenerContacto($idCon)
		{
			$idCon = htmlspecialchars($idCon);
			
			$consulta = "SELECT c.id_contacto,c.nombreCon,c.ap_paterno,c.ap_materno,c.nombre_area,c.movil,c.tel_oficina,c.tel_emergencia,c.correo_p,c.correo_instu,
												c.facebook,c.twitter,c.skype,c.direccion_web,d.calle,d.num_ext,d.num_int,d.colonia,d.referencia
								FROM contacto c, direcciones d
								WHERE d.id_direccion=c.id_direccion
									AND c.id_contacto = ".$idCon;
			$ejecutar = mysql_query($consulta, $this->conexion);
			
			$contactl= array();
			$rows = mysql_fetch_assoc($ejecutar);
			
			return $rows;
		}
		
		public function obtenerIdContacto(){
			$consulta = "SELECT id_contacto FROM contacto ORDER BY id_contacto DESC LIMIT 1;";
			$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			
			if($filas==0){
				$idCo = 1;
			}else	{
				$idCo = mysql_result($ejecutar,0,'id_contacto');
				$idCo = ($idCo + 1);
			}
			
			return $idCo;
		}
		
		public function registrarContacto($idDireccion,$calleCont,$numExtCont,$numIntCont,$coloniaCont,$referenciaCont,
		$idCont,$nomCont,$apCont,$amCont,$areaCont,$telMovilCont,$telOficinaCont,$telEmergenciaCont,$correoPersonalCont,
		$correoInstituCont,$facebookCont,$twitterCont,$skypeCont,$dirWebCont)
		{
				
			
			//Convertir a mayúsculas
			$nomCont = mb_strtoupper($nomCont);
			$apCont = mb_strtoupper($apCont);
			$amCont = mb_strtoupper($amCont);
			$areaCont = mb_strtoupper($areaCont);
			
			$calleCont = mb_strtoupper($calleCont);
			$coloniaCont = mb_strtoupper($coloniaCont);
			$referenciaCont = mb_strtoupper($referenciaCont);
			//Convertir a minúsculas
			$correoPersonalCont = mb_strtolower($correoPersonalCont);
			$correoInstituCont = mb_strtolower($correoInstituCont);
			$facebookCont = mb_strtolower($facebookCont);
			$twitterCont = mb_strtolower($twitterCont);
			$skypeCont = mb_strtolower($skypeCont);
			$dirWebCont = mb_strtolower($dirWebCont);
			
			$consulta1 = "INSERT INTO direcciones (id_direccion,calle,num_ext,num_int,colonia,referencia) 
								VALUES(".$idDireccion.",'".$calleCont."',".$numExtCont.",".$numIntCont.",'".$coloniaCont."','".$referenciaCont."');";
			$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en insertar dirección ".mysql_error());
			
			echo $consulta2 = "INSERT INTO contacto (id_contacto,nombreCon,ap_paterno,ap_materno,nombre_area,movil,tel_oficina,tel_emergencia,
									correo_p,correo_instu,facebook,twitter,skype,direccion_web,id_direccion,fecha_alta)
									VALUES (".$idCont.",'".$nomCont."','".$apCont."','".$amCont."','".$areaCont."',".$telMovilCont.",".$telOficinaCont.",".$telEmergenciaCont.",'".$correoPersonalCont."',
									'".$correoInstituCont."','".$facebookCont."','".$twitterCont."','".$skypeCont."','".$dirWebCont."',".$idDireccion.",NOW());";
				$ejecutar2 = mysql_query($consulta2,$this->conexion) or die ("Error en insertar contacto ".mysql_error());	
			
			return $ejecutar1 & $ejecutar2;
		}

		public function validarDuplicidadContactos($nomCont,$apCont,$amCont,$idCont){
			$consulta = "SELECT id_contacto,nombreCon,ap_paterno,ap_materno 
								FROM contacto 
								WHERE nombreCon = '".$nomCont."' 
									AND ap_paterno = '".$apCont."' 
									AND ap_materno = '".$amCont."' 
									AND id_contacto != ".$idCont.";";
			$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
			
			$rows = mysql_num_rows($ejecutar);
			
			return $rows;
		}
		
		//CODIGOS POSTALES
		public function obtenerCodigosPostales()
		{
			$consulta = "SELECT * FROM codigos_postales WHERE ORDER BY id_cp LIMIT 100";
			$ejecutar = mysql_query($consulta, $this->conexion);
			
			$codigosPostales = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$codigosPostales[] = $rows;
			}
			
			return $codigosPostales;
		}
		
		public function obtenerCodigoPostal($idCp)
		{
			$idCp = htmlspecialchars($idCp);
			
			$consulta = "SELECT * FROM codigos_postales WHERE id_cp = ".$idCp;
			$ejecutar = mysql_query($consulta, $this->conexion);
			
			$codigoPostal= array();
			$rows = mysql_fetch_assoc($ejecutar);
			
			return $rows;
			
			
		}

		//---------------------------------------PROVEEDORES-----------------------------------------------------

		public function obtenerProveedores()
		{
			$sqlPro = " SELECT pro.id_prov, pro.proveedor, datf.razon_social, datf.rfc, cp.municipio, cp.estado
						FROM proveedores pro, datos_fiscales datf, codigos_postales cp, direcciones dir
						WHERE datf.id_datFiscal=pro.id_datFiscaL
						AND cp.id_cp=dir.id_cp
						AND dir.id_direccion=pro.id_direccion
						ORDER BY id_prov";
			$ejecutarPro = mysql_query($sqlPro, $this->conexion);
			$proveedores = array();
			while ($rows = mysql_fetch_assoc($ejecutarPro)){
				$proveedores[] = $rows;
			}
			return $proveedores;
		}

		public function obtenerDetalleProveedor($idProv)
		{
			$idProv = htmlspecialchars($idProv);

			$sqldetPro = "SELECT pro.id_prov, pro.proveedor, pro.tel, pro.dirweb, 
							       ctepro.categoria,
							       datf.razon_social, datf.rfc,
							       tdatfis.tipo,
							       cp.codigoP, cp.localidad, cp.municipio, cp.estado,
							       dir.calle,dir.num_ext,dir.num_int,dir.colonia,dir.referencia,
							       bank.nombre_banco,
							       datbank.sucursal,
							       datbank.titular,
							       datbank.no_cuenta,
							       datbank.no_cuenta_interbancario,
							       tcuenta.tipo_cuenta,
							       cont.nombreCon,
							       cont.ap_paterno,
							       cont.ap_materno,
							       cont.nombre_area,
							       cont.movil,
							       cont.tel_oficina,
							       cont.tel_emergencia,
							       cont.correo_p,
							       cont.correo_instu,
							       cont.facebook,
							       cont.twitter,
							       cont.skype,
							       cont.direccion_web
							FROM proveedores pro, 
							     categoria_prov ctepro,
							     datos_fiscales datf, 
							     tipos_razon_social tdatfis,
							     codigos_postales cp, 
							     direcciones dir,
							     bancos bank,
							     datos_bancarios datbank,
							     tipo_cuenta tcuenta,
							     det_bank_prov dtbapro,
							     contacto cont,
							     proveedores_contacto procont
							WHERE pro.id_prov = ".$idProv."
							AND ctepro.id_categoria=pro.id_categoria
							AND datf.id_datFiscal=pro.id_datFiscaL
							AND tdatfis.id_tipo_ra=datf.id_tipo_ra
							AND cp.id_cp=dir.id_cp
							AND dir.id_direccion=pro.id_direccion
							AND bank.id_banco=datbank.id_banco
							AND tcuenta.id_tipo_cuenta=datbank.id_tipo_cuenta
							AND pro.id_prov=dtbapro.id_prov
							AND datbank.id_datBank=dtbapro.id_datBank
							AND pro.id_prov=procont.id_prov
							AND cont.id_contacto=procont.id_contacto";
			$ejecutardetPro = mysql_query($sqldetPro, $this->conexion);

			$detallePro = array();
			$rowsPro = mysql_fetch_assoc($ejecutardetPro);
			
			return $rowsPro;
		}

		/*
		public function obtdatContactPro()
		{
			$idContPro = htmlspecialchars($idContPro);

			$sqlContPro = "SELECT id_contacto,
							       nombreCon,
							       ap_paterno,
							       ap_materno,
							       nombre_area,
							       movil,
							       correo_instu
							FROM contacto
							WHERE id_contacto = ".$idContPro." ";
			$ejecutarContPro = mysql_query($sqlContPro, $this->conexion);

			$verCont = array();
			$rows = mysql_fetch_assoc($ejecutarContPro);

			return $rows;
		}*/
		
		// funcion para obtener el id de la tabla proveedor
		public function obtenerIdProveedor()
		{
			$sqlidProv = " SELECT id_prov
						  FROM proveedores
						  ORDER BY id_prov
						  DESC LIMIT 1;";
			$ejecutaridProv = mysql_query($sqlidProv,$this->conexion) or die (mysql_error());
			$rows = mysql_num_rows($ejecutaridProv);
			
			if($rows==0){
				$idProv = 1;
			}else	{
				$idProv = mysql_result($ejecutaridProv,0,'id_prov');
				$idProv = ($idProv + 1);
			}
			
			return $idProv;
		}

		// funcion para obtener una categoria del proveedor
		public function obtenerCategoria()
		{
			$sqlCat = "SELECT categoria,id_categoria
						FROM categoria_prov
						GROUP BY categoria";
			$ejecutarCat = mysql_query($sqlCat,$this->conexion) or die("Error de consulta obtener categoria".mysql_error());

			$categoriaPro = array();
			while ($rows = mysql_fetch_assoc($ejecutarCat)) {
				$categoriaPro[] = $rows;
			}

			return $categoriaPro;
		}

		public function incrementoDatFis()
		{			
			$sqlin = "SELECT id_datFiscal FROM datos_fiscales ORDER BY id_datFiscal DESC LIMIT 1";
			$ejecutar_sqlin=mysql_query($sqlin)or die ("Error de Consulta-Increment-datF");
			$filas=mysql_num_rows($ejecutar_sqlin);
			
			if($filas==0){
				$cv_df = 1;
			}else	{
				$cv_df = mysql_result($ejecutar_sqlin,0,'id_datFiscal');
				$cv_df = ($cv_df + 1);
			}
			return $cv_df;
		}

		//combo dinamico para tipo de razon_social (FISICA,MORAL)
		public function obtieneTrazon()
    	{
    		$sql3 = "SELECT * FROM tipos_razon_social";
			$ejecutar = mysql_query($sql3)or die ("Error de Consulta-razonS");
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
			$tipoRa = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$tipoRa[] = $rows;
			}
			
			return $tipoRa;
			}
		}

		//combo dinamico para nombre de banco
		public function obtieneBanco()
    	{
    		$sql = "SELECT * FROM bancos";
			$ejecutar = mysql_query($sql) or die ("Error de Consulta");

			$nombreB = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$nombreB[] = $rows;
			}
			
			return $nombreB;
		}

		//combo dinamico para el tipo de cuenta
		public function obtieneTipoC()
    	{
    		$sql = "SELECT * FROM tipo_cuenta";
			$ejecutar = mysql_query($sql) or die ("Error de Consulta");

			$tipo_c = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$tipo_c[] = $rows;
			}
			
			return $tipo_c;
		}

		// Función para registrar proveedores
		public function registrarProveedores($id_datf,$razon_s,$rfc,$tipo_rs,
											 $id_dire,$street,$noext,$noint,$col,$referen,
											 $id_prov,$prov,$cat,$phone,$dweb,
											 $id_dtb,$id_bank,$sucu,$titular,$nocuent,$clabe,$id_tcuenta) {
			
			// consulta para insertar en la tabla de datos fiscales
			$sqlinsertdf = "INSERT INTO datos_fiscales (id_datFiscal,razon_social,rfc,id_tipo_ra)
							 VALUES (".$id_datf.",'".$razon_s."','".$rfc."',".$tipo_rs.");";
			$ejecutar_sqlinsertdf = mysql_query($sqlinsertdf,$this->conexion) or die ("Error en insertar datos fiscales ".mysql_error());
			
			// consulta para insertar en la tabla de direcciones
			$sqlinsertdir = "INSERT INTO direcciones (id_direccion,calle,num_ext,num_int,colonia,referencia,id_cp)
							 VALUES (".$id_dire.",'".$street."',".$noext.",'".$noint."','".$col."','".$referen."',66145);";
			$ejecutar_sqlinsertdir = mysql_query($sqlinsertdir,$this->conexion) or die("Error en insertar direcciones ".mysql_error());

			// consulta para insertar en la tabla de proveedores
			$sqlinsertprov = "INSERT INTO proveedores (id_prov,fecha_alta,proveedor,tel,dirweb,id_categoria,id_datFiscal,id_direccion)
							  VALUES (".$id_prov.",NOW(),'".$prov."','".$phone."','".$dweb."',".$cat.",".$id_datf.",".$id_dire.");";
			$ejecutar_sqlinsertprov = mysql_query($sqlinsertprov,$this->conexion) or die("Error en insertar proveedores ".mysql_error());

			$sqlinsertdb = "INSERT INTO datos_bancarios (id_datBank,id_banco,sucursal,titular,no_cuenta,no_cuenta_interbancario,id_tipo_cuenta)
							VALUES (8,".$id_bank.",'".$sucu."','".$titular."','".$nocuent"','".$clabe."',".$id_tcuenta.");";
			$ejecutar_sqlinsertdb = mysql_query($sqlinsertdb,$this->conexion) or die("Error en insertar datos bancarios ".mysql_error());

			return $sqlinsertdf && $sqlinsertdir && $sqlinsertprov && $sqlinsertdb;
		}

    }
?>