 <?php 
 	/**
	 * ob_start() envia todos los resultados del script desde la invocación de la función a un buffer interno. Dichos resultados se recojen a través de la función ob_get_clean().
	 */
?>
<?php ob_start() ?>
	<!--Script para el paginado-->
	<script type="text/javascript" src="<?php echo 'js/'.config::$paging_js ?>"></script>
	
	<table class="buscar">
		<tr>
			<td width="100%">
				<form name="formBusqueda">
				<b class="azul">Buscar</b> <input type="search" name="busqueda" id="buscador" autocomplete="off" maxlength="50" required="required" placeholder="Agrega lo que deseas buscar" />
				</form>
				<td>
				<a href='index.php?url=insertContact'><img src="images/add.png" title="Nuevo Contacto" align='right' width="25px" height="25px"/></a>
				<!--<div id="resultado"></div>-->
			</td>	
		</tr>
	</table>
	
	<br />
	
	<div id="NavPosicion"></div> 	<!--Div donde se mostrara las opciones del paginado 1|2|3...-->
	
	<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
	<div class="table-responsive">
		
		<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
			"id" para incluir los estilos a la tabla -->
    	<table class="table" id="miTabla">
    		<caption>Contactos</caption>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Área</th>
					<th>Móvill</th>
					<th>Télefono Oficina</th>
					<th>Correo Personal</th>
					<th>Activo</th>
					<th>Operaciones</th>
				</tr>
			</thead>			
			
			<?php 
				foreach ($obtenerDatosContactos['contactos'] as $contact) :
				$idContacto = $contact['id_contacto'];
				// Encriptamos el texto
				//$c = Encrypter::encrypt("$idContacto");
			?>
				<tr>
					<td><?php echo $contact['nombreCon'] ?></td>
					<td><?php echo $contact['ap_paterno'] ?></td>
					<td><?php echo $contact['ap_materno'] ?></td>
					<td><?php echo $contact['nombre_area'] ?></td>
					<td><?php echo $contact['movil'] ?></td>
					<td><?php echo $contact['tel_oficina'] ?></td>
					<td><?php echo $contact['correo_p'] ?></td>
					<td><?php echo $contact['activo'] ?></td>
					<td>
						<?php echo "<a href='index.php?url=viewContact&idContact=".$idContacto."'>" ?> <img src="images/detalle.png" title="Detalle"/></a>
						<?php echo "<a href='index.php?url=updateContact&idContact=".$idContacto."'>" ?> <img src="images/editar.png" title="Modificar"/></a>
						<?php echo "<a href='index.php?url=deletedContact&idContact=".$idContacto."'>" ?> <img src="images/eliminar.png" title="Eliminar"/></a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	
	<!-- Script para paginar la tabla de contactos en 5 filas -->
	<script type="text/javascript">
		var pager = new Pager('miTabla', 5);
		pager.init();
		pager.showPageNav('pager', 'NavPosicion');
		pager.showPage(1);
	</script>
	
	<!-- Función JQuery para filtrar los datos de la tabla de contactos -->
	<script type="text/javascript">
	
		jQuery("#buscador").keyup(function(){
		    if( jQuery(this).val() != ""){
		        jQuery("#miTabla tbody>tr").hide();
		        jQuery("#miTabla td:contiene-palabra('" + jQuery(this).val() + "')").parent("tr").show();
		        $('#NavPosicion').hide();
		    }
		    else{
		        jQuery("#miTabla  tbody>tr").show();
		        $('#NavPosicion').show();
		        var pager = new Pager('miTabla', 5);
				pager.init();
				pager.showPageNav('pager', 'NavPosicion');
				pager.showPage(1);
		    }
		});
		 
		jQuery.extend(jQuery.expr[":"], 
		{
		    "contiene-palabra": function(elem, i, match, array) {
		        return (elem.textContent || elem.innerText || jQuery(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
		    }
		});
		
	</script>
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>