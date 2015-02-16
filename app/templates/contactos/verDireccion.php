<?php ob_start() ?>
	<?php $obtenerDatosDir['id_cp'] ?>
	
	Estado <?php $obtenerDatosDir['estado'] ?>
	Municipio <?php $obtenerDatosDir['municipio'] ?>
	holalmklm
	<tr>
		<th>Localidad</th>
		<td>
			<select id="loc" name="locality" >
				<?php foreach ($obtenerDatosDir as $locality) : ?>
						<option value="<?php echo $locality['id_cp'] ?>"><?php echo $locality['localidad'] ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	
	
<?php $contenido = ob_get_clean() ?>

<?php include '../app/templates/layout_second.php' ?>