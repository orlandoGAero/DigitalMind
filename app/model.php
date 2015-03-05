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
		
		//Función que obtiene el ultimo id de direccion registrado en la base de datos.
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
		
		/*Funcion para cargar div de los datos del formulario Dirección según el CP ingresado y con el  parametro de calve de contacto */
		public function obtenerDatosDireccionUpdate($idContact)
		{
			$consulta1 = "SELECT cp.id_cp,cp.codigoP
								FROM codigos_postales cp, direcciones d, contactos c
								WHERE cp.id_cp = d.id_cp
								 AND d.id_direccion = c.id_direccion
								 AND c.id_contacto = ".$idContact;
			$ejecutar1 = mysql_query($consulta1, $this->conexion) or die (mysql_error());
			$filas1 = mysql_num_rows($ejecutar1);
			if ($filas1 != 0) {
				$CodigoPostal = mysql_result($ejecutar1, 0, 'codigoP');
				$idCp = mysql_result($ejecutar1, 0, 'id_cp');
			}
				
			$consulta2 = "SELECT * FROM codigos_postales WHERE codigoP = ".$CodigoPostal." AND id_cp != ".$idCp." ORDER BY localidad";
			$ejecutar2 = mysql_query($consulta2, $this->conexion) or die (mysql_error());
			$filas2 = mysql_num_rows($ejecutar2);
		
            if($filas2 != 0){
            	$codigoPostal= array();
            	while ($rows = mysql_fetch_assoc($ejecutar2)) {
					$codigosPostales[] = $rows;
				}
            
		    	return $codigosPostales;
            }
		}
		
		/*Funcion para cargar div de los datos del formulario Dirección según el CP ingresado y con los parametros de código postal y llave primaria de la entidad codigos postales*/
		public function obtenerDatosDireccionInsert($CodigoPostal,$idCp)
		{
			$consulta = "SELECT * FROM codigos_postales WHERE codigoP = ".$CodigoPostal." AND id_cp != ".$idCp." ORDER BY localidad";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$codigoPostal= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$codigosPostales[] = $rows;
				}
            
		    	return $codigosPostales;
            }
		}
		
		public function obtieneNombreLocalidad($idcp)
    	{
    		$consulta = "SELECT localidad FROM codigos_postales WHERE id_cp =".$idcp;
			$ejecutar = mysql_query($consulta)or die ("Error de Consulta obtener localidad".mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$localidad = mysql_result($ejecutar, 0, 'localidad');
				return $localidad;
			}
		}
		
		//------------------------------------------------------------------CONTACTOS------------------------------------------------------------------------//
		public function obtenerContactos(){
			$consulta = "SELECT id_contacto,nombreCon,ap_paterno,ap_materno,nombre_area,movil,tel_oficina,correo_p,activo FROM contactos ORDER BY nombreCon;";
			$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
			
			$Contactos = array();
			while($rows = mysql_fetch_assoc($ejecutar)){
				$Contactos[] = $rows;
			}
			
			return $Contactos;
		}
		
		public function obtenerContacto($idCon)
		{
			$idCon = htmlspecialchars($idCon);
			
			$consulta = "SELECT c.id_contacto,c.nombreCon,c.ap_paterno,c.ap_materno,c.nombre_area,c.movil,c.tel_oficina,c.tel_emergencia,c.correo_p,c.correo_instu,
								c.facebook,c.twitter,c.skype,c.direccion_web,c.activo,cp.estado,cp.municipio,cp.localidad,cp.codigoP,d.id_direccion,d.calle,d.num_ext,d.num_int,d.colonia,d.referencia,d.id_cp
								FROM codigos_postales cp, direcciones d, contactos c
								WHERE cp.id_cp = d.id_cp
									AND d.id_direccion=c.id_direccion
									AND c.id_contacto =  ".$idCon;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			
			$contactl= array();
			$rows = mysql_fetch_assoc($ejecutar);
			
			return $rows;
		}
		
		public function obtenerIdContacto(){
			$consulta = "SELECT id_contacto FROM contactos ORDER BY id_contacto DESC LIMIT 1;";
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
		
		public function registrarContacto($idDireccion,$idCP,$calleCont,$numExtCont,$numIntCont,$coloniaCont,$referenciaCont,
		$idCont,$nomCont,$apCont,$amCont,$areaCont,$telMovilCont,$telOficinaCont,$telEmergenciaCont,$correoPersonalCont,
		$correoInstituCont,$facebookCont,$twitterCont,$skypeCont,$dirWebCont)
		{
			$band = 0;
			
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
			
			if($nomCont != "" && $apCont != "" && $amCont != "" && $areaCont != "" && $telMovilCont != "" && $telOficinaCont != "" && $telEmergenciaCont != "" && $correoPersonalCont!= ""
					&& $calleCont != "" && $numExtCont != "" && $coloniaCont != ""){
				//Valdaciones de las cadenas
			}else{
				$band = 1;
				echo" <script> alert('Complete toda la información requerida antes de continuar') </script> ";
			}
			
			if($idCP == 0){
				$band = 1;
				echo" <script> alert('Seleccione una localidad') </script> ";
			}
			
			if($band == 0){
				$consulta = "SELECT id_contacto,nombreCon,ap_paterno,ap_materno 
								FROM contactos
								WHERE nombreCon = '".$nomCont."' 
									AND ap_paterno = '".$apCont."' 
									AND ap_materno = '".$amCont."' 
									AND id_contacto != ".$idCont.";";
				$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
				
				$rows = mysql_num_rows($ejecutar);
				
				if($rows != 0){
					$band = 1;
					echo" <script> alert('El contacto $nomCont $apCont $amCont ya se encuentra registrado') </script> ";
				}
			}
			
			if($band == 0){
								
				$consulta1 = "INSERT INTO direcciones (id_direccion,calle,num_ext,num_int,colonia,referencia,id_cp) 
									VALUES(".$idDireccion.",'".$calleCont."',".$numExtCont.",".$numIntCont.",'".$coloniaCont."','".$referenciaCont."',".$idCP.");";
				$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en insertar dirección ".mysql_error());
				
				$consulta2 = "INSERT INTO contactos (id_contacto,nombreCon,ap_paterno,ap_materno,nombre_area,movil,tel_oficina,tel_emergencia,
										correo_p,correo_instu,facebook,twitter,skype,direccion_web,id_direccion,activo,fecha_alta)
										VALUES (".$idCont.",'".$nomCont."','".$apCont."','".$amCont."','".$areaCont."',".$telMovilCont.",".$telOficinaCont.",".$telEmergenciaCont.",'".$correoPersonalCont."',
										'".$correoInstituCont."','".$facebookCont."','".$twitterCont."','".$skypeCont."','".$dirWebCont."',".$idDireccion.",'Si',NOW());";
				$ejecutar2 = mysql_query($consulta2,$this->conexion) or die ("Error en insertar contacto ".mysql_error());	
				
				return $ejecutar1 & $ejecutar2;	
			}
			
		}
		
		public function actualizarContacto($idDireccion,$idCP,$calleCont,$numExtCont,$numIntCont,$coloniaCont,$referenciaCont,
		$idCont,$nomCont,$apCont,$amCont,$areaCont,$telMovilCont,$telOficinaCont,$telEmergenciaCont,$correoPersonalCont,
		$correoInstituCont,$facebookCont,$twitterCont,$skypeCont,$dirWebCont,$activoCont)
		{
			$band = 0;
			
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
			
			if($nomCont != "" && $apCont != "" && $amCont != "" && $areaCont != "" && $telMovilCont != "" && $telOficinaCont != "" && $telEmergenciaCont != "" && $correoPersonalCont!= ""
					&& $calleCont != "" && $numExtCont != "" && $coloniaCont != ""){
				//Valdaciones de las cadenas
			}else{
				$band = 1;
				echo" <script> alert('Complete toda la información requerida antes de continuar') </script> ";
			}
			
			if($idCP == 0){
				$band = 1;
				echo" <script> alert('Seleccione una localidad') </script> ";
			}
			
			if($band == 0){
				$consulta = "SELECT id_contacto,nombreCon,ap_paterno,ap_materno 
								FROM contactos
								WHERE nombreCon = '".$nomCont."' 
									AND ap_paterno = '".$apCont."' 
									AND ap_materno = '".$amCont."' 
									AND id_contacto != ".$idCont.";";
				$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
				
				$rows = mysql_num_rows($ejecutar);
				
				if($rows != 0){
					$band = 1;
					echo" <script> alert('El contacto $nomCont $apCont $amCont ya se encuentra registrado') </script> ";
				}
			}
			
			if($band == 0){
								
				$consulta1 = "UPDATE direcciones 
									SET calle = '".$calleCont."',num_ext = ".$numExtCont.",num_int = ".$numIntCont.",colonia = '".$coloniaCont."',referencia = '".$referenciaCont."',id_cp = ".$idCP."
									WHERE id_direccion = ".$idDireccion;
				$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en actualizar dirección ".mysql_error());
				
				$consulta2 = "UPDATE contactos
									SET nombreCon = '".$nomCont."',ap_paterno = '".$apCont."',ap_materno = '".$amCont."',nombre_area = '".$areaCont."',movil = ".$telMovilCont.",tel_oficina = ".$telOficinaCont.",
									tel_emergencia = ".$telEmergenciaCont.",correo_p = '".$correoPersonalCont."',correo_instu = '".$correoInstituCont."',facebook = '".$facebookCont."',twitter = '".$twitterCont."',
									skype = '".$skypeCont."',direccion_web = '".$dirWebCont."',activo = '".$activoCont."'
									WHERE id_contacto = ".$idCont;
				$ejecutar2 = mysql_query($consulta2,$this->conexion) or die ("Error en actualizar contacto ".mysql_error());	
				
				return $ejecutar1 & $ejecutar2;	
			}
			
		}
		
		public function borrarContacto($idCont){
			$consulta1 = "SELECT cc.id_contacto
								FROM contactos c, cliente_contacto cc
								WHERE c.id_contacto = cc.id_contacto
									AND c.id_contacto = ".$idCont;
			$ejecutar1 = mysql_query($consulta1,$this->conexion) or die (mysql_error());
			$filas1 = mysql_num_rows($ejecutar1);
			
			$consulta2 = "SELECT pc.id_contacto
								FROM contactos c, proveedores_contacto pc
								WHERE c.id_contacto = pc.id_contacto
									AND c.id_contacto = ".$idCont;
			$ejecutar2 = mysql_query($consulta2,$this->conexion) or die (mysql_error());
			$filas2 = mysql_num_rows($ejecutar2);
			
			if($filas1 !=0  || $filas2 != 0){
				$consulta = "SELECT activo FROM contactos WHERE id_contacto = ".$idCont;
				$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
				$Activo = mysql_result($ejecutar, 0, 'activo');
				
				if($Activo != 'No'){
					$cunsultaActualiza = "UPDATE contactos SET activo = 'No' WHERE id_contacto = ".$idCont;
					$ejecutarActualiza = mysql_query($cunsultaActualiza,$this->conexion) or die (mysql_error());
					echo" <script> alert('El registro no puede ser eliminado, soló se desactivo') 
								window.location='index.php?url=listContact';
						 	</script> ";
				}else{
					echo" <script> alert('El registro ya esta desactivado') 
								window.location='index.php?url=listContact';
						 	</script> ";
				}
				
			}else{
				$consulta2 = "SELECT id_direccion FROM contactos WHERE id_contacto = ".$idCont;
				$ejecutar2 = mysql_query($consulta2,$this->conexion) or die (mysql_error());
				$idDir = mysql_result($ejecutar2, 0, 'id_direccion');
									
				$consultaElim = "DELETE d,c FROM direcciones d INNER JOIN contactos c WHERE d.id_direccion = c.id_direccion AND d.id_direccion = ".$idDir;
				$ejecutarElim = mysql_query($consultaElim,$this->conexion) or die (mysql_error());
								
				echo" <script> alert('El registro ha sido eliminado correctamente') 
							window.location='index.php?url=listContact';
					 	</script> ";
			}			
		}		

		/*--------------------------------------------------CLIENTES----------------------------------------------------*/
		
		/*Funcion para cargar ventana emergente los datos del formulario Dirección segun el CP ingresado*/
		public function obtenerCodigoP($idCp)
		{
			$idCp = htmlspecialchars($idCp);				
			$consulta = "SELECT * FROM codigos_postales WHERE codigoP = ".$idCp." order by localidad";
			$ejecutar = mysql_query($consulta, $this->conexion);
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$codigoPostal= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$codigosPostales[] = $rows;
				}
            
		    	return $codigosPostales;
            }
		}



		/*Consulta para el listado de clientes*/
		public function obtieneClientes()
		{
			$consultaC = "SELECT c.`id_cliente`,c.`nombre`,df.`razon_social`,df.`rfc`,d.`id_cp`,cp.`municipio`,cp.`estado`,c.`activo`
			FROM datos_fiscales df,clientes c,direcciones d,codigos_postales cp
			WHERE df.`id_datFiscal`=c.`id_datFiscal`
			AND d.`id_direccion`=c.`id_direccion`
			AND cp.`id_cp`=d.`id_cp`
			ORDER BY  id_cliente";
			$ejecutarC = mysql_query($consultaC, $this->conexion);

			$Clientes = array();
			while ($rows = mysql_fetch_assoc($ejecutarC)) {
				$Clientes[] = $rows;
			}
			
			return $Clientes;  
			}


			//obtiene id direccion para insercion
		public function idDir($cv_dir)
		{			
			$sql="SELECT id_direccion FROM direcciones ORDER BY id_direccion DESC LIMIT 1";
			$consulta=mysql_query($sql)or die ("Error de Consulta-Increment-Dir");
			$filas=mysql_num_rows($consulta);
			$cv_dir=mysql_result($consulta,0,'id_direccion');
			$cv_dir=($cv_dir + 1);
			return $cv_dir;
		}

	
		/*Consulta para el detalle_ Cliente*/
		public function  obtieneVcliente($cv_cli)
		{
			$cv_cli = htmlspecialchars($cv_cli);
			$consultaC = "SELECT c.`id_cliente`,c.`nombre`,c.`fecha_alta`,c.`activo`,df.`razon_social`,df.`id_datFiscal`,df.`rfc`,tr.`tipo`,cp.`codigoP` ,
			cp.`estado`,cp.`municipio`,cp.`localidad`,d.`id_direccion`,d.`calle`,d.`colonia`,d.`num_ext`,d.`num_int`,d.`referencia`,con.`id_contacto`,
			con.`nombreCon`,con.`ap_paterno`,con.`ap_materno`,con.`nombre_area`,con.`correo_instu`,con.`movil`,con.`tel_oficina`,db.`id_datBank`,
			b.`nombre_banco`,db.`sucursal`,db.`titular`,db.`no_cuenta`,db.`no_cuenta_interbancario`,tp.`tipo_cuenta`
			FROM datos_fiscales df,clientes c,direcciones d,codigos_postales cp,tipos_razon_social tr,contacto con,cliente_contacto cc,
			det_bank_cli dbc,datos_bancarios db,bancos b,tipo_cuenta tp
			WHERE df.`id_datFiscal`= c.`id_datFiscal`
			AND d.`id_direccion` = c.`id_direccion`
			AND cp.`id_cp` = d.`id_cp`
			AND tr.`id_tipo_ra` = df.`id_tipo_ra`
			AND c.`id_cliente` = cc.`id_cliente`
			AND con.`id_contacto` = cc.`id_contacto`
			AND c.`id_cliente` = dbc.`id_cliente`
			AND db.`id_datBank` = dbc.`id_datBank`
			AND b.`id_banco` = db.`id_banco`
			AND tp.`id_tipo_cuenta` = db.`id_tipo_cuenta`
			AND c.`id_cliente` =  ".$cv_cli;
			$ejecutarC = mysql_query($consultaC, $this->conexion);
			$Cliente= array();
			$rows = mysql_fetch_assoc($ejecutarC);
			return $rows;
		}

		/*Busqueda por criterio Clientes*/
		public function busquedaX($busqueda)
		{
		$busqueda = htmlspecialchars($busqueda);
         $sql = "SELECT * FROM clientes where nombre LIKE '%".$busqueda."%' OR fecha_alta LIKE '%".$busqueda."%'";
         $result = mysql_query($sql, $this->conexion);
         $cliente_result = array();

		         while ($row = mysql_fetch_assoc($result))
		         {
		             $cliente_result[] = $row;
		         }
				if(mysql_num_rows($result)<1){
				    echo "<script>  alert ('No se encuentran registros con el criterio solicitado')
				    window.location='index.php?url=listaCliente';</script>";
				}
		         return $cliente_result;
				 }


		//eliminación de cliente
		public function elimCliente($del_cli)
		{
		
		$band = 0;
			if ($band==0) {
				
				$sql = "SELECT dbc.`id_cliente`,dbc.`id_bank_bcl`,dbc.`id_datBank`
				FROM  clientes c,det_bank_cli dbc
				WHERE c.`id_cliente`= dbc.`id_cliente`
				AND dbc.`id_cliente`  = $del_cli";				
				$ejecutar =mysql_query($sql) or die (mysql_error());				
				$filas = mysql_num_rows($ejecutar);				
				if($filas!=0){
					$band =1;
						$sqlDes = "UPDATE `clientes` SET  `activo` = 'No' WHERE `id_cliente` = $del_cli";
						$ejecutarDes = mysql_query($sqlDes) or die (mysql_error());
						echo" <script> alert('El registro no puede ser eliminado, solo se desactivo') 
						window.location='index.php?url=listaCliente';
				 		</script> ";
						}else{
					//elimi
					$sqlEl = "DELETE FROM clientes WHERE id_cliente = $del_cli ";
					$ejecutarEl = mysql_query($sqlEl) or die (mysql_error());
					echo" <script> alert('El registro ha sido eliminado correctamente') 
						window.location='index.php?url=listaCliente';
				 	</script> ";

				}
			}

		}
		
		/*obtiene id del cliente para inserción*/
			public function incrementoCli()
		{			
			$sql="SELECT id_cliente FROM clientes ORDER BY id_cliente DESC LIMIT 1";
			$consulta=mysql_query($sql)or die ("Error de Consulta-Increment-Cli");
			$filas=mysql_num_rows($consulta);
			
			if($filas==0){
				$cv_cli = 1;
			}else	{
				$cv_cli = mysql_result($consulta,0,'id_cliente');
				$cv_cli = ($cv_cli + 1);
			}
			return $cv_cli;
		}
		//obtiene id de datos fiscales inserción
		public function incrementodFiscal()
		{
			$sql="SELECT id_datFiscal FROM datos_fiscales ORDER BY id_datFiscal DESC LIMIT 1";
			$consulta=mysql_query($sql)or die ("Error de Consulta-Increment-datF");
			$filas=mysql_num_rows($consulta);
			
			if($filas==0){
				$cv_dfiscal = 1;
			}else	{
				$cv_dfiscal = mysql_result($consulta,0,'id_datFiscal');
				$cv_dfiscal = ($cv_dfiscal + 1);
			}
			return $cv_dfiscal;
		}

		//combo dinamico para tipo de razon_social (FISICA,MORAL)
		public function obtieneTrazon()
    	{
    		$sql3 = "SELECT * FROM tipos_razon_social";
			$ejecutar = mysql_query($sql3)or die ("Error de Consulta-razonS");

			$tipoRa = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$tipoRa[] = $rows;
			}
			
			return $tipoRa;
		}

		/*id para inserción */
		public function incrementoDB()
		{			
			$sql="SELECT id_datBank FROM datos_bancarios ORDER BY id_datBank DESC LIMIT 1";
			$consulta=mysql_query($sql)or die ("Error de Consulta-Increment-datBANK");
			$filas=mysql_num_rows($consulta);
			
			if($filas==0){
				$cv_db = 1;
			}else	{
				$cv_db = mysql_result($consulta,0,'id_datBank');
				$cv_db = ($cv_db + 1);
			}
			return $cv_db;
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

		/*Funcion para insertar la dirección del cliente*/
        public function addDir($id_dir,$calle,$numext,$numint,$colonia,$referencia,$id_cp)
		{			
	     $sql = "INSERT INTO direcciones VALUES ('$id_dir','$calle','$numext','$numint','$colonia','$referencia','$id_cp')";				
         $ejecutar =mysql_query($sql) or die (mysql_error());				
        }
			 
			//inserta CLIENTE
		 public function addCliente($idCli,$nombreCli,$fecha_alta,$activo,$idDatFiscal,$razonS,$rfc,$id_direccion)
		{
			$nombreCli = mb_strtoupper($nombreCli);
			$razonS = mb_strtoupper($razonS);
			$rfc = mb_strtoupper($rfc);			
			
			$consulta1 = "INSERT INTO datos_fiscales (id_datFiscal,razon_social,rfc) 
								VALUES(".$idDatFiscal.",'".$razonS."','".$rfc."')";
			$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en insertar datosFIS".mysql_error());
			
			$consulta2 = "INSERT INTO clientes (id_cliente,nombre,fecha_alta,id_datFiscal,id_direccion,activo) 
									VALUES (".$idCli.",'".$nombreCli."','".$fecha_alta."','".$idDatFiscal."','".$id_direccion."','".$activo."')";
			$ejecutar2 = mysql_query($consulta2,$this->conexion) or die ("Error en insertar cliente ".mysql_error());	

			return $ejecutar1 & $ejecutar2;
			}
	//-----------------------------------------------------------------------------------------------------------------
	
	//CODIGOS POSTALES
		public function obtenerCodigosPostales()
		{
			$consulta = "SELECT * FROM codigos_postales LIMIT 5000";
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

		// Función para registrar proveedores
		public function registrarProveedores($id_datf,$razon_s,$rfc,$tipo_rs,
											 $id_dire,$street,$noext,$noint,$col,$referen,$cp,
											 $id_prov,$prov,$cat,$phone,$dweb,
											 $id_dtb,$id_bank,$sucu,$titular,$nocuent,$clabe,$id_tcuenta) {
			
			// consulta para insertar en la tabla de datos fiscales
			$sqlinsertdf = "INSERT INTO datos_fiscales (id_datFiscal,razon_social,rfc,id_tipo_ra)
							 VALUES (".$id_datf.",'".$razon_s."','".$rfc."',".$tipo_rs.");";
			$ejecutar_sqlinsertdf = mysql_query($sqlinsertdf,$this->conexion) or die ("Error en insertar datos fiscales ".mysql_error());
			
			// consulta para insertar en la tabla de direcciones
			$sqlinsertdir = "INSERT INTO direcciones (id_direccion,calle,num_ext,num_int,colonia,referencia,id_cp)
							 VALUES (".$id_dire.",'".$street."',".$noext.",'".$noint."','".$col."','".$referen."',".$cp.");";
			$ejecutar_sqlinsertdir = mysql_query($sqlinsertdir,$this->conexion) or die("Error en insertar direcciones ".mysql_error());

			// consulta para insertar en la tabla de proveedores
			$sqlinsertprov = "INSERT INTO proveedores (id_prov,fecha_alta,proveedor,tel,dirweb,id_categoria,id_datFiscal,id_direccion)
							  VALUES (".$id_prov.",NOW(),'".$prov."','".$phone."','".$dweb."',".$cat.",".$id_datf.",".$id_dire.");";
			$ejecutar_sqlinsertprov = mysql_query($sqlinsertprov,$this->conexion) or die("Error en insertar proveedores ".mysql_error());

			// consulta para insertar en la tabla de proveedores_contacto
			$sqlinsertprov_contact = "INSERT INTO proveedores_contacto (id_prov,id_contacto)
									  VALUES (".$id_prov.",5);";
			$ejecutar_sqlinsertprov_contact = mysql_query($sqlinsertprov_contact,$this->conexion) or die("Error en insertar proveedores-contactos".mysql_error());

			// consulta para insertar en la tabla datos bancarios
			$sqlinsertdb = "INSERT INTO datos_bancarios (id_datBank,id_banco,sucursal,titular,no_cuenta,no_cuenta_interbancario,id_tipo_cuenta)
							VALUES (".$id_dtb.",".$id_bank.",'".$sucu."','".$titular."','".$nocuent."','".$clabe."',".$id_tcuenta.");";
			$ejecutar_sqlinsertdb = mysql_query($sqlinsertdb,$this->conexion) or die("Error en insertar datos bancarios ".mysql_error());

			// consulta para insertar en la tabla detalle datos bancarios
			$sqlinsertdb_prov = "INSERT INTO det_bank_prov (id_prov,id_datBank)
								 VALUES (".$id_prov.",".$id_dtb.");";
			$ejecutar_sqlinsertdb_prov = mysql_query($sqlinsertdb_prov,$this->conexion) or die("Error en insertar datos bancarios proveedor ".mysql_error());
			
			return $sqlinsertdf && $sqlinsertdir && $sqlinsertprov && $sqlinsertdb && $sqlinsertdb_prov && $sqlinsertprov_contact;
		}
    }
?>