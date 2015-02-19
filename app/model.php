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

		//---------------------------------------------------------------------------------------------------------------
		/*--------------------------------------------------CLIENTES----------------------------------------------------*/
		
		/*Funcion para cargar ventana emergente los datos del formulario Dirección segun el CP ingresado*/
		public function obtenerCodigoP($idCp)
		{
			$idCp = htmlspecialchars($idCp);				
			$consulta = "SELECT * FROM codigos_postales WHERE codigoP = ".$idCp." order by localidad";
			$ejecutar = mysql_query($consulta, $this->conexion);
			$filas = mysql_num_rows($ejecutar);
           		$codigoPostal= array();
		
            	if($filas!=0){
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
			
		//proveedores

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
    }
    
?>