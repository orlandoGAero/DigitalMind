<?php ob_start() ?>
	<?php $obtenerDatos['id_cp'] ?>
	<table border="1">
		<tr>
			<td>Código Postal</td>
			<td><?php  echo $codPost['codigoP'] ?></td>
		</tr>
		<tr>
			<td>Localidad</td>
			<td><?php echo $codPost['localidad'] ?></td>
		</tr>
		<tr>
			<td>Municipio</td>
			<td><?php echo $codPost['municipio'] ?></td>
		</tr>
		<tr>
			<td>Estado</td>
			<td><?php echo $codPost['estado'] ?></td>
		</tr>
	</table>
	
<?php $contenido = ob_get_clean() ?>

<?php include 'layout_second.php' ?>