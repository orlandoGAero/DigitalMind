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
				<form name="formBusqueda" action="index.php?url=----" method="POST">
				<b class="azul">Buscar</b> <input type="text" name="busqueda" maxlength="50" required />
				</form>
				<td>
				<a href='index.php?url=insertContact'><img src="images/add.png" title="Nuevo Contacto" align='right' width="25px" height="25px"/></a>
				<!--<div id="resultado"></div>-->
			</td>	
		</tr>
	</table>
	
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
					<th>Correo Institucional</th>
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
					<td><?php echo $contact['correo_instu'] ?></td>
					<td>
						<?php echo "<a href='index.php?url=viewContact&idContact=$idContacto'>" ?> <img src="images/detalle.png" title="Detalle"/></a>
						<a href="index.php?"><img src="images/editar.png" title="Modificar"/></a>
						<a href="index.php?---------"><img src="images/eliminar.png" title="Eliminar"/></a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	
	<script type="text/javascript">
		var pager = new Pager('miTabla', 4);
		pager.init();
		pager.showPageNav('pager', 'NavPosicion');
		pager.showPage(1);
	</script>
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>