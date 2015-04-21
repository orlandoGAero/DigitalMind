<?php ob_start() ?>
	<link rel="stylesheet" href="css/estilos.css" />
	 <!-- JS Formulario Listas Desplegables -->
	 <script type="text/javascript" src="<?php echo 'js/'.config::$jquery_lksMenu_js ?>"></script>
	<script>
		$('document').ready(function(){
			$('.menu-pro').lksMenu();
		});
	</script>


</head>


<body>
	<div class="col-lg-14">
        <div class="panel panel-default">
		<h1><a href="index.php?url=listaCliente" title="Salir"><img src="images/salir.png" height="20px" /></a>Detalle Cliente</h1>
        <div class="panel-heading">    </div>
    <div class="panel-body">	
		<section id="principal">
	<div class="menu-pro">
		<ul>
			<li><a href="#"><b>Datos Cliente</b></a>
				<ul>
					<li>
					<table class="nuevo-pro">
					<tr><th>Clave</th><td><input type="text" name="idCliente" value="<?php echo $lisCliente['id_cliente']?>"readonly class="form-control"/></td></tr>
					<tr><th>Nombre</th><td><input type="text" name="nomb"  class="form-control" value="<?php echo $lisCliente['nombre']?>"readonly /></td></tr>
					<tr><th>Teléfono Móvil</th><td><input type="text" value="<?php echo $lisCliente['t_movil']?>"readonly name="telMovil" class="form-control"/></td>  </tr>
					<tr><th>Teléfono Oficina</th><td><input type="text" value="<?php echo $lisCliente['t_oficina']?>"readonly name="telOficina" class="form-control"/></td></tr>
					<tr><th>Teléfono Emergencia</th><td> <input type="text" value="<?php echo $lisCliente['t_emergencia']?>"readonly name="telEmergencia" class="form-control"/></td></tr>
					<tr><th>Ext.</th><td><input type="text" name="extension"  value="<?php echo $lisCliente['extension']?>"readonly class="form-control"/></td></tr>
					<tr><th>Página web</th><td><input type="url" name="dirWeb" value="<?php echo $lisCliente['direccion_web']?>"readonly class="form-control"/> </td> </tr>
                    <tr><th>Categoría</th> <td> <input type="text" name="categoria" value="<?php echo $lisCliente['categoria']?>"readonly class="form-control"/> </td> </tr>
					</table>
					</li>
				</ul>
			</li>
			<li><a href="#"><b>Datos Fiscales</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">
							<tr><th width="50%">Clave</th><td><input type="text" name="id_datFiscal" value="<?php echo $lisCliente['id_datFiscal']?>"readonly class="form-control"/><td></td></td></tr>
							<tr><th>Razón Social</th><td><input type="text" name="razon_social" value="<?php echo $lisCliente['razon_social']?>"readonly class="form-control"/></td><td></td></tr>
							<tr><th>RFC</th><td><input type="text" name="RFC" value="<?php echo $lisCliente['rfc']?>"readonly class="form-control"/></td><td></td></tr>
						</table>
					</li>
				</ul>
			</li>
		<div class='table-responsive'>
			<li><a href="#"><b>Datos Bancarios</b></a>
				<ul>
					<li><br>


				<?php
				//Define el Array bidimencional
				$AddDBancarios[]=array();
				//se inicia el valor de a, que generara nuevas posiciones al array a partir de 0
				$a=0;
				foreach ($DatosBank as $item ) {	
				      	$AddDBancarios[$a]=$item;
				        //se incrementa el valor de a para nuevos posibles DatosBank
				    $a++;    
				}
				//////////////////////////////////////////
				//Comprobar que existan DatosBank

				if(isset($AddDBancarios[0]['id_datBank']))
				{
				//Datos de la paginacion

				//Registros que se mostraran por pagina, en la tabla
				    $RegistrosAMostrarDB=3;

				    //estos valores los recibo por GET
				if(isset($_GET['pag'])){
				    $RegistrosAEmpezarDB=($_GET['pag']-1)*$RegistrosAMostrarDB;
				    
				    $PagActDB=$_GET['pag'];
				   
				    
				    
				}
				else{
				     //caso contrario los iniciamos
				    $RegistrosAEmpezarDB=0;
				    $PagActDB=1;
				}


				$NroRegistrosDB=count($AddDBancarios);
				$PagAntDB=$PagActDB - 1;
				$PagSigDB=$PagActDB + 1;
				$PagUltDB=$NroRegistrosDB/$RegistrosAMostrarDB;

				//verificamos residuo para ver si llevará decimales
				$ResDB=$NroRegistrosDB%$RegistrosAMostrarDB;
				// si hay residuo usamos funcion floor para que me
				// devuelva la parte entera, SIN REDONDEAR, y le sumamos
				// una unidad para obtener la ultima pagina


				/////////////////////////
				//Fin del calculo

				?>

				<!--Genera la tabla para mostrar los DatosBank-->
				    <table class="table" id="miTabla"><tr>
				        <th>Banco</th>
				        <th>Sucursal</th>
				        <th>Titular</th>
				        <th>Tipo Cuenta</th>
				        
				        </tr>
				<?php

				//definira el rango del array  que se mostrara en la tabla
				//de acuerdo a la pagina y los registros a mostrar por pagina

				$resultadoDB=array_slice($AddDBancarios,$RegistrosAEmpezarDB,$RegistrosAMostrarDB);



				//For para obtener los datos del array
				for($s=0;$s<count($resultadoDB);$s++) {

				echo "<td>"   .$resultadoDB[$s]['nombre_banco'].'</td>'; 
				echo "<td>"   .$resultadoDB[$s]['sucursal'].'</td>';    
				echo "<td>"   .$resultadoDB[$s]['titular'].'</td>';    
				echo "<td>"   .$resultadoDB[$s]['tipo_cuenta'].'</td>';
				 echo"</tr>";
				}


				echo "</table>


				";
				    
				?>
				                
				<?php  
				/*Muestra la paginacion de la tabla*/

				if($ResDB>0){
				    
				 $PagUltDB=floor($PagUltDB)+1;
				}
				//desplazamiento
				echo "<center><table> <tr>";
				if($PagActDB>1) {
				    
				    echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdoa' id='frmdoa' target='_self'>
				<input type = 'hidden' value = '1' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='Primera'/>
				</form>
				</td>
				";
				    /*Para ir a la pagina anterior*/
				echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdob' id='frmdob' target='_self'>
				<input type = 'hidden' value = '$PagAntDB' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='<<'/>
				</form></td>";    
				    
				//echo "<strong color=blue>Pagina ".$PagActDB."</strong>";
				}

				    /*para la paginacion*/
				 for($i=1;$i<=$PagUltDB;$i++) 
				    {
				     /*muestra las pagina anteriores a la actual*/
				     if($i<$PagActDB){
				echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdo$i' id='frmdo$i' target='_self'>
				<input type = 'hidden' value = '$i' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='$i'/>
				</form>  </td>";    
				     }
				     /*Muestra la pagina actual*/
				       if($i==$PagActDB) 
				       { 
				           echo "<td><input type='button' value='".$PagActDB."'/></td>";
				        }
				     /*Muestra las paginas siguientes a  la actual*/
				     if($i>$PagActDB){
				         echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdo$i' id='frmdo$i' target='_self'>
				<input type = 'hidden' value = '$i' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='$i'/>
				</form>  </td>";
				     }
				    }

				if($PagActDB<$PagUltDB)  {
				/*Muestra el boton siguiente*/    
				echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdoc' id='frmdoc' target='_self'>
				<input type = 'hidden' value = '$PagSigDB' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='>>'/>
				</form></td>";
				/*muestra el boton para ir a la ultima pagina*/
				echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdod' id='frmdod' target='_self'>
				<input type = 'hidden' value = '$PagUltDB' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='Ultima'/>
				</form></td>";

				}
				    echo "</td><td width='10'></td></tr></table></center>";
				}

				else{
				echo "<h2>No hay DatosBank Asignados</h2>";
				}


					

				?>




					</li>
				</ul>
			</li>
			<li><a href="#"><b>Datos Dirección Física</b></a>
				<ul>
					<li>
						<table class="nuevo-pro">							
							<tr><th width="50%">Clave</th><td><input type="text"  name="id_direccion" value="<?php echo $lisCliente['id_direccion']?>" readonly class="form-control"/></td></tr>
							<tr><th>Código P.</th><td><input type="text" id="cp" name="cp" value="<?php echo $lisCliente['codigoP']?>"readonly class="form-control"/></td></tr>
							<tr><th>Municipio</th><td><input type="text" id="muni" name="muni" value="<?php echo $lisCliente['municipio']?>"readonly class="form-control"/></td></tr>
							<tr><th>Localidad</th><td><input type="text" id="localidad" name="localidad"value="<?php echo $lisCliente['localidad']?>"readonly class="form-control"/></td></tr>
							<tr><th>Estado</th><td><input type="text" id="estado" name="estado" value="<?php echo $lisCliente['estado']?>"readonly class="form-control"/></td></tr>
							<tr><th>Calle</th><td><input type="text" id="Calle" name="Calle" value="<?php echo $lisCliente['calle']?>"readonly class="form-control"/></td></tr>
							<tr><th>No. Ext</th><td><input type="text" id="Num_Ext" name="Num_Ext" value="<?php echo $lisCliente['num_ext']?>"readonly class="form-control"/></td></tr>
							<tr><th>No. Int</th><td><input type="text" id="Num_Int" name="Num_Int" value="<?php echo $lisCliente['num_int']?>"readonly class="form-control"/></td></tr>
							<tr><th>Colonia</th><td><input type="text" id="Colonia" name="Colonia" value="<?php echo $lisCliente['colonia']?>"readonly class="form-control"/></td></tr>
							<tr><th>Referencia</th><td><input type="text" id="Referencia" name="Referencia" value="<?php echo $lisCliente['referencia']?>"readonly class="form-control"/></td></tr>
						</table>
					</li>
				</ul>
			</li>

			<li><a href="#"><b>Datos Contacto</b></a>
				<ul>
					<li><br>

				<?php
				//Define el Array bidimencional
				$AddContactos[]=array();
				//se inicia el valor de a, que generara nuevas posiciones al array a partir de 0
				$a=0;
				foreach ($Contactos as $item ) {	
				      	$AddContactos[$a]=$item;
				        //se incrementa el valor de a para nuevos posibles contactos
				    $a++;    
				}
				//////////////////////////////////////////
				//Comprobar que existan contactos

				if(isset($AddContactos[0]['id_contacto']))
				{
				//Datos de la paginacion

				//Registros que se mostraran por pagina, en la tabla
				    $RegistrosAMostrar=3;

				    //estos valores los recibo por GET
				if(isset($_GET['pag'])){
				    $RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
				    
				    $PagAct=$_GET['pag'];
				   
				    
				    
				}
				else{
				     //caso contrario los iniciamos
				    $RegistrosAEmpezar=0;
				    $PagAct=1;
				}


				$NroRegistros=count($AddContactos);
				$PagAnt=$PagAct - 1;
				$PagSig=$PagAct + 1;
				$PagUlt=$NroRegistros/$RegistrosAMostrar;

				//verificamos residuo para ver si llevará decimales
				$Res=$NroRegistros%$RegistrosAMostrar;
				// si hay residuo usamos funcion floor para que me
				// devuelva la parte entera, SIN REDONDEAR, y le sumamos
				// una unidad para obtener la ultima pagina


				/////////////////////////
				//Fin del calculo

				?>

				<!--Genera la tabla para mostrar los contactos-->
				    <table class="table" id="miTabla"><tr>
				        <th>Nombre</th>
				        <th>Area</th>
				        <th>Correo</th>
				        <th>Telefono Móvil</th>
				        
				        </tr>
				<?php

				//definira el rango del array  que se mostrara en la tabla
				//de acuerdo a la pagina y los registros a mostrar por pagina

				$resultado=array_slice($AddContactos,$RegistrosAEmpezar,$RegistrosAMostrar);



				//For para obtener los datos del array
				for($i=0;$i<count($resultado);$i++) {

				echo "<tr><td>"
				    .$resultado[$i]['nombreCon']." "
				    .$resultado[$i]['ap_paterno']." " 
				    .$resultado[$i]['ap_materno']." "
				    
				    .'</td>';
				    
				echo "<td>"   .$resultado[$i]['nombre_area'].'</td>';    
				echo "<td>"   .$resultado[$i]['correo_instu'].'</td>';    
				echo "<td>"   .$resultado[$i]['movil'].'</td>';
				 echo"</tr>";
				}


				echo "</table>


				";
				    
				?>
				                
				<?php  
				/*Muestra la paginacion de la tabla*/

				if($Res>0){
				    
				 $PagUlt=floor($PagUlt)+1;
				}
				//desplazamiento
				echo "<center><table> <tr>";
				if($PagAct>1) {
				    
				    echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdoa' id='frmdoa' target='_self'>
				<input type = 'hidden' value = '1' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='Primera'/>
				</form>
				</td>
				";
				    /*Para ir a la pagina anterior*/
				echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdob' id='frmdob' target='_self'>
				<input type = 'hidden' value = '$PagAnt' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='<<'/>
				</form></td>";    
				    
				//echo "<strong color=blue>Pagina ".$PagAct."</strong>";
				}

				    /*para la paginacion*/
				 for($i=1;$i<=$PagUlt;$i++) 
				    {
				     /*muestra las pagina anteriores a la actual*/
				     if($i<$PagAct){
				echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdo$i' id='frmdo$i' target='_self'>
				<input type = 'hidden' value = '$i' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='$i'/>
				</form>  </td>";    
				     }
				     /*Muestra la pagina actual*/
				       if($i==$PagAct) 
				       { 
				           echo "<td><input type='button' value='".$PagAct."'/></td>";
				        }
				     /*Muestra las paginas siguientes a  la actual*/
				     if($i>$PagAct){
				         echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdo$i' id='frmdo$i' target='_self'>
				<input type = 'hidden' value = '$i' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='$i'/>
				</form>  </td>";
				     }
				    }

				if($PagAct<$PagUlt)  {
				/*Muestra el boton siguiente*/    
				echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdoc' id='frmdoc' target='_self'>
				<input type = 'hidden' value = '$PagSig' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='>>'/>
				</form></td>";
				/*muestra el boton para ir a la ultima pagina*/
				echo "<td><form action='' method = 'POST' enctype='application/x-www-form-urlencoded' name='frmdod' id='frmdod' target='_self'>
				<input type = 'hidden' value = '$PagUlt' name = 'pag' id= 'pag'>
				<input type='button' name='change' class='change' value='Ultima'/>
				</form></td>";

				}
				    echo "</td><td width='10'></td></tr></table></center>";
				}

				else{
				echo "<h2>No hay Contactos Asignados</h2>";
				}


					

				?>
	

			

<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>
