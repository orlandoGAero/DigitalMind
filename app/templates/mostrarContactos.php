 <?php 
 	/**
	 * ob_start() envia todos los resultados del script desde la invocación de la función a un buffer interno. Dichos resultados se recojen a través de la función ob_get_clean().
	 */
?>
<?php ob_start() ?>
	<input type="search" name='busqueda'/>
	<a href='index.php?url=insertContact'><img src="images/add.png" align='right' width="25px" height="25px"/></a>
	<br><br>
<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
	<div class="table-responsive">
		
		<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
			"id" para utilizar la librería de DataTable(ordenar, buscar y paginar) -->
    	<table class="table table-bordered"> 
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Apellido Paterno</th>
					<th>Apallido Materno</th>
					<th>Área</th>
					<th>Móvill</th>
					<th>Télefono Oficina</th>
					<th>Correo Institucional</th>
					<th>Operaciones</th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<th>Nombre</th>
					<th>Apellido Paterno</th>
					<th>Apallido Materno</th>
					<th>Área</th>
					<th>Móvill</th>
					<th>Télefono Oficina</th>
					<th>Correo Institucional</th>
					<th>Operaciones</th>
				</tr>
			</tfoot>
			
			
			<?php 
				foreach ($obtenerDatosContactos['contactos'] as $contact) :
				$idContacto = $contact['id_contacto'];
				// Encriptamos el texto
				//$c = Encrypter::encrypt("$idContacto");
			?>
			<tbody>
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
						<a href="index.php?---------"><img src="images/editar.png" title="Modificar"/></a>
						<a href="index.php?---------"><img src="images/eliminar.png" title="Eliminar"/></a>
					</td>
				</tr>
			</tbody>
			<?php endforeach; ?>
		</table>
	</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout_second.php' ?>