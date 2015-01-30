<?php ob_start() ?>
	
	<!--  Para hacer la tabla responsiva utilizamos la clase "table-responsive" de bootstrap incluida en un div -->
	<div class="table-responsive">
		
		<!-- "class" donde se incluye el estilo de la librería de bootstrap y 
			"id" para utilizar la librería de DataTable(ordenar, buscar y paginar) -->
    	<table class="table table-bordered"> 
			<thead>
				<tr>
					<th>CP</th>
					<th>Localidad</th>
					<th>Municipio</th>
					<th>Estado</th>
					<th>Operaciones</th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<th>CP</th>
					<th>Localidad</th>
					<th>Municipio</th>
					<th>Estado</th>
					<th>Operaciones</th>
				</tr>
			</tfoot>
			
			
			<?php 
				foreach ($obtenerDatos['codigos_postales'] as $codP) :
				$idCodPost = $codP['id_cp'];
				// Encriptamos el texto
				//$cp = Encrypter::encrypt("$idCodPost");
			?>
			<tbody>
				<tr>
					<td><?php echo $codP['codigoP'] ?></td>
					<td><?php echo $codP['localidad'] ?></td>
					<td><?php echo $codP['municipio'] ?></td>
					<td><?php echo $codP['estado'] ?></td>
					<td>
						<?php echo "<a href='index.php?url=verCodPost&idCP=$idCodPost'>" ?> <img src="images/detalle.png" title="Detalle"/></a>
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