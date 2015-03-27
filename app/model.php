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
		
		//------------------------------------------------------------------FUNCIONES DIRECCIÓN------------------------------------------------------------------------//
		//Función que obtiene el último id de direccion registrado en la base de datos.
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
		
		public function obtenerEstados(){
			$consulta = "SELECT id_estado,estado FROM estados ORDER BY estado;";
			$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
			
			$state = array();
			while($rows = mysql_fetch_assoc($ejecutar)){
				$state[] = $rows;
			}
			
			return $state;
		}
		
		public function obtenerNombreEstado($nameState){
			$consulta = "SELECT estado FROM estados WHERE id_estado = ".$nameState;
			$ejecutar = mysql_query($consulta)or die ("Error de Consulta obtener nombre estado".mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$estado = mysql_result($ejecutar, 0, 'estado');
				return $estado;
			}
		}
		
		public function municipioObtener($estado){
			$consulta = "SELECT municipio FROM codigos_postales WHERE id_estado = ".$estado." GROUP BY municipio;";
			$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
			
			$municipality = array();
			while($rows = mysql_fetch_assoc($ejecutar)){
				$municipality[] = $rows;
			}
			
			return $municipality;
		}
		
		public function obtenerDatosEstadoInsert($ID_Estado){
			$consulta = "SELECT id_estado,estado FROM estados WHERE id_estado != ".$ID_Estado." ORDER BY estado;";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$estadoDiff= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$estadoDiff[] = $rows;
				}
            
		    	return $estadoDiff;
            }
		}
		
		public function obtenerDatosMunicipioInsert($ID_Estado,$Municipality){
			$consulta = "SELECT municipio FROM codigos_postales WHERE id_estado = ".$ID_Estado." AND municipio != '".$Municipality."' GROUP BY municipio;";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$municipioDiff= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$municipioDiff[] = $rows;
				}
            
		    	return $municipioDiff;
            }
		}
		
		public function obtener_direccion($estado,$municipio,$localidad){
			$consulta = "SELECT e.estado,cp.id_cp,cp.municipio,cp.localidad,cp.codigoP
								FROM estados e,codigos_postales cp
								WHERE e.id_estado=cp.id_estado
									AND cp.id_estado = '".$estado."' AND cp.municipio = '".$municipio."' AND cp.localidad LIKE '".$localidad."%'
									ORDER BY cp.localidad;";
			$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
			
			$direccion = array();
			while($rows = mysql_fetch_assoc($ejecutar)){
				$direccion[] = $rows;
			}
			
			return $direccion;
		}
		
		/*Funcion para cargar div de los datos del formulario Dirección según el CP ingresado y con el  parametro de calve de contacto */
		/*public function obtenerDatosDireccionUpdate($idContact)
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
		}*/

		/*Funcion para cargar div de los datos del formulario Dirección según el CP ingresado y con los parametros de código postal y llave primaria de la entidad codigos postales*/
		/*public function obtenerDatosDireccionInsert($CodigoPostal,$idCp)
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
		}*/
		
		//------------------------------------------------------------------CONTACTOS------------------------------------------------------------------------//		
		public function obtenerContactos(){
			$consulta = "SELECT cp.municipio,d.colonia,c.id_contacto,c.nombreCon,c.ap_paterno,c.ap_materno,
							c.nombre_area,c.movil,c.whatsapp,c.correo_p,c.activo
						FROM codigos_postales cp, direcciones d, contactos c
						WHERE cp.id_cp=d.id_cp
							AND d.id_direccion=c.id_direccion
						ORDER BY nombreCon;";
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
			
			$consulta = "SELECT c.id_contacto,c.nombreCon,c.ap_paterno,c.ap_materno,c.nombre_area,c.movil,c.whatsapp,c.extension,c.tel_oficina,c.tel_emergencia,c.correo_p,c.correo_instu,
									c.facebook,c.twitter,c.skype,c.direccion_web,c.activo,e.id_estado,e.estado,cp.municipio,cp.localidad,cp.codigoP,d.id_direccion,d.calle,d.num_ext,d.num_int,d.colonia,d.referencia,d.id_cp
						FROM estados e,codigos_postales cp, direcciones d, contactos c
						WHERE e.id_estado = cp.id_estado
							AND cp.id_cp = d.id_cp
							AND d.id_direccion=c.id_direccion
							AND c.id_contacto =  ".$idCon;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			
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
		$idCont,$nomCont,$apCont,$amCont,$areaCont,$telMovilCont,$whatsappCont,$extCont,$telOficinaCont,$telEmergenciaCont,$correoPersonalCont,
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
			
			if($idCP == ""){
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
				
				$consulta2 = "INSERT INTO contactos (id_contacto,nombreCon,ap_paterno,ap_materno,nombre_area,movil,whatsapp,extension,tel_oficina,
									tel_emergencia,correo_p,correo_instu,facebook,twitter,skype,direccion_web,id_direccion,activo,fecha_alta)
										VALUES (".$idCont.",'".$nomCont."','".$apCont."','".$amCont."','".$areaCont."',".$telMovilCont.",'".$whatsappCont."',".$extCont.",".$telOficinaCont.",
										".$telEmergenciaCont.",'".$correoPersonalCont."','".$correoInstituCont."','".$facebookCont."','".$twitterCont."','".$skypeCont."',
										'".$dirWebCont."',".$idDireccion.",'Si',NOW());";
				$ejecutar2 = mysql_query($consulta2,$this->conexion) or die ("Error en insertar contacto ".mysql_error());	
				
				return $ejecutar1 & $ejecutar2;	
			}
			
		}
		
		public function busquedaContactos($nomCont,$nomMunicipio,$nomArea){
				
			$filtro = "";
			
			// Si ningún criterio esta vacío
			if (!empty($nomCont) && !empty($nomMunicipio) && !empty($nomArea)) {
				$filtro .= "MATCH(c.nombreCon,c.ap_paterno,c.ap_materno) AGAINST('".$nomCont."') AND cp.municipio LIKE '".$nomMunicipio."%' AND c.nombre_area LIKE '".$nomArea."%'";
			}elseif (!empty($nomCont) && !empty($nomMunicipio) && empty($nomArea)) {
				$filtro .= "MATCH(c.nombreCon,c.ap_paterno,c.ap_materno) AGAINST('".$nomCont."') AND cp.municipio LIKE '".$nomMunicipio."%'";
			}elseif (!empty($nomCont) && empty($nomMunicipio) && !empty($nomArea)) {
				$filtro .= "MATCH(c.nombreCon,c.ap_paterno,c.ap_materno) AGAINST('".$nomCont."') AND c.nombre_area LIKE '".$nomArea."%'";
			}elseif (empty($nomCont) && !empty($nomMunicipio) && !empty($nomArea)) {
				$filtro .= "cp.municipio LIKE '".$nomMunicipio."%' AND c.nombre_area LIKE '".$nomArea."%'";
			}elseif (!empty($nomCont) && empty($nomMunicipio) && empty($nomArea)) {
				$filtro .= "MATCH(c.nombreCon,c.ap_paterno,c.ap_materno) AGAINST('".$nomCont."')";
			}elseif (empty($nomCont) && !empty($nomMunicipio) && empty($nomArea)) {
				$filtro .= "cp.municipio LIKE '".$nomMunicipio."%'";
			}elseif (empty($nomCont) && empty($nomMunicipio) && !empty($nomArea)) {
				$filtro .= "c.nombre_area LIKE '".$nomArea."%'";	
			}
			
			if($filtro != ""){
				$consulta = "SELECT c.id_contacto,c.nombreCon,c.ap_paterno,c.ap_materno,cp.municipio,d.colonia,c.nombre_area,c.movil,c.whatsapp,c.correo_p,c.activo
						FROM codigos_postales cp INNER JOIN direcciones d INNER JOIN contactos c
						ON cp.id_cp = d.id_cp AND d.id_direccion = c.id_direccion
						WHERE ".$filtro;
				$ejecutar = mysql_query($consulta,$this->conexion) or die ("Error en busqueda ".mysql_error());
			
				$contactos = array();
				while($rows = mysql_fetch_assoc($ejecutar)){
					$contactos[] = $rows;
				}
				
				return $contactos;
			}
			
			
		}
		
		public function actualizarContacto($idDireccion,$idCP,$calleCont,$numExtCont,$numIntCont,$coloniaCont,$referenciaCont,
		$idCont,$nomCont,$apCont,$amCont,$areaCont,$telMovilCont,$whatsAppCont,$extCont,$telOficinaCont,$telEmergenciaCont,$correoPersonalCont,
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
			
			if($nomCont != "" && $apCont != "" && $amCont != "" && $areaCont != "" && $telMovilCont != "" && $extCont != "" && $telOficinaCont != "" && $telEmergenciaCont != ""
					&& $correoPersonalCont!= "" && $calleCont != "" && $numExtCont != "" && $coloniaCont != ""){
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
									SET nombreCon = '".$nomCont."',ap_paterno = '".$apCont."',ap_materno = '".$amCont."',nombre_area = '".$areaCont."',movil = ".$telMovilCont.",whatsapp = '".$whatsAppCont."',
									extension = ".$extCont.",tel_oficina = ".$telOficinaCont.",tel_emergencia = ".$telEmergenciaCont.",correo_p = '".$correoPersonalCont."',correo_instu = '".$correoInstituCont."',
									facebook = '".$facebookCont."',twitter = '".$twitterCont."',skype = '".$skypeCont."',direccion_web = '".$dirWebCont."',activo = '".$activoCont."'
									WHERE id_contacto = ".$idCont;
				$ejecutar2 = mysql_query($consulta2,$this->conexion) or die ("Error en actualizar contacto ".mysql_error());	
				
				return $ejecutar1 & $ejecutar2;	
			}
			
		}
		
		public function obtenerDatosEstadoUpdate($IdContacto){
			$consulta1 = "SELECT 
						  e.id_estado 
						FROM
						  estados e 
						  INNER JOIN codigos_postales cp 
						  INNER JOIN direcciones d 
						  INNER JOIN contactos c 
						    ON e.id_estado = cp.id_estado 
						    AND cp.id_cp = d.id_cp
						    AND d.id_direccion = c.id_direccion 
						WHERE c.id_contacto = ".$IdContacto;
			$ejecutar1 = mysql_query($consulta1, $this->conexion) or die (mysql_error());
			$filas1 = mysql_num_rows($ejecutar1);
			
			if($filas1 != 0){
				$ID_Estado = mysql_result($ejecutar1,0,'id_estado');
			}
			
			$consulta2 = "SELECT id_estado,estado FROM estados WHERE id_estado != ".$ID_Estado." ORDER BY estado;";
			$ejecutar2 = mysql_query($consulta2, $this->conexion) or die (mysql_error());
			$filas2 = mysql_num_rows($ejecutar2);
		
            if($filas2 != 0){
            	$estadoDiff= array();
            	while ($rows = mysql_fetch_assoc($ejecutar2)) {
					$estadoDiff[] = $rows;
				}
            
		    	return $estadoDiff;
            }
		}
		
		public function obtenerDatosMunicipioUpdate($IdContacto){
			$consulta1 = "SELECT 
						  e.id_estado,
						  cp.municipio
						FROM
						  estados e 
						  INNER JOIN codigos_postales cp 
						  INNER JOIN direcciones d 
						  INNER JOIN contactos c 
						    ON e.id_estado = cp.id_estado 
						    AND cp.id_cp = d.id_cp
						    AND d.id_direccion = c.id_direccion 
						WHERE c.id_contacto = ".$IdContacto;
			$ejecutar1 = mysql_query($consulta1, $this->conexion) or die (mysql_error());
			$filas1 = mysql_num_rows($ejecutar1);
			
			if($filas1){
				$ID_Estado = mysql_result($ejecutar1,0,'id_estado');
				$Municipality = mysql_result($ejecutar1,0,'municipio');
			}
			
			$consulta2 = "SELECT municipio FROM codigos_postales WHERE id_estado = ".$ID_Estado." AND municipio != '".$Municipality."' GROUP BY municipio;";
			$ejecutar2 = mysql_query($consulta2, $this->conexion) or die (mysql_error());
			$filas2 = mysql_num_rows($ejecutar2);
		
            if($filas2 != 0){
            	$municipioDiff= array();
            	while ($rows = mysql_fetch_assoc($ejecutar2)) {
					$municipioDiff[] = $rows;
				}
            
		    	return $municipioDiff;
            }
		}		
		
		public function obtener_direccion_update($IdContacto){
			$consulta1 = "SELECT 
						  e.id_estado,
						  cp.municipio,
						  cp.localidad
						FROM
						  estados e 
						  INNER JOIN codigos_postales cp 
						  INNER JOIN direcciones d 
						  INNER JOIN contactos c 
						    ON e.id_estado = cp.id_estado 
						    AND cp.id_cp = d.id_cp
						    AND d.id_direccion = c.id_direccion 
						WHERE c.id_contacto = ".$IdContacto;
			$ejecutar1 = mysql_query($consulta1,$this->conexion) or die (mysql_error());
			$filas1 = mysql_num_rows($ejecutar1);
			
			if($filas1 != 0){
				$estado = mysql_result($ejecutar1,0,'id_estado');
				$municipality = mysql_result($ejecutar1,0,'municipio');
				$locality = mysql_result($ejecutar1,0,'localidad');
			}
				
			$consulta2 = "SELECT e.estado,cp.id_cp,cp.municipio,cp.localidad,cp.codigoP
								FROM estados e,codigos_postales cp
								WHERE e.id_estado=cp.id_estado
									AND cp.id_estado = '".$estado."' AND cp.municipio = '".$municipality."' AND cp.localidad LIKE '".$locality."%'
									ORDER BY cp.localidad;";
			$ejecutar2 = mysql_query($consulta2,$this->conexion) or die (mysql_error());
			
			$direccion = array();
			while($rows = mysql_fetch_assoc($ejecutar2)){
				$direccion[] = $rows;
			}
			
			return $direccion;
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

		/*-------------------------------------------------CLIENTES (SAMANTHA)--------------------------------------------*/
		/*---------------------------Funciones del combo pro--------------------------------------------------------------*/
		//función para obtener todos los estados
		public function obtenerEstado(){
			$consulta = "SELECT id_estado,estado FROM estados ORDER BY estado;";
			$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
			
			$state = array();
			while($rows = mysql_fetch_assoc($ejecutar)){
				$state[] = $rows;
			}
			
			return $state;
		}
		
			//obtiene los municipios que pertenecen al estado seleccionado
            public function obtenerMunicipio($idEdo){
            
			$consultaEs = "SELECT municipio  FROM  codigos_postales  WHERE id_estado=$idEdo GROUP BY municipio; ";
			$ejecutarEs = mysql_query($consultaEs,$this->conexion) or die (mysql_error());
			

    
			while($rows = mysql_fetch_assoc($ejecutarEs)){
				$municipio[] = $rows;
			}
  		  return $municipio;

            }
            //obtiene las localidades que pertenecen al estado y municipio seleccionado
            public function obtenerLocalidad($idEdo, $municipio){
            
			$consultaEs = "SELECT localidad,codigoP, id_cp  FROM  codigos_postales  WHERE id_estado=$idEdo  AND municipio='$municipio'";
			$ejecutarEs = mysql_query($consultaEs,$this->conexion) or die (mysql_error());
			

    			$muni= array();
			while($rows = mysql_fetch_assoc($ejecutarEs)){
				$muni[] = $rows;
			}
    	return $muni;

            }
        
        
        /*Obtener Datos Bancarios del Cliente*/
        
 		 public function obtenerDatBancarios($idCli){
			$consultaEs = "SELECT datos_bancarios.`titular`,bancos.`nombre_banco`, datos_bancarios.`sucursal`, datos_bancarios.`no_cuenta`, 
			datos_bancarios.`no_cuenta_interbancario`, tipo_cuenta.`tipo_cuenta` 
			FROM det_bank_cli
			INNER JOIN datos_bancarios ON datos_bancarios.`id_datBank`=det_bank_cli.`id_datBank`
			INNER JOIN bancos  ON bancos.`id_banco`=datos_bancarios.`id_banco`
			INNER JOIN tipo_cuenta ON tipo_cuenta.`id_tipo_cuenta`=datos_bancarios.`id_tipo_cuenta`
			AND det_bank_cli.`id_cliente`=$idCli";
			      
			$ejecutarEs = mysql_query($consultaEs,$this->conexion) or die (mysql_error());
			

    			$TablaDatBanc= array();
			while($rows = mysql_fetch_assoc($ejecutarEs)){
				$TablaDatBanc[] = $rows;
			}
    		return $TablaDatBanc;

            }
        
            //funcion para agregar datos "n" registros bancarios a clientes
		public function AgregarDatBancarios($idDatBank,$nombreB,$sucursal,$titular,$ncuenta,$n_clave,$tipo,$idCli){
			$consulta = "INSERT INTO datos_bancarios 
			VALUES ($idDatBank,$nombreB,'$sucursal','$titular',$ncuenta,$n_clave,$tipo)";
			$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());

			$consulta1  = "INSERT INTO det_bank_cli (id_cliente,id_datBank)
			VALUES ($idCli,$idDatBank)";      
			$ejecutar1 = mysql_query($consulta1,$this->conexion) or die (mysql_error());
			


            }
  		//función para Agregar Contactos nuevos desde el formulario de cliente para que despues de insertar en contactos sean asigandos a la tabla cliente_contacto
		public function AgregarDatContacto
			($idcli,$idContact,$nameContact,$ApPContact,$ApMContact,$nameArea,$telMovil,$whatsapp,$extC,
			 $telOficina,$telEmergencia,$emailPersonal,$emailInstitucional,$redSocialF,$redSocialT,$redSocialS,$webPage, 
			 $iddir,$idcp,$calle,$nume,$numi,$col,$ref){

			$sql = "INSERT INTO direcciones VALUES ($iddir,'$calle',$nume,$numi,'$col','$ref',$idcp)";             
			$ejecutar =mysql_query($sql) or die ("Error insertar-DIRECCION       ".mysql_error());

			    
			    
			$consulta1  = "INSERT INTO contactos
			VALUES ($idContact,'$nameContact','$ApPContact','$ApMContact','$nameArea','$telMovil','$whatsapp',$extC,
			 $telOficina,$telEmergencia,'$emailPersonal','$emailInstitucional','$redSocialF','$redSocialT','$redSocialS','$webPage',$iddir,'Si',NOW())";      
			$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error insertar-CONTACTO      ".mysql_error());

			$consulta2  = "INSERT INTO cliente_contacto(id_cliente,id_contacto) VALUES ($idcli,$idContact)";      
			$ejecutar2 = mysql_query($consulta2,$this->conexion) or die ("Error insertar-DETALLE-CLIENTE       ".mysql_error());


    
    
            }
  
        
 
		/**************************************************************************************************************************/

		/*Funcion para cargar ventana emergente los datos del formulario Dirección segun el CP ingresado*/
		public function obtenerCodigoP($idCp)
		{
			$idCp = htmlspecialchars($idCp);				
			$consulta = "SELECT cp.`id_cp`,cp.`codigoP`,cp.`municipio`,cp.`localidad`,es.`id_estado`,es.`estado`
			FROM codigos_postales cp,estados es
			WHERE es.`id_estado` = cp.`id_estado`
			AND codigoP = ".$idCp." order by localidad";
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

		//combo dinamico para cargar RAZON_SOCIAL
		public function nombreRazonS()
    	{
    		$sql4 = "SELECT * FROM datos_fiscales GROUP BY razon_social";
			$ejecutar4 = mysql_query($sql4)or die ("Error de Consulta-nombreR_S");
			$filas4 = mysql_num_rows($ejecutar4);		
            if($filas4 != 0){
			$nombreRazon = array();
			while ($rows = mysql_fetch_assoc($ejecutar4)) {
				$nombreRazon[] = $rows;
			}
			
			return $nombreRazon;
			}
		}

		/*Consulta para el listado de clientes*/
		public function obtieneClientes()
		{
			$consultaC = "SELECT c.`id_cliente`,c.`nombre`,df.`rfc`,d.`id_cp`,cp.`municipio`,d.`colonia`,c.`t_movil`,cat.`id_categoria`,cat.`categoria`,c.`activo`
			FROM datos_fiscales df,clientes c,direcciones d,codigos_postales cp,categoria_prov cat

			WHERE df.`id_datFiscal`=c.`id_datFiscal`
			AND d.`id_direccion`=c.`id_direccion`
			AND cp.`id_cp`= d.`id_cp`
			AND cat.`id_categoria` = c.`id_categoria`
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
		public function  obtieneVcliente($idCli)
		{
			$idCli = htmlspecialchars($idCli);
			$consultaC = "SELECT c.`id_cliente`,c.`nombre`,c.`fecha_alta`, c.`t_movil`,c.`t_oficina`,c.`t_emergencia`,c.`extension`,c.`direccion_web`,
			cat.`id_categoria`,cat.`categoria`, c.`activo`,df.`razon_social`,df.`id_datFiscal`,df.`rfc`,df.`tipo_ra`,cp.`codigoP` ,es.`estado`,cp.`municipio`,
			cp.`localidad`,d.`id_direccion`,d.`id_cp`,d.`calle`,d.`colonia`,d.`num_ext`,d.`num_int`,d.`referencia`,con.`id_contacto`,con.`nombreCon`,con.`ap_paterno`,con.`ap_materno`,con.`nombre_area`,con.`correo_instu`,con.`movil`,con.`tel_oficina`,db.`id_datBank`,
			b.`nombre_banco`,db.`sucursal`,db.`titular`,db.`no_cuenta`,db.`no_cuenta_interbancario`,tp.`tipo_cuenta`

			FROM datos_fiscales df,clientes c,direcciones d,codigos_postales cp,contactos con,cliente_contacto cc,
			det_bank_cli dbc,datos_bancarios db,bancos b,tipo_cuenta tp,categoria_prov cat,estados es

			WHERE df.`id_datFiscal`= c.`id_datFiscal`
			AND  d.`id_direccion` = c.`id_direccion`
			AND cp.`id_cp` = d.`id_cp`
			AND c.`id_cliente` = cc.`id_cliente`
			AND con.`id_contacto` = cc.`id_contacto`
			AND c.`id_cliente` = dbc.`id_cliente`
			AND db.`id_datBank` = dbc.`id_datBank`
			AND b.`id_banco` = db.`id_banco`
			AND tp.`id_tipo_cuenta` = db.`id_tipo_cuenta`
			AND cat.`id_categoria` = c.`id_categoria`
			AND es.`id_estado` = cp.`id_estado`
			AND c.`id_cliente` = ".$idCli;
			$ejecutarC = mysql_query($consultaC, $this->conexion);
			$Cliente= array();
			$rows = mysql_fetch_assoc($ejecutarC);
			return $rows;
			
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
		
		

		/*id para inserciónpra la tabla det_bank_cli */
		public function iddet_bank()
		{			
			$sql="SELECT id_bank_bcl FROM det_bank_cli ORDER BY id_bank_bcl DESC LIMIT 1";
			$consulta=mysql_query($sql)or die ("Error de Consulta-Increment-detBANK-Cli");
			$filas=mysql_num_rows($consulta);
			
			if($filas==0){
				$cv_detB = 1;
			}else	{
				$cv_detB = mysql_result($consulta,0,'id_bank_bcl');
				$cv_detB = ($cv_detB + 1);
			}
			return $cv_detB;
		}


		//inserta CLIENTE
		 public function addCliente(
             $id_direccion,$calle,$numext,$numint,$colonia,$referencia,$id_cp,$idCli,$nombreCli,$movil,$oficina,$emergencia,$ext,$dirWeb,$catego,$idDatF,$razonS,$rfc,$iddir2,$idcp2,$calle2,$nume2,$numi2,$col2,$ref2)
		{
					
			$calle = mb_strtoupper($calle);			
			$colonia = mb_strtoupper($colonia);			
			$referencia = mb_strtoupper($referencia);
			$nombreCli = mb_strtoupper($nombreCli);

			$activo = 'Si';			
			
			if(strlen($rfc)==12)
			{
				$tipo_ra ="Moral";//moral
			}elseif(strlen($rfc)==13){
				$tipo_ra ="Fisica";//fisica
			}	
			
			 $sqlR = "SELECT * FROM clientes WHERE nombre = '".$nombreCli."'";
			 $ejecutarR =mysql_query($sqlR) or die (mysql_error());				
			 $filasR = mysql_num_rows($ejecutarR);				
					if($filasR!=0){
						echo "<script>  alert ('Este cliente ya se encuentra registrado,favor de verificar')
						window.location='index.php?url=agregarCl';</script>";
					}else{	

			
			$sql1 = "INSERT INTO direcciones VALUES ($id_direccion,'$calle',$numext,$numint,'$colonia','$referencia',$id_cp)";             
         	$ejecutar1 =mysql_query($sql1) or die ("Error insertar-DIRECCION".mysql_error());

	

            $consulta2 = "INSERT INTO direcciones VALUES 
				($iddir2,'$calle2',$nume2,$numi2,'$col2','$ref2',$idcp2)";
    		$ejecutar2 = mysql_query($consulta2,$this->conexion) or die (mysql_error());
            
                        
			$consulta3 = "INSERT INTO datos_fiscales
			VALUES ($idDatF,'$razonS','$rfc','$tipo_ra',$iddir2)";
			$ejecutar3 = mysql_query($consulta3,$this->conexion) or die (mysql_error());	
                        
   			$consulta4 = "INSERT INTO clientes (id_cliente,nombre,t_movil,t_oficina,t_emergencia,extension,direccion_web,id_categoria,id_datFiscal,id_direccion,activo,fecha_alta)
				VALUES (".$idCli.",'".$nombreCli."','".$movil."','".$oficina."','".$emergencia."','".$ext."','".$dirWeb."','".$catego."','".$idDatF."','".$id_direccion."','".$activo."',NOW());";
			$ejecutar4 = mysql_query($consulta4,$this->conexion) or die ("Error en insertar cliente ".mysql_error());
            
		return  $ejecutar1 & $ejecutar2 & $ejecutar3 & $ejecutar4;
                        
			}
		}
	
		
		 /*Funcion para obtener DATOS BANCARIOS que tiene un cliente*/
        public function obtieneDatosBCliente($idcli)
		{            
			$consulta = "SELECT det.`id_datBank`,db.`sucursal`,db.`titular`,b.`nombre_banco`, tp.`tipo_cuenta`
			FROM det_bank_cli det, datos_bancarios db,clientes c,bancos b,tipo_cuenta tp
			WHERE db.`id_datBank` = det.`id_datBank`
			AND c.`id_cliente` = det.`id_cliente`
			AND b.`id_banco` = db.`id_banco`
			AND tp.`id_tipo_cuenta` = db.`id_tipo_cuenta`
			AND c.`id_cliente` = ".$idcli." ORDER BY nombre_banco";
	               
			$ejecutar = mysql_query($consulta, $this->conexion);

			$DatosF= array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$DatosF[] = $rows;
			}
			
			return $DatosF;  
			}
	



        
         /*Funcion para obtener contactos tiene un cliente agregados*/
        public function obtieneContactoCliente($idcli)
		{            
			$consultaC = "SELECT cliente_contacto.`id_cliente`, contactos.*
			FROM contactos
			LEFT JOIN cliente_contacto ON contactos.`id_contacto`=cliente_contacto.`id_contacto`
			WHERE cliente_contacto.`id_cliente`=".$idcli." ORDER BY nombreCon";
	               
			$ejecutarC = mysql_query($consultaC, $this->conexion);

			$Contacto= array();
			while ($rows = mysql_fetch_assoc($ejecutarC)) {
				$Contacto[] = $rows;
			}
			
			return $Contacto;  
			}
		/*Funcion para obtener contactos NO tiene un cliente especifico*/
        
        public function obtieneContactoNoCliente($idcli)
		{          
            $consultaCli = "SELECT id_cliente
			FROM clientes Where id_cliente=$idcli";
                
			$ejecutarCli= mysql_query($consultaCli, $this->conexion);
            
            $Cliente= array();
			while ($rows = mysql_fetch_assoc($ejecutarCli)) {
				$Cliente[] = $rows;
                
			}
        	$consultaC = "SELECT contactos.*
			FROM contactos ORDER BY nombreCon";
                
			$ejecutarC = mysql_query($consultaC, $this->conexion);
            

			$Contacto= array();
			while ($rows = mysql_fetch_assoc($ejecutarC)) {
				$Contacto[] = $Cliente[0] + $rows;
			}
            
            //$Contacto = array_merge($Cliente,$Contact);
            
            return $Contacto;   
        
        }


    	public function remcontactocli($idCon,$idCli)
		{
            
			$consultaC = "DELETE FROM cliente_contacto WHERE id_contacto='$idCon' AND id_cliente='$idCli'";
                
			$ejecutarC = mysql_query($consultaC, $this->conexion) or die (mysql_error());

			}

 		public function addcontactocli($idCon,$idCli)
		{           
			$consultaAdd = "INSERT INTO cliente_contacto(id_cliente,id_contacto) VALUES ($idCli,$idCon)";	

			$ejecutarC = mysql_query($consultaAdd,$this->conexion) or die (mysql_error());
		}

		/*---------------------------------MODIFICAR CLIENTE----------------------------------------------------------*/


		public function comboBUpdate($idCli)
		{
			$consulta = "SELECT c.`id_cliente`,b.`id_banco`,b.`nombre_banco`
			FROM bancos b,clientes c,datos_bancarios db,det_bank_cli dc
			WHERE b.`id_banco` = db.`id_banco`
			AND db.`id_datBank` =dc.`id_datBank`
			AND c.`id_cliente` = dc.`id_cliente`
			AND c.`id_cliente`=".$idCli;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idB = mysql_result($ejecutar, 0, 'id_banco');
				//$banco = mysql_result($ejecutar, 0, 'nombre_banco');
			}
				
			$consulta = "SELECT * FROM bancos WHERE id_banco != ".$idB."";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$comboActuaB= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$comboActuaB[] = $rows;
				}
            
		    	return $comboActuaB;
            }
		}

			public function comboTipoCUpdate($idCli)
		{
			$consulta = "SELECT tc.`id_tipo_cuenta`,tc.`tipo_cuenta`
			FROM tipo_cuenta tc,clientes c,datos_bancarios db,det_bank_cli dc
			WHERE tc.`id_tipo_cuenta` = db.`id_tipo_cuenta`
			AND db.`id_datBank` =dc.`id_datBank`
			AND c.`id_cliente` = dc.`id_cliente`
			AND c.`id_cliente` =".$idCli;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idTC = mysql_result($ejecutar, 0, 'id_tipo_cuenta');
				//$banco = mysql_result($ejecutar, 0, 'nombre_banco');
			}
				
			$consulta = "SELECT * FROM tipo_cuenta WHERE id_tipo_cuenta != ".$idTC."";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$comboActuaTC= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$comboActuaTC[] = $rows;
				}
            
		    	return $comboActuaTC;
            }
		}


		public function comboCategoCliente($idCli)
		{
			$consulta = "SELECT c.`id_cliente`,cap.`id_categoria`,cap.`categoria`
			FROM categoria_prov cap,clientes c
			WHERE cap.`id_categoria` = c.`id_categoria`
			AND c.`id_cliente`= ".$idCli;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idCaP = mysql_result($ejecutar, 0, 'id_categoria');
			}
				
			$consulta = "SELECT * FROM categoria_prov WHERE id_categoria != ".$idCaP."";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$comboActuaCat= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$comboActuaCat[] = $rows;
				}
            
		    	return $comboActuaCat;
            }
		}
	

		public function obtenerCPUpdate($idCli)
		{
			$consulta = "SELECT cp.`id_cp`,cp.`codigoP`
			FROM codigos_postales cp, direcciones d, clientes c
			WHERE cp.`id_cp` = d.`id_cp`
			AND d.`id_direccion` = c.`id_direccion`
			AND c.`id_cliente` = ".$idCli;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idCP = mysql_result($ejecutar, 0, 'id_cp');
				$CP = mysql_result($ejecutar, 0, 'codigoP');
			}
				
			$consulta1 = "SELECT * FROM codigos_postales WHERE codigoP = ".$CP." AND id_cp != ".$idCP." ORDER BY localidad";
			$ejecutar1 = mysql_query($consulta1, $this->conexion) or die (mysql_error());
			$filas1 = mysql_num_rows($ejecutar1);
		
            if($filas1 != 0){
            	$codigoPostal= array();
            	while ($rows = mysql_fetch_assoc($ejecutar1)) {
					$codigosPostales[] = $rows;
				}
            
		    	return $codigosPostales;
            }
		}
		
























			//---------------------------------------------------------------------------------------------------------------
			/*------------------------------------------------FAMILIA-------------------------------------------------------*/
			/*Consulta para el listado de familias*/
		public function obtieneFamilias()
		{
			$consultaF = "SELECT *	FROM familia ORDER BY id_fam";
			$ejecutarF = mysql_query($consultaF, $this->conexion);

			$familia = array();
			while ($rows = mysql_fetch_assoc($ejecutarF)) {
				$familia[] = $rows;
			}
			
			return $familia;  
			}

		/*Consulta para el detalle_ Cliente*/
		public function obtieneVFamilia($cv_fam)
		{
			$cv_fam = htmlspecialchars($cv_fam);
			$consultaF = "SELECT * FROM  familia WHERE  id_fam = ".$cv_fam;
			$ejecutarF = mysql_query($consultaF, $this->conexion);
			$familia= array();
			$rows = mysql_fetch_assoc($ejecutarF);
			return $rows;
		}
		//elimiancion de familia
		public function elimFamilia($del_fam)
		{		
		/*$band = 0;
			if ($band==0) {
				
				$sql = "SELECT p.`id_fam` FROM familia f, productos p	WHERE f.`id_fam` = p.`id_fam` AND p.`id_fam`= $del_fam";				
				$ejecutar =mysql_query($sql) or die (mysql_error());				
				$filas = mysql_num_rows($ejecutar);				
				if($filas!=0){
					$band =1;
						$sqlDesF = "UPDATE `familia` SET  `activo` = 'No' WHERE `id_fam` = $del_fam";
						$ejecutarDesF = mysql_query($sqlDesF) or die (mysql_error());
						echo" <script> alert('El registro no puede ser eliminado, solo se desactivo') 
						window.location='index.php?url=listaFam';
				 		</script> ";

						}else{*/
			
			$sqlElF = "DELETE FROM familia WHERE id_fam = $del_fam ";
			$ejecutarElF = mysql_query($sqlElF) or die (mysql_error());
			echo" <script> alert('El registro ha sido eliminado correctamente') 
				window.location='index.php?url=listaFam';
			</script> ";

		/*	}
		}*/
	}

		/*Busqueda por criterio(id_fam,nombre_fam y estatus)*/
		public function busquedaF($busqueda)
		{
		$busqueda = htmlspecialchars($busqueda);
         $sql = "SELECT * FROM familia WHERE nombre_fam LIKE '%".$busqueda."%' OR activo LIKE '%".$busqueda."%' OR id_fam LIKE '%".$busqueda."%'";
         $result = mysql_query($sql, $this->conexion);
         $familia_result = array();
         while ($row = mysql_fetch_assoc($result))
         {
             $familia_result[] = $row;
         }
         return $familia_result;
		 }


		//obtiene id_familia para inserción
		public function incrementoFam()
		{			
			$sql="SELECT id_fam FROM familia ORDER BY id_fam DESC LIMIT 1";
			$consulta=mysql_query($sql)or die ("Error de Consulta-Increment-Fam");
			$filas=mysql_num_rows($consulta);			
			if($filas==0){
				$cv_fam = 1;
			}else	{
				$cv_fam = mysql_result($consulta,0,'id_fam');
				$cv_fam = ($cv_fam + 1);
			}
			return $cv_fam;
		}

		 public function addFamilia($idFam,$nombreF/*,$activo*/)
		 {
		 $nombreF = htmlspecialchars($nombreF);
		 $nombreF = mb_strtoupper($nombreF);
		 $activo ='Si';
         $sql = "SELECT * FROM familia WHERE nombre_fam = '".$nombreF."'";
		 $ejecutar =mysql_query($sql) or die (mysql_error());				
		 $filas = mysql_num_rows($ejecutar);				
				if($filas!=0){
				    echo "<script>  alert ('Esta familia ya se encuentra registrada,favor de verificar')
				    window.location='index.php?url=listaFam';</script>";
				}else{		       
			$consulta1 = "INSERT INTO familia (id_fam,nombre_fam,activo) 
								VALUES(".$idFam.",'".$nombreF."','".$activo."')";
			$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en insertar familia".mysql_error());
			echo" <script> 
						window.location='index.php?url=listaFam';
				 	</script> ";
				 	/*echo"<h1 align='center'>La familia ha sido registrada correctamente</h1><br>
	 				<center><a href='index.php?url=listaFam'><img src='images/bien.png' class='img-responsive' title='regresar'></center>
	 				<script> window.location='index.php?url=listaFam';
				 	</script> ";*/
	 				
		}

}

		 public function modiFam($mod_fam,$nombre_fam,$activo)
		 {
			 $nombre_fam = mb_strtoupper($nombre_fam);
			 $sql = "SELECT * FROM familia WHERE nombre_fam = '".$nombre_fam."'";
			 $ejecutar =mysql_query($sql) or die (mysql_error());				
			 $filas = mysql_num_rows($ejecutar);				
				if($filas!=0){
					$consulta1 = "UPDATE familia SET activo ='$activo' WHERE  id_fam = $mod_fam";	
					$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en modificar familia".mysql_error());
				    echo "<script>  alert ('Error: Esta familia ya se encuentra registrada, favor de verificar')
				    window.location='index.php?url=listaFam';</script>";
				}else{						
					$consulta1 = "UPDATE familia SET nombre_fam ='$nombre_fam',activo = '$activo' WHERE id_fam = $mod_fam";								
					$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en modificar familia".mysql_error());
					echo" <script> alert('El registro ha sido modificado correctamente') 
						window.location='index.php?url=listaFam';
				 	</script> ";
				}

		}

		//---------------------------------------------------------------------------------------------------------------
		/*------------------------------------------------MARCA-------------------------------------------------------*/
		/*Consulta para el listado de familias*/
		public function obtieneMarcas()
		{
			$consultaM = "SELECT *	FROM marca ORDER BY id_marca";
			$ejecutarM = mysql_query($consultaM, $this->conexion);

			$marca = array();
			while ($rows = mysql_fetch_assoc($ejecutarM)) {
				$marca[] = $rows;
			}
			
			return $marca;  
			}

		/*Consulta para el detalle_ Cliente*/
		public function obtieneVmarca($cv_marca)
		{
			$cv_marca = htmlspecialchars($cv_marca);
			$consultaM = "SELECT * FROM  marca WHERE  id_marca = ".$cv_marca;
			$ejecutarM = mysql_query($consultaM, $this->conexion);
			$marca= array();
			$rows = mysql_fetch_assoc($ejecutarM);
			return $rows;
		}

			//elimianción de marca
		public function elimMarca($del_mar)
		{		
		/*$band = 0;
			if ($band==0) {
				
				$sql = "SELECT p.`id_marca` FROM marca m, productos p WHERE m.`id_marca` = p.`id_marca` AND p.`id_marca`= $del_mar";				
				$ejecutar =mysql_query($sql) or die (mysql_error());				
				$filas = mysql_num_rows($ejecutar);				
				if($filas!=0){
					$band =1;
						$sqlDesM = "UPDATE `marca` SET  `activo` = 'No' WHERE `id_marca` = $del_mar";
						$ejecutarDesM = mysql_query($sqlDesM) or die (mysql_error());
						echo" <script> alert('El registro no puede ser eliminado, solo se desactivo') 
						window.location='index.php?url=listaMarca';
				 		</script> ";

						}else{*/
			
			$sqlElM = "DELETE FROM marca WHERE id_marca = $del_mar ";
			$ejecutarElM = mysql_query($sqlElM) or die (mysql_error());
			echo" <script> alert('El registro ha sido eliminado correctamente') 
				window.location='index.php?url=listaMarca';
			</script> ";

				/*}
			}*/
		}

		/*Busqueda por criterio(id_marca,nombre_marca y activo)*/
		public function busquedaM($busqueda)
		{
		$busqueda = htmlspecialchars($busqueda);
         $sql = "SELECT * FROM marca WHERE id_marca LIKE '%".$busqueda."%' OR nombre_marca LIKE '%".$busqueda."%' OR activo LIKE '%".$busqueda."%'";
         $result = mysql_query($sql, $this->conexion);
         $marca_result = array();
         while ($row = mysql_fetch_assoc($result))
         {
             $marca_result[] = $row;
         }
         return $marca_result;
		 }


		//obtiene id nueva para para inserción_marca
		public function incrementoMarca()
		{			
			$sql="SELECT id_marca FROM marca ORDER BY id_marca DESC LIMIT 1";
			$consulta=mysql_query($sql)or die ("Error de Consulta-Increment-Marca");
			$filas=mysql_num_rows($consulta);
			
			if($filas==0){
				$cv_mar = 1;
			}else	{
				$cv_mar = mysql_result($consulta,0,'id_marca');
				$cv_mar = ($cv_mar + 1);
			}
			return $cv_mar;
		}

		//Funcion para insertar la nueva marca
        public function addMarca($idMarca,$nombreM/*,$activo*/)
		{			
			 $nombreM = htmlspecialchars($nombreM);
			 $nombreM = mb_strtoupper($nombreM);
			 $activo = 'Si';
			 $sql = "SELECT * FROM marca WHERE nombre_marca = '".$nombreM."'";
			 $ejecutar =mysql_query($sql) or die (mysql_error());				
			 $filas = mysql_num_rows($ejecutar);				
					if($filas!=0){
						echo "<script>  alert ('Esta marca ya se encuentra registrada,favor de verificar')
						window.location='index.php?url=listaMarca';</script>";
					}else{		
			 $sql = "INSERT INTO marca VALUES ('$idMarca','$nombreM','$activo')";				
			 $ejecutar =mysql_query($sql) or die (mysql_error());
			 echo" <script> 
						window.location='index.php?url=listaMarca';
				 	</script> ";
			 /*echo" <script> alert('El registro ha sido ingresado correctamente') 
						window.location='index.php?url=listaMarca';
				 	</script> ";	*/
			/*echo"<h1 align='center'>La marca ha sido registrada correctamente</h1><br>
	 				<center><a href='index.php?url=listaMarca'><img src='images/bien.png' class='img-responsive' title='regresar'></center>";*/
			}
		}
       /*modificar Marca*/
	    public function modiMarca($mod_marca,$nombre_marca,$activo)
		 {
			 $nombre_marca = mb_strtoupper($nombre_marca);
			 $sql = "SELECT * FROM marca WHERE nombre_marca = '".$nombre_marca."'";
			 $ejecutar =mysql_query($sql) or die (mysql_error());				
			 $filas = mysql_num_rows($ejecutar);				
				if($filas!=0){
					$consulta1 = "UPDATE marca SET activo ='$activo' WHERE id_marca = $mod_marca";								
					$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en modificar----marca".mysql_error());				
				    echo "<script>  alert ('Error: Esta marca ya se encuentra registrada, favor de verificar')
				    window.location='index.php?url=listaMarca';</script>";
				}else{						
			$consulta1 = "UPDATE marca SET nombre_marca ='$nombre_marca',activo = '$activo' WHERE id_marca = $mod_marca";								
			$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en modificar----marca".mysql_error());
			echo" <script> alert('El registro ha sido modificado correctamente') 
						window.location='index.php?url=listaMarca';
				 	</script> ";
				}

		}

		//---------------------------------------------------------------------------------------------------------------
		/*------------------------------------------------LINEA-------------------------------------------------------*/
		/*Consulta para el listado de Lineas*/
		public function obtieneLineas()
		{
			$consultaL = "SELECT *	FROM linea ORDER BY id_linea";
			$ejecutarL = mysql_query($consultaL, $this->conexion);

			$linea = array();
			while ($rows = mysql_fetch_assoc($ejecutarL)) {
				$linea[] = $rows;
			}
			
			return $linea;  
			}

			 /*Consulta para el detalle_Linea*/
		public function obtieneVLinea($cv_linea)
		{
			$cv_linea = htmlspecialchars($cv_linea);
			$consultaL = "SELECT * FROM linea WHERE id_linea = ".$cv_linea;
			$ejecutarL = mysql_query($consultaL, $this->conexion);
			$linea= array();
			$rows = mysql_fetch_assoc($ejecutarL);
			return $rows;
		}
      		/*id para inserción */
		public function incrementoLinea()
		{			
			$sql="SELECT id_linea FROM linea ORDER BY id_linea DESC LIMIT 1";
			$consulta=mysql_query($sql)or die ("Error de Consulta-Incremento-Linea");
			$filas=mysql_num_rows($consulta);
			
			if($filas==0){
				$cv_linea = 1;
			}else	{
				$cv_linea = mysql_result($consulta,0,'id_linea');
				$cv_linea = ($cv_linea + 1);
			}
			return $cv_linea;
		}
				
		 public function addLinea($idLinea,$nombreL/*,$activo*/)
		 {
		 $nombreL = htmlspecialchars($nombreL);
		 $nombreL = mb_strtoupper($nombreL);
		 $activo ='Si';
         $sql = "SELECT * FROM linea WHERE nombre_linea = '".$nombreL."'";
		 $ejecutar =mysql_query($sql) or die (mysql_error());				
		 $filas = mysql_num_rows($ejecutar);				
				if($filas!=0){
				    echo "<script>  alert ('Esta linea ya se encuentra registrada,favor de verificar')
				    window.location='index.php?url=agregarFam';</script>";
				}else{		       
			$consulta1 = "INSERT INTO linea (id_linea,nombre_linea,activo) 
								VALUES(".$idLinea.",'".$nombreL."','".$activo."')";
			$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en insertar linea".mysql_error());
			/*echo" <script> alert('El registro ha sido ingresado correctamente') 
						window.location='index.php?url=listaLinea';
				 	</script> ";*/
			echo" <script> 
						window.location='index.php?url=listaLinea';
				 	</script> ";
		}

	}
	
			
       
		/*modificar linea*/
	    public function modiLinea($mod_linea,$nombre_linea,$activo)
		 {
			 $nombre_linea = mb_strtoupper($nombre_linea);
			 $sql = "SELECT * FROM linea WHERE nombre_linea = '".$nombre_linea."'";
			 $ejecutar =mysql_query($sql) or die (mysql_error());				
			 $filas = mysql_num_rows($ejecutar);				
				if($filas!=0){
					$consulta1 = "UPDATE linea SET activo ='$activo' WHERE id_linea = $mod_linea";								
					$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en modificar----linea".mysql_error());				
				    echo "<script>  alert ('Error: Esta linea ya se encuentra registrada, favor de verificar')
				    window.location='index.php?url=listaLinea';</script>";
				}else{						
			$consulta1 = "UPDATE linea SET nombre_linea ='$nombre_linea',activo = '$activo' WHERE id_linea = $mod_linea";								
			$ejecutar1 = mysql_query($consulta1,$this->conexion) or die ("Error en modificar----linea".mysql_error());
			echo" <script> alert('El registro ha sido modificado correctamente') 
						window.location='index.php?url=listaLinea';
				 	</script> ";
				}

		}



		//elimiancion de linea
		public function eliminaLinea($del_linea)
		{		
		/*$band = 0;
			if ($band==0) {
				
				$sql = "SELECT dbc.`id_cliente`,dbc.`id_bank_bcl`,dbc.`id_datBank`
				FROM  clientes c,det_bank_cli dbc
				WHERE c.`id_cliente`= dbc.`id_cliente`
				AND dbc.`id_cliente`  = $del_fam";				
				$ejecutar =mysql_query($sql) or die (mysql_error());				
				$filas = mysql_num_rows($ejecutar);				
				if($filas!=0){
					$band =1;
						$sqlDesF = "UPDATE `familia` SET  `activo` = 'No' WHERE `id_fam` = $del_fam";
						$ejecutarDesF = mysql_query($sqlDesF) or die (mysql_error());
						echo" <script> alert('El registro no puede ser eliminado, solo se desactivo') 
						window.location='index.php?url=listaFam';
				 		</script> ";

						}else{*/
			
			$sqlElL = "DELETE FROM linea WHERE id_linea = $del_linea ";
			$ejecutarElL = mysql_query($sqlElL) or die (mysql_error());
			echo" <script> alert('El registro ha sido eliminado correctamente') 
				window.location='index.php?url=listaLinea';
			</script> ";

			/*	}
			}*/
		}


	/*--------------------------------PRODUCTOS------------------------------------------------*/

		/*id para inserción */
		public function incrementoProd()
		{			
			$sql="SELECT id_producto FROM productos ORDER BY id_producto DESC LIMIT 1";
			$consulta=mysql_query($sql)or die ("Error de Consulta-Incremento-Produc");
			$filas=mysql_num_rows($consulta);
			
			if($filas==0){
				$cv_prod = 1;
			}else	{
				$cv_prod = mysql_result($consulta,0,'id_producto');
				$cv_prod = ($cv_prod + 1);
			}
			return $cv_prod;
		}

		//combo dinamico para tipo de marcas z
		public function obtieneMarcasCombo()
    	{
    		$sql3 = "SELECT * FROM marca";
			$ejecutar = mysql_query($sql3)or die ("Error de Consulta-marcasCombo");
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
			$comboMar = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$comboMar[] = $rows;
			}
			
			return $comboMar;
			}
		}
		
		//combo dinamico para tipo de familia 
		public function obtieneFamiliasCombo()
    	{
    		$sql3 = "SELECT * FROM familia";
			$ejecutar = mysql_query($sql3)or die ("Error de Consulta-familiasCombo");
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
			$comboFam = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$comboFam[] = $rows;
			}
			
			return $comboFam;
			}
		}

		//combo dinamico para tipo de linea 
		public function obtieneLineasCombo()
    	{
    		$sql3 = "SELECT * FROM linea";
			$ejecutar = mysql_query($sql3)or die ("Error de Consulta-lineasCombo");
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
			$comboLin = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$comboLin[] = $rows;
			}
			
			return $comboLin;
			}
		}
		
		

		//combo dinamico para unidad de medida 
		public function obtieneUnidad()
    	{
    		$sql3 = "SELECT * FROM unidad ORDER BY unidad";
			$ejecutar = mysql_query($sql3)or die ("Error de Consulta-UnidadCombo");
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
			$comboUni = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$comboUni[] = $rows;
			}
			
			return $comboUni;
			}
		}
		
	
			
		//combo dinamico para Tipo_prod
		public function obtieneTProd()
    	{
    		$sql3 = "SELECT * FROM tipo_prod ORDER BY tipo_prod";
			$ejecutar = mysql_query($sql3)or die ("Error de Consulta-TipoProdCombo");
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
			$comboTProd = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$comboTProd[] = $rows;
			}
			
			return $comboTProd;
			}
		}

			public function obtieneSubcatego()
    	{
    		$sql3 = "SELECT * FROM subcategoria ORDER BY subcategoria";
			$ejecutar = mysql_query($sql3)or die ("Error de Consulta-SubCatCombo");
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
			$comboSubcat = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$comboSubcat[] = $rows;
			}
			
			return $comboSubcat;
			}
		}



		//combo dinamico para proveedores
		public function obtieneProvCombo()
    	{
    		$sql3 = "SELECT * FROM proveedores";
			$ejecutar = mysql_query($sql3)or die ("Error de Consulta-ProvCombo");
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
			$comboP = array();
			while ($rows = mysql_fetch_assoc($ejecutar)) {
				$comboP[] = $rows;
			}
			
			return $comboP;
			}
		}
		


		//inserta Productos
		 public function addProd($idP,$producto,$modelo,$marca,$fam,$linea,$subC,$tipo,$unidad,$idProv,$existencia,$desc,$precioU)
		{
					
			$producto = mb_strtoupper($producto);	
			$desc = htmlspecialchars($desc);		
			$desc = mb_strtoupper($desc);	


			/* $sqlR = "SELECT * FROM clientes WHERE nombre = '".$nombreCli."'";
			 $ejecutarR =mysql_query($sqlR) or die (mysql_error());				
			 $filasR = mysql_num_rows($ejecutarR);				
					if($filasR!=0){
						echo "<script>  alert ('Este cliente ya se encuentra registrado,favor de verificar')
						window.location='index.php?url=agregarCl';</script>";
					}else{	*/

			$consulta0 = "INSERT INTO productos(id_producto,nombre_producto,modelo,id_marca,id_fam,id_linea,id_subCat,id_tipoProd,id_unidad,id_prov,existencia,descripcion,precio_unitario)
			VALUES ('".$idP."','".$producto."','".$modelo."','".$marca."','".$fam."','".$linea."','".$subC."','".$tipo."','".$unidad."','".$idProv."','".$existencia."','".$desc."','".$precioU."')";
			$ejecutar0 = mysql_query($consulta0,$this->conexion) or die (mysql_error());
		
			//return  $ejecutar0;
			echo "<script>  alert ('El producto ha sido registrado correctamente')
						window.location='index.php?url=listaProducto';</script>";
				
			/*}*/
		}


		/*Consulta para el listado de clientes*/
		public function obtieneProductos()
		{
			$consultaP = "SELECT p.`id_producto`,p.`nombre_producto`,p.`modelo`,m.`nombre_marca`,f.`nombre_fam`,l.`nombre_linea`,sc.`subcategoria`,tp.`tipo_prod`,u.`unidad`,
			p.`existencia`,p.`descripcion`
			FROM productos p, marca m, familia f, linea l,unidad u,subcategoria sc,tipo_prod tp
			WHERE m.`id_marca` = p.`id_marca`
			AND f.`id_fam` = p.`id_fam`
			AND l.`id_linea` = p.`id_linea`
			AND u.`id_unidad` = p.`id_unidad`
			AND sc.`id_subCat` = p.`id_subCat`
			AND tp.`id_tipoProd` = p.`id_tipoProd`
			ORDER BY p.`nombre_producto`";
			$ejecutarP = mysql_query($consultaP, $this->conexion);

			$Productos = array();
			while ($rows = mysql_fetch_assoc($ejecutarP)) {
				$Productos[] = $rows;
			}
			
			return $Productos;  
			}


			/*Consulta para el detalle_Producto*/
		public function  obtieneVProducto($cv_producto)
		{
			$cv_producto = htmlspecialchars($cv_producto);
			$consultaP = "SELECT p.`id_producto`,p.`nombre_producto`,p.`modelo`,p.`descripcion`,p.`precio_unitario`,m.`id_marca`,m.`nombre_marca`,f.`id_fam`,f.`nombre_fam`,l.`id_linea`,l.`nombre_linea`,
			u.`id_unidad`,u.`unidad`,sc.`id_subCat`,sc.`subcategoria`,tp.`id_tipoProd`,tp.`tipo_prod`,p.`existencia`,prov.`id_prov`,prov.`proveedor`
			FROM productos p, marca m, familia f, linea l,unidad u,subcategoria sc,tipo_prod tp,proveedores prov
			WHERE m.`id_marca` = p.`id_marca`
			AND f.`id_fam` = p.`id_fam`
			AND l.`id_linea` = p.`id_linea`
			AND u.`id_unidad` = p.`id_unidad`
			AND sc.`id_subCat` = p.`id_subCat`
			AND tp.`id_tipoProd` = p.`id_tipoProd`
			AND prov.`id_prov` = p.`id_prov`
			AND p.`id_producto` = ".$cv_producto;
			$ejecutarP = mysql_query($consultaP, $this->conexion);
			$Producto= array();
			$rows = mysql_fetch_assoc($ejecutarP);
			return $rows;
			
		}

	/*combos para modProd*/
		public function comboMUpdate($cv_producto)
		{
			$consulta = "SELECT m.`id_marca`,m.`nombre_marca`
			FROM productos p,marca m
			WHERE m.`id_marca` = p.`id_marca`
			AND p.`id_producto` = ".$cv_producto;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idM = mysql_result($ejecutar, 0, 'id_marca');
				//$marca = mysql_result($ejecutar, 0, 'nombre_marca');
			}
				
			$consulta = "SELECT * FROM marca WHERE id_marca != ".$idM."";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$comboActuaMar= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$comboActuaMar[] = $rows;
				}
            
		    	return $comboActuaMar;
            }
		}

		
		public function comboCatUpdate($cv_producto)
		{
			$consulta = "SELECT f.`id_fam`,f.`nombre_fam`
			FROM productos p,familia f
			WHERE f.`id_fam`= p.`id_fam`
			AND p.`id_producto` = ".$cv_producto;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idFam = mysql_result($ejecutar, 0, 'id_fam');
				//$marca = mysql_result($ejecutar, 0, 'nombre_marca');
			}
				
			$consulta = "SELECT * FROM familia WHERE id_fam != ".$idFam."";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$comboActuaFa= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$comboActuaFa[] = $rows;
				}
            
		    	return $comboActuaFa;
            }
		}

		public function comboLinUpdate($cv_producto)
		{
			$consulta = "SELECT l.`id_linea`,l.`nombre_linea`
			FROM productos p,linea l
			WHERE l.`id_linea`= p.`id_linea`
			AND p.`id_producto`= ".$cv_producto;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idLin = mysql_result($ejecutar, 0, 'id_linea');
				//$marca = mysql_result($ejecutar, 0, 'nombre_marca');
			}
				
			$consulta = "SELECT * FROM linea WHERE id_linea != ".$idLin."";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$comboActuaLin= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$comboActuaLin[] = $rows;
				}
            
		    	return $comboActuaLin;
            }
		}


		public function comboSubCUpdate($cv_producto)
		{
			$consulta = "SELECT sub.`id_subCat`,sub.`subcategoria`
			FROM productos p,subcategoria sub
			WHERE sub.`id_subCat` = p.`id_subCat`
			AND p.`id_producto`= ".$cv_producto;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idSub = mysql_result($ejecutar, 0, 'id_subCat');
				//$marca = mysql_result($ejecutar, 0, 'nombre_marca');
			}
				
			$consulta = "SELECT * FROM subcategoria WHERE id_subCat != ".$idSub."";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$comboActuaSub= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$comboActuaSub[] = $rows;
				}
            
		    	return $comboActuaSub;
            }
		}

		public function comboTipoProd($cv_producto)
		{
			$consulta = "SELECT tp.`id_tipoProd`,tp.`tipo_prod`
			FROM productos p,tipo_prod tp
			WHERE tp.`id_tipoProd` = p.`id_tipoProd`
			AND p.`id_producto` = ".$cv_producto;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idTP = mysql_result($ejecutar, 0, 'id_tipoProd');
				//$marca = mysql_result($ejecutar, 0, 'nombre_marca');
			}
				
			$consulta = "SELECT * FROM tipo_prod WHERE id_tipoProd != ".$idTP."";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$comboActuaTP= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$comboActuaTP[] = $rows;
				}
            
		    	return $comboActuaTP;
            }
		}

		public function comboUnidadUp($cv_producto)
		{
			$consulta = "SELECT u.`id_unidad`,u.`unidad`
			FROM productos p,unidad u
			WHERE u.`id_unidad` = p.`id_unidad`
			AND p.`id_producto` = ".$cv_producto;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idUni = mysql_result($ejecutar, 0, 'id_unidad');
				//$marca = mysql_result($ejecutar, 0, 'nombre_marca');
			}
				
			$consulta = "SELECT * FROM unidad WHERE id_unidad != ".$idUni."";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$comboActuaUni= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$comboActuaUni[] = $rows;
				}
            
		    	return $comboActuaUni;
            }
		}

		public function comboProvUpdate($cv_producto)
		{
			$consulta = "SELECT prov.`id_prov`,prov.`proveedor`
			FROM productos p,proveedores prov
			WHERE prov.`id_prov` = p.`id_prov`
			AND p.`id_producto` = ".$cv_producto;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idProv = mysql_result($ejecutar, 0, 'id_prov');
				//$marca = mysql_result($ejecutar, 0, 'nombre_marca');
			}
				
			$consulta = "SELECT * FROM proveedores WHERE id_prov != ".$idProv."";
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
		
            if($filas != 0){
            	$comboActuaPr= array();
            	while ($rows = mysql_fetch_assoc($ejecutar)) {
					$comboActuaPr[] = $rows;
				}
            
		    	return $comboActuaPr;
            }
		}

				/*MODIFICAR PRODUCTO*/

		public function UpdateProducto($idProd,$producto,$modelo,$idM,$idF,$idLinea,$idSub,$idTP,$idUni,$idProv,
							$existencia,$descripcion,$precioU)
		{

			$sql0 = "UPDATE productos
				SET `nombre_producto` = '".$producto."',`modelo` = '".$modelo."',`id_marca` = '".$idM."',
			  `id_fam` = '".$idF."',`id_linea` = '".$idLinea."',`id_subCat` = '".$idSub."',`id_tipoProd` = '".$idTP."',`id_unidad` = '".$idUni."',
			  `id_prov` = '".$idProv."',`existencia` = '".$existencia."',`descripcion` = '".$descripcion."',`precio_unitario` = '".$precioU."'
			  WHERE `id_producto` =".$idProd.";"; 
							
			$ejecutar0 = mysql_query($sql0) or die("Error al actualizar datos productos".mysql_error());

		
			return $sql0 ;
		}



		public function UpdateCliente($idCli,$nombreCli,$movil,$oficina,$emergencia,$ext,$dirWeb,$catego,$activo,$idDatF,$razonS,$rfc)
		{

			
			if(strlen($rfc)==12)
			{
				$tipo_ra ="Moral";//moral
			}elseif(strlen($rfc)==13){
				$tipo_ra ="Fisica";//fisica
			}	

			$sql0 = "UPDATE `clientes`
			SET `nombre` =  '".$nombreCli."',`t_movil` =  '".$movil."',`t_oficina` =  '".$oficina."',
		   `t_emergencia` =  '".$emergencia."',`extension` =  '".$ext."',`direccion_web` =  '".$dirWeb."',`id_categoria` =  '".$catego."',
		   `activo` =  '".$activo."' WHERE `id_cliente` = ".$idCli.";";
			$ejecutar0 = mysql_query($sql0) or die("Error al actualizar datos cliente".mysql_error());


			$sql1 = "UPDATE `datos_fiscales`
			SET `razon_social` = '".$razonS."',`rfc` = '".$rfc."',`tipo_ra` = '".$tipo_ra."' WHERE `id_datFiscal` = ".$idDatF.";";

			$ejecutar1 = mysql_query($sql1) or die("Error al actualizar datos fiscales".mysql_error());


			return $ejecutar0 && $ejecutar1;
		}

	public function obtenerEstadoUpdate($idCli)
		{
			$consulta = "SELECT c.`id_cliente`,d.`id_direccion`,es.`id_estado`,es.`estado`
			FROM clientes c,direcciones d,codigos_postales cp,estados es
			WHERE d.`id_direccion` = c.`id_direccion`
			AND cp.`id_cp` = d.`id_cp`
			AND es.`id_estado` = cp.`id_estado`
			AND c.`id_cliente` = ".$idCli;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$idState = mysql_result($ejecutar, 0, 'id_estado');
				$State = mysql_result($ejecutar, 0, 'estado');
			}
				
			$consulta1 = "SELECT * FROM estados WHERE id_estado != ".$idState." ORDER BY estado";
			$ejecutar1 = mysql_query($consulta1, $this->conexion) or die (mysql_error());
			$filas1 = mysql_num_rows($ejecutar1);
		
            if($filas1 != 0){
            	$estados= array();
            	while ($rows = mysql_fetch_assoc($ejecutar1)) {
					$estados[] = $rows;
				}
            
		    	return $estados;
            }
		}


		public function obtenerMuniUpdate($idCli)
		{
			$consulta = "SELECT c.`id_cliente`,d.`id_direccion`,cp.`municipio`
			FROM clientes c, direcciones d, codigos_postales cp
			WHERE d.`id_direccion` = c.`id_direccion`
			AND cp.`id_cp` = d.`id_cp`
			AND c.`id_cliente` =".$idCli;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$munici = mysql_result($ejecutar, 0, 'municipio');
				
			}
				
			$consulta1 = "SELECT * FROM codigos_postales WHERE municipio != '".$munici."' ORDER BY municipio";
			$ejecutar1 = mysql_query($consulta1, $this->conexion) or die (mysql_error());
			$filas1 = mysql_num_rows($ejecutar1);
		
            if($filas1 != 0){
            	$estados= array();
            	while ($rows = mysql_fetch_assoc($ejecutar1)) {
					$estados[] = $rows;
				}
            
		    	return $estados;
            }
		}


		public function obtenerLocalidadUpdate($idCli)
		{
			$consulta = "SELECT c.`id_cliente`,d.`id_direccion`,cp.`localidad`
			FROM clientes c, direcciones d, codigos_postales cp
			WHERE d.`id_direccion` = c.`id_direccion`
			AND cp.`id_cp` = d.`id_cp`
			AND c.`id_cliente` = ".$idCli;
			$ejecutar = mysql_query($consulta, $this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			if ($filas != 0) {
				$loca = mysql_result($ejecutar, 0, 'localidad');
			}
				
			$consulta1 = "SELECT * FROM codigos_postales WHERE localidad != ".$loca." ORDER BY localidad";
			$ejecutar1 = mysql_query($consulta1, $this->conexion) or die (mysql_error());
			$filas1 = mysql_num_rows($ejecutar1);
		
            if($filas1 != 0){
            	$localidades= array();
            	while ($rows = mysql_fetch_assoc($ejecutar1)) {
					$localidades[] = $rows;
				}
            
		    	return $localidades;
            }
		}

	//---------------------------------------PROVEEDORES-----------------------------------------------------

		public function obtenerProveedores()
		{
			$sqlPro = " SELECT pro.id_prov, pro.proveedor, datf.razon_social, datf.rfc, catprov.categoria, pro.tel, pro.dirweb,cp.municipio
						FROM proveedores pro, datos_fiscales datf, codigos_postales cp, direcciones dir, categoria_prov catprov
						WHERE datf.id_datFiscal=pro.id_datFiscaL
						AND cp.id_cp=dir.id_cp
						AND dir.id_direccion=pro.id_direccion
						AND catprov.id_categoria=pro.id_categoria
						AND pro.activo = 'si'
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
			//cambiar consulta por cambio tipo de razon
			$sqldetPro = "SELECT pro.id_prov, pro.proveedor, pro.tel, pro.dirweb, 
							       ctepro.id_categoria,ctepro.categoria,
							       datf.id_datFiscal,datf.razon_social, datf.rfc, datf.tipo_ra,
							       cp.codigoP, cp.localidad, cp.municipio, 
							       sta.estado,
							       dir.id_direccion,dir.calle,dir.num_ext,dir.num_int,dir.colonia,dir.referencia,dir.id_cp,
							       bank.id_banco,bank.nombre_banco,
							       datbank.id_datBank,datbank.sucursal,datbank.titular,datbank.no_cuenta,datbank.no_cuenta_interbancario,
							       tcuenta.id_tipo_cuenta,tcuenta.tipo_cuenta,
							       cont.nombreCon,cont.ap_paterno,cont.ap_materno,cont.nombre_area,cont.movil,
							       cont.tel_oficina,cont.tel_emergencia,cont.correo_p,cont.correo_instu,
							       cont.facebook,cont.twitter,cont.skype,cont.direccion_web
							FROM proveedores pro, 
							     categoria_prov ctepro,
							     datos_fiscales datf, 
							     codigos_postales cp,
							     estados sta, 
							     direcciones dir,
							     bancos bank,
							     datos_bancarios datbank,
							     tipo_cuenta tcuenta,
							     det_bank_prov dtbapro,
							     contactos cont,
							     proveedores_contacto procont
							WHERE pro.id_prov = ".$idProv."
							AND ctepro.id_categoria=pro.id_categoria
							AND datf.id_datFiscal=pro.id_datFiscaL
							AND cp.id_cp=dir.id_cp
							AND sta.id_estado=cp.id_estado
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

		public function obtCategoriaUpdate($idPro)
		{
			$sqlCatPro = "SELECT catpro.id_categoria, catpro.categoria
						  FROM categoria_prov catpro, proveedores prov
						  WHERE  catpro.id_categoria = prov.id_categoria
						  AND prov.id_prov = ".$idPro;
			$ejecutar_sqlCatPro = mysql_query($sqlCatPro, $this->conexion) or die("Error de consulta categoria-proveedores".mysql_error());
			
			$rows1 = mysql_num_rows($ejecutar_sqlCatPro);
			
			if ($rows1 != 0) {

				$idcat = mysql_result($ejecutar_sqlCatPro, 0, 'id_categoria');
			}

			$sqlCateg = "SELECT categoria,id_categoria
						 FROM categoria_prov
						 WHERE id_categoria != ".$idcat."
						 ORDER BY categoria";
			$ejecutar_sqlCateg = mysql_query($sqlCateg, $this->conexion) or die("Error de consulta de categoria".mysql_error());
			
			$rows2 = mysql_num_rows($ejecutar_sqlCateg);

			if($rows2 != 0){
            	$cat = array();
            	while ($rows = mysql_fetch_assoc($ejecutar_sqlCateg)) {
					$categoria[] = $rows;
				}
            
		    	return $categoria;
            }
		}

		/*Funcion para cargar div de los datos del formulario Dirección según el CP ingresado y con el  parametro de clave de proveedor */
		public function obtenerDatosDireccionUpdateProv($idProv)
		{
			$sqldirProv = "SELECT cp.id_cp,cp.codigoP
						  FROM codigos_postales cp, direcciones d, proveedores prov
						  WHERE cp.id_cp = d.id_cp
						  AND d.id_direccion = prov.id_direccion
						  AND prov.id_prov = ".$idProv;
			$ejecutar_sqldirProv = mysql_query($sqldirProv, $this->conexion) or die (mysql_error());
			$filas1 = mysql_num_rows($ejecutar_sqldirProv);
			if ($filas1 != 0) {
				$CodigoPostal = mysql_result($ejecutar_sqldirProv, 0, 'codigoP');
				$idCp = mysql_result($ejecutar_sqldirProv, 0, 'id_cp');
			}
				
			$sqlcp = "SELECT * FROM codigos_postales WHERE codigoP = ".$CodigoPostal." AND id_cp != ".$idCp." ORDER BY localidad";
			$ejecutar_sqlcp = mysql_query($sqlcp, $this->conexion) or die (mysql_error());
			$filas2 = mysql_num_rows($ejecutar_sqlcp);
		
            if($filas2 != 0){
            	$codigoPostal= array();
            	while ($rows = mysql_fetch_assoc($ejecutar_sqlcp)) {
					$codigosPostales[] = $rows;
				}
            
		    	return $codigosPostales;
            }
		}

		public function obtBankUpdateProv($IDprov)
		{
			$sqlBankProv = "SELECT bank.id_banco,bank.nombre_banco
							FROM bancos bank,datos_bancarios db,proveedores prov,det_bank_prov dbprov
							WHERE  bank.id_banco = db.id_banco
							AND db.id_datBank = dbprov.id_datBank
							AND prov.id_prov = dbprov.id_prov
							AND prov.id_prov =".$IDprov;
			$ejecutar_sqlBankProv = mysql_query($sqlBankProv, $this->conexion) or die("Error de consulta banco-proveedores".mysql_error());
			
			$rows1 = mysql_num_rows($ejecutar_sqlBankProv);
			
			if ($rows1 != 0) {

				$idbank = mysql_result($ejecutar_sqlBankProv, 0, 'id_banco');
			}

			$sqlBanco = "SELECT id_banco,nombre_banco
						 FROM bancos
						 WHERE id_banco != ".$idbank."
						 ORDER BY nombre_banco;";
			$ejecutar_sqlBanco = mysql_query($sqlBanco, $this->conexion) or die("Error de consulta de nombre de banco".mysql_error());
			
			$rows2 = mysql_num_rows($ejecutar_sqlBanco);

			if($rows2 != 0){
            	$bank = array();
            	while ($rows = mysql_fetch_assoc($ejecutar_sqlBanco)) {
					$banco[] = $rows;
				}
            
		    	return $banco;
            }
		}

		public function obtTctaUpdateProv($idP)
		{
			$sqlTctaProv = "SELECT tcta.id_tipo_cuenta,tcta.tipo_cuenta
							FROM tipo_cuenta tcta,datos_bancarios db,proveedores prov,det_bank_prov dbprov
							WHERE tcta.id_tipo_cuenta = db.id_tipo_cuenta
							AND db.id_datBank = dbprov.id_datBank
							AND prov.id_prov = dbprov.id_prov
							AND prov.id_prov =".$idP;
			$ejecutar_sqlTctaProv = mysql_query($sqlTctaProv, $this->conexion) or die("Error de consulta tipo cuenta-proveedores".mysql_error());
			
			$rows1 = mysql_num_rows($ejecutar_sqlTctaProv);
			
			if ($rows1 != 0) {

				$id_tcuenta = mysql_result($ejecutar_sqlTctaProv, 0, 'id_tipo_cuenta');
			}

			$sqlTcta = "SELECT id_tipo_cuenta,tipo_cuenta
						FROM tipo_cuenta
						WHERE id_tipo_cuenta != ".$id_tcuenta."
						ORDER BY tipo_cuenta";
			$ejecutar_sqlTcta = mysql_query($sqlTcta, $this->conexion) or die("Error de consulta de tipo de cuenta".mysql_error());
			
			$rows2 = mysql_num_rows($ejecutar_sqlTcta);

			if($rows2 != 0){
            	$tcta = array();
            	while ($rows = mysql_fetch_assoc($ejecutar_sqlTcta)) {
					$tipo_cta[] = $rows;
				}
            
		    	return $tipo_cta;
            }
		}

		// Función para registrar proveedores
		public function registrarProveedores($id_datf,$razon_s,$rfc,
											 $id_dire,$street,$noext,$noint,$col,$referen,$cp,
											 $id_prov,$prov,$cat,$phone,$dweb,
											 $id_dtb,$id_bank,$sucu,$titular,$nocuent,$clabe,$id_tcuenta) 
		{
			$prov = mb_strtoupper($prov);
			$razon_s = mb_strtoupper($razon_s);
			$street = mb_strtoupper($street);
			$col = mb_strtoupper($col);
			$sucu = mb_strtoupper($sucu);
			$titular = mb_strtoupper($titular);

			if (strlen($rfc) == 12)
			{
					$tipo_rs = "Moral";
				}else if (strlen($rfc) == 13) {
					$tipo_rs = "Física";
			}
			$band = 0;

			if ($prov != "" && $cat != "" && $phone != "" && $dweb != "" && $razon_s != "" && $rfc != "" && $street != "" && $noext != "" && $col != "" && $id_bank != "" && $sucu != "" && $titular != "" && $nocuent != "" && $clabe != "" && $id_tcuenta != "") 
			{
				
			} else {
				$band = 1;
				echo" <script> alert('Complete toda la información requerida antes de continuar') </script> ";
			}

			if($cp == 0){
				$band = 1;
				echo" <script> alert('Seleccione una localidad') </script> ";
			}

			if($band == 0){
				$sql_prov_dupli = "SELECT prov.id_prov,prov.proveedor,dfis.razon_social,dfis.rfc
									FROM proveedores prov,datos_fiscales dfis
									WHERE prov.proveedor = '".$prov."'
									AND dfis.razon_social = '".$razon_s."'
									AND dfis.rfc = '".$rfc."'
									AND prov.id_prov != ".$id_prov.";";
				$ejecutar_sql_prov_dupli = mysql_query($sql_prov_dupli,$this->conexion) or die (mysql_error());
				
				$rows = mysql_num_rows($ejecutar_sql_prov_dupli);
				
				if($rows != 0){
					$band = 1;
					echo" <script> alert('El proveedor $prov ya se encuentra registrado') </script> ";
				}
			}

			if ($band == 0) {
				
				// consulta para insertar en la tabla de datos fiscales
				$sqlinsertdf = "INSERT INTO datos_fiscales (id_datFiscal,razon_social,rfc,tipo_ra)
								 VALUES (".$id_datf.",'".$razon_s."','".$rfc."','".$tipo_rs."');";
				$ejecutar_sqlinsertdf = mysql_query($sqlinsertdf,$this->conexion) or die ("Error en insertar datos fiscales ".mysql_error());
				
				// consulta para insertar en la tabla de direcciones
				$sqlinsertdir = "INSERT INTO direcciones (id_direccion,calle,num_ext,num_int,colonia,referencia,id_cp)
								 VALUES (".$id_dire.",'".$street."',".$noext.",'".$noint."','".$col."','".$referen."',".$cp.");";
				$ejecutar_sqlinsertdir = mysql_query($sqlinsertdir,$this->conexion) or die("Error en insertar direcciones ".mysql_error());

				// consulta para insertar en la tabla de proveedores
				$sqlinsertprov = "INSERT INTO proveedores (id_prov,fecha_alta,proveedor,tel,dirweb,id_categoria,id_datFiscal,id_direccion,activo)
								  VALUES (".$id_prov.",NOW(),'".$prov."','".$phone."','".$dweb."',".$cat.",".$id_datf.",".$id_dire.",'si');";
				$ejecutar_sqlinsertprov = mysql_query($sqlinsertprov,$this->conexion) or die("Error en insertar proveedores ".mysql_error());

				// consulta para insertar en la tabla de proveedores_contacto
				$sqlinsertprov_contact = "INSERT INTO proveedores_contacto (id_prov,id_contacto)
										  VALUES (".$id_prov.",1);";
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

		public function actualizarProveedores($id_datf,$razon_s,$rfc,
											 $id_dire,$street,$noext,$noint,$col,$referen,$idcp,
											 $id_prov,$prov,$cat,$phone,$dweb,
											 $id_dtb,$id_bank,$sucu,$titular,$nocuent,$clabe,$id_tcuenta)
		{

			// consulta para actualizar los datos de la tabla datos fiscales
			$sqlUpdatedf = "UPDATE datos_fiscales
							SET razon_social='".$razon_s."', rfc='".$rfc."'
							WHERE id_datFiscal=".$id_datf.";";
			$ejecutar_sqlUpdatedf = mysql_query($sqlUpdatedf) or die("Error al actualizar datos fiscales".mysql_error());

			// consulta para actualizar los datos de la tabla direcciones
			$sqlUpdatedir = "UPDATE direcciones
							 SET calle='".$street."', num_ext=".$noext.", num_int='".$noint."', colonia='".$col."', referencia='".$referen."', id_cp=".$idcp."
							 WHERE id_direccion=".$id_dire.";";
			$ejecutar_sqlUpdatedir = mysql_query($sqlUpdatedir) or die("Error al actualizar direccion".mysql_error());

			// consulta para actualizar los datos de la tabla proveedores
			$sqlUpdateprov = "UPDATE proveedores
							  SET proveedor='".$prov."', tel='".$phone."', dirweb='".$dweb."', id_categoria=".$cat.",id_datFiscal=".$id_datf.", id_direccion=".$id_dire."
							  WHERE id_prov=".$id_prov.";";
			$ejecutar_sqlUpdateprov = mysql_query($sqlUpdateprov) or die("Error al actualizar proveedores".mysql_error());

			// consulta para actualizar los datos de la tabla proveedores_contacto
			$sqlUpdateprov_contact = "UPDATE proveedores_contacto
									  SET id_prov=".$id_prov.",id_contacto=4
									  WHERE id_prov=".$id_prov." AND id_contacto=5;";
			$ejecutar_sqlUpdateprov_contact = mysql_query($sqlUpdateprov_contact) or die ("Error al actualizar proveedores-contactos".mysql_error());

			// consulta para actualizar los datos de la tabla datos bancarios
			$sqlUpdatedb = "UPDATE datos_bancarios
							SET id_banco=".$id_bank.", sucursal='".$sucu."', titular='".$titular."', no_cuenta='".$nocuent."', no_cuenta_interbancario=".$clabe.", id_tipo_cuenta=".$id_tcuenta."
							WHERE id_datBank=".$id_dtb.";";
			$ejecutar_sqlUpdatedb = mysql_query($sqlUpdatedb) or die("Error al actualizar datos bancarios".mysql_error());

			// consulta para actualizar los datos de la tabla datos bancarios-proveedores
			$sqlUpdatedb_prov = "UPDATE det_bank_prov
									SET id_prov=".$id_prov.",id_datBank=".$id_dtb."
									WHERE id_prov=".$id_prov." AND id_datBank=".$id_dtb.";";
			$ejecutar_sqlUpdatedb_prov = mysql_query($sqlUpdatedb_prov) or die("Error al actualizar detalle datos bancarios".mysql_error());
			
			return $sqlUpdatedf && $sqlUpdatedir && $sqlUpdateprov && $sqlUpdateprov_contact && $sqlUpdatedb && $sqlUpdatedb_prov;
		}

		public function borrarProveedores($id_prov)
		{
			
			$sql_select = "SELECT db.id_datBank,df.id_datFiscal,dir.id_direccion,cont.id_contacto
							FROM datos_bancarios db,proveedores prov,det_bank_prov dbp,datos_fiscales df,direcciones dir,proveedores_contacto provcont,contactos cont
							WHERE db.id_datBank=dbp.id_datBank
							AND prov.id_prov=dbp.id_prov
							AND df.id_datFiscal=prov.id_datFiscal
							AND dir.id_direccion=prov.id_direccion
							AND cont.id_contacto=provcont.id_contacto
							AND prov.id_prov=provcont.id_prov
							AND prov.id_prov=".$id_prov;
			$ejecutar_sql_select = mysql_query($sql_select) or die("error de consulta".mysql_error());

			$id_bancarios = mysql_result($ejecutar_sql_select, 0, 'id_datBank');
			$id_fiscales = mysql_result($ejecutar_sql_select, 0,'id_datFiscal');
			$id_dir = mysql_result($ejecutar_sql_select, 0,'id_direccion');
			$id_contact = mysql_result($ejecutar_sql_select, 0,'id_contacto');

			$sql_deleteprov = "DELETE dbp,db,proc,prov,dir,df 
								FROM det_bank_prov dbp, datos_bancarios db, proveedores_contacto proc, proveedores prov, direcciones dir, datos_fiscales df
								WHERE df.id_datFiscal=prov.id_datFiscal 
								AND dir.id_direccion=prov.id_direccion 
								AND prov.id_prov=proc.id_prov
								AND db.id_datBank=dbp.id_datBank
								AND prov.id_prov=dbp.id_prov
								AND prov.id_prov=".$id_prov."
								AND db.id_datBank=".$id_bancarios."
								AND proc.id_contacto=".$id_contact." 
								AND dir.id_direccion=".$id_dir."
								AND df.id_datFiscal=".$id_fiscales;
			$ejecutar_sql_deleteprov = mysql_query($sql_deleteprov,$this->conexion) or die("Error de consulta delete proveedores".mysql_error());
		
			echo" <script> alert('El registro ha sido eliminado correctamente') 
							window.location='index.php?url=Proveedores';
					 	</script> ";
		}
		
		//-------------------------TRANSACCIONES-------------------------------------------
		
		public function obtenerNoComprobanteCompr(){
			$consulta = "SELECT no_trans_compra FROM transacciones_compras ORDER BY no_trans_compra DESC LIMIT 1;";
			$ejecutar = mysql_query($consulta,$this->conexion) or die (mysql_error());
			$filas = mysql_num_rows($ejecutar);
			
			if($filas==0){
				$noComprobCompr = 1;
				$longitud = strlen($noComprobCompr);
				$longMax = 3;
				for ($i=0; $i < $longMax; $i++) { 
					$noComprobCompr = "0".$noComprobCompr;
				}
			}else{
				$noComprobCompr = mysql_result($ejecutar,0,'no_trans_compra');
				$longitud = strlen($noComprobCompr);
				$noComprobCompr = ($noComprobCompr + 1);
				$longMax = 3;
				for ($i=0; $i < $longMax; $i++) { 
					$noComprobCompr = "0".$noComprobCompr;
				}
			}
			
			return $noComprobCompr;
		}
		
		//combo dinamico para obtener proveedores que ya tengan asignado algún producto
		public function obtieneProveedorProd(){
    		$consultaProvP = "SELECT 
							  prov.id_prov,
							  prov.proveedor 
							FROM
							  proveedores prov 
							  INNER JOIN productos prod 
							    ON prov.id_prov = prod.id_prov 
							GROUP BY prov.proveedor;";
			$ejecutarProvP = mysql_query($consultaProvP)or die ("Error de Consulta-ProvCombo");
			$filasProvP = mysql_num_rows($ejecutarProvP);
		
            if($filasProvP != 0){
			$comboProvP = array();
			while ($rows = mysql_fetch_assoc($ejecutarProvP)) {
				$comboProvP[] = $rows;
			}
			
			return $comboProvP;
			}
		}
		
		public function registrarTransCompra($idCompra,$idProveedor){
				
				// validar que no se vuelva a guardar
				
			$consultaRTC = "INSERT INTO transacciones_compras (
							  no_trans_compra,
							  id_prov,
							  fecha_compra,
							  hora_compra
							) 
							VALUES
							  (
							    '".$idCompra."',
							    ".$idProveedor.",
							    NOW(),
							    NOW()
							  );";
			$ejecutarRTC = mysql_query($consultaRTC,$this->conexion) or die (mysql_error());
			
			return $ejecutarRTC;
		}
		
		
		public function obtenerDatosCompra($idCompra){
    		$idCompra = (int) $idCompra;
			
    		$consultaDCompr = "SELECT 
								  prov.proveedor,
								  tc.fecha_compra,
								  tc.hora_compra 
								FROM
								  proveedores prov 
								  INNER JOIN transacciones_compras tc 
								    ON prov.id_prov = tc.id_prov 
								WHERE tc.no_trans_compra = ".$idCompra;
			$ejecutarDCompr = mysql_query($consultaDCompr,$this->conexion) or die (mysql_error());
		
            $datosCompra = array();
			while ($rows = mysql_fetch_array($ejecutarDCompr)) {
				$datosCompra[] = $rows;
			}
			
			return $datosCompra;
		}
		
		//combo de productos según el proveedor
		public function obtieneProductosProveedores($idProveedor){
    		$consultaOPP = "SELECT id_producto,nombre_producto FROM productos WHERE id_prov = ".$idProveedor;
			$ejecutarOPP = mysql_query($consultaOPP)or die ("Error de Consulta-ProductoCombo");
			$filasOPP = mysql_num_rows($ejecutarOPP);
		
            if($filasOPP != 0){
				$comboProductos = array();
				while ($rows = mysql_fetch_assoc($ejecutarOPP)) {
					$comboProductos[] = $rows;
				}
			
				return $comboProductos;
			}
		}
		
		public function obtenerInformacionProducto($idProducto){
			$consultaProd = "SELECT 
							  prod.id_producto,
							  prod.modelo,
							  m.nombre_marca,
							  f.nombre_fam,
							  l.nombre_linea,
							  sc.subCategoria,
							  tprod.tipo_prod,
							  u.unidad,
							  prod.existencia,
							  prod.descripcion,
							  prod.precio_unitario 
							FROM
							  marca m 
							  INNER JOIN familia f 
							  INNER JOIN linea l 
							  INNER JOIN subcategoria sc 
							  INNER JOIN tipo_prod tprod 
							  INNER JOIN unidad u 
							  INNER JOIN productos prod 
							    ON m.id_marca = prod.id_marca 
							    AND f.id_fam = prod.id_fam 
							    AND l.id_linea = prod.id_linea 
							    AND sc.id_subCat = prod.id_subCat 
							    AND tprod.id_tipoProd = prod.id_tipoProd 
							    AND u.id_unidad = prod.id_unidad 
							WHERE prod.id_producto = ".$idProducto;
			$ejecutarProd = mysql_query($consultaProd,$this->conexion) or die (mysql_error());
			
			$rowsProd = mysql_fetch_assoc($ejecutarProd);

			return $rowsProd;
		}
    }	
?>