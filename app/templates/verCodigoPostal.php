<?php ob_start() ?>
	<?php $obtenerDatos['id_cp'] ?>
	<table class="table-bordered">
		<tr>
			<th>Código Postal</th>
			<td><?php  echo $codPost['codigoP'] ?></td>
		</tr>
		<tr>
			<th>Localidad</th>
			<td><?php echo $codPost['localidad'] ?></td>
		</tr>
		<tr>
			<th>Municipio</th>
			<td><?php echo $codPost['municipio'] ?></td>
		</tr>
		<tr>
			<th>Estado</th>
			<td><?php echo $codPost['estado'] ?></td>
		</tr>
	</table>
	
<?php $contenido = ob_get_clean() ?>

<?php include 'layout_second.php' ?>